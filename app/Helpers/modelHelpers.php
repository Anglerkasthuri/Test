<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;

if (!function_exists('__reportOrderBy')) {
    function __reportOrderBy($query, $sortField, $sortDirection)
    {
        if (!empty($sortField) && !empty($sortDirection)) {
            $query->orderBy($sortField, $sortDirection);
        }
        return $query;
    }
}

if (!function_exists('__reportConditions')) {
    function __reportConditions($query, $conditions) {
        if (!empty($conditions)) {
            foreach ($conditions as  $operator => $condition_arr) {
                $operator = is_string($operator) ? strtolower($operator) : $operator;
                foreach ($condition_arr as $field => $value) {
                    $apply_filter = true;

                    $value = $value ?? null;

                    if(!$value) { $apply_filter = false; }
                    if($value == "0") { $apply_filter = true; }

                    if(!$apply_filter) continue;
                    switch ($operator) {
                        case 'boolean':
                            $query = $query->where($field, $value);
                        break;

                        case 'equalto':
                        case '=':
                            $query = $query->where($field, $value);
                        break;
                             
                        case 'notequalto':
                        case '!=':
                            $query->where($field, "!=", $value);
                        break;

                        case 'gt':
                        case '>':                            
                            $query->where($field, ">", $value);
                        break;

                        case 'gte':
                        case '>=':
                            $query->where($field, ">=", $value);
                        break;

                        case 'lt':
                        case '<':
                            $query->where($field, "<", $value);
                        break;

                        case 'lte':
                        case '<=':
                            $query->where($field, "<=", $value);
                        break;

                        case 'like':
                        case '%%':
                            $query->where($field, 'like', "%$value%");
                        break;

                        case 'like%':
                        case '-%':
                            $query->where($field, 'like', "$value%");
                        break;

                        case '%like':
                        case '%-':
                            $query->where($field, 'like', "%$value");
                        break;
                        
                        case 'in':
                            $value = is_array($value) ? $value : array($value);
                            $query->whereIn($field, $value);
                        break;

                        case 'notin':
                            $value = is_array($value) ? $value : array($value);
                            $query->whereNotIn($field, $value);
                        break;
                    }
                }    
            }
        }
        return $query;
    }
}

if (!function_exists('__reportFacet')) {
    function __reportFacet($params) {
        $query = $params['query'];
        $field = $params['field'];

        $counts = $query->select($field, DB::raw('count(*) as total'))
        ->groupBy($field)
        ->pluck('total', $field);
        $result = [];
        foreach($params['data'] as $key => $value) {
            $result[$key]['id'] = $key;
            $result[$key]['field_name'] = $field;
            $result[$key]['title'] = $value;
            $result[$key]['aggregate'] = $counts[$key] ?? 0;
            $result[$key]['active'] = false;
        }
        $facet_result['all'] = collect($counts)->sum() ?? 0;
        $facet_result['facet'] = $result;
        $facet_result['field'] = $field;
        return $facet_result;
    }
}

if (!function_exists('__getAttributesFromNested')) {
    function __getAttributesFromNested($rules)
    {
        $attributes = [];
        foreach($rules as $key => $value) {
            $attributes[$key] = Str::of(Arr::last(explode(".", $key)))->replaceLast("_id", "")->replace("_", " ")->title();
        }
        return $attributes;
    }
}

if (!function_exists('__formatLogTitle')) {
    function __formatLogTitle($str)
    {
        return Str::of($str)->replace(".", " > ")->replace("_", " ")->title();
    }
}

if (!function_exists('__can')) {
    function __can($permission, $redirect=null)
    {
        if(auth()->user()->can($permission) || auth()->user()->is_super_admin) {
            return true;
        } else {
            $message = "Sorry! You Don't have Access this Page";
            return ($redirect) ? redirect()->route('dashboard')->with('alert_danger',$message) : false;
        }
        
    }
}

if (!function_exists('__getRightsCB')) {
    function __getRightsCB($permission, $label, $data)
    {
        // dd($data);
        $checkbox = true;
        $checked = "";
        $label_css_class = "";
        $value = "";

        $permission_id = Arr::get($data['permissions'], $permission);

        if($data['type'] == 'permission') {
            $value = $permission;
            $label_css_class = ($permission_id) ? '' : ' text-danger ';
            $checked = " checked='checked' ";
        }

        if($data['type'] == 'role_permission' || $data['type'] == 'user_permission') {
            $value = Arr::get($data['permissions'], $permission);
            $value = $permission;

            $label_css_class = ($permission_id) ? '' : ' bg-warning ';
            $checkbox = ($permission_id) ?? false;
            $checked = (Arr::exists($data['existing_permission'], $permission)) ? " checked='checked' " : "";
        }

        if($checkbox) {
            echo "<label class='$label_css_class'><input type='checkbox' name='permissions[]' id='$permission' value='$value' $checked /> $label</label>";
        } else {
            echo "<label class='$label_css_class px-1'>$label</label>";
        }
    }
}

if (!function_exists('__date_diff_days')) {
    function __date_diff_days($date1 = '', $date2 = '')
    {
        if (!empty($date1)) {
            $date1 = Carbon::parse($date1);
        } else {
            $date1 = Carbon::now();
        }
        if (!empty($date2)) {
            $date2 = Carbon::parse($date2);
        } else {
            $date2 = Carbon::now();
        }

        return $date1->diffInDays($date2,false);
    }
}

if (!function_exists('__currentDatetimeConvertOrgTZ')) {
    function __currentDatetimeConvertOrgTZ($format = '')
    {
        $format = $format ?? config('settings.date_time_format');
        return Carbon::now()->timezone(config('settings.orgTimezone'))->format($format);
    }
}
if (!function_exists('__dpDatetimeConvertOrgTZ')) {
    function __dpDatetimeConvertOrgTZ($date = null)
    {
        $result = false;
        if (!empty($date)) {
            $result = Carbon::parse($date)->timezone(config('settings.orgTimezone'))->format(config('settings.date_time_format'));
        }
        return $result;
    }
}

if (!function_exists('__dpDateConvertOrgTZ')) {
    function __dpDateConvertOrgTZ($date = null)
    {
        $result = false;
        if (!empty($date)) {
            $result = Carbon::parse($date)->timezone(config('settings.orgTimezone'))->format(config('settings.date_format'));
        }
        return $result;
    }
}

if (!function_exists('__dpDateConvert')) {
    function __dpDateConvert($date = null)
    {
        $result = false;
        if (!empty($date)) {
            $result = Carbon::parse($date)->format(config('settings.date_format'));
        }
        return $result;
    }
}

if (!function_exists('__dbDateConvertOrgTZ')) {
    function __dbDateConvertOrgTZ($date = null)
    {
        $result = false;
        if (!empty($date)) {
            $result = Carbon::parse($date)->timezone(config('settings.orgTimezone'))->format('Y-m-d');
        }
        return $result;
    }
}

if (!function_exists('__dbDateCustomConvert')) {
    function __dbDateCustomConvert($date = null, $to_format = '')
    {
        if (!empty($date) && !empty($to_format)) {
            $date = Carbon::parse($date)->format($to_format);
        }
        return $date;
    }
}
if (!function_exists('__randomColor')) {
    function __randomColor()
    {
        $str = '#';
        for ($i = 0; $i < 3; $i++) {
            $str .= dechex(rand(50, 175));
        }
        return $str;
    }
}


if (!function_exists('__showValue')) {
    function __showValue($value = "")
    {
        if(!empty($value)) {
            return $value;
        } else {
            return __("msg.na");
        }
        
    }
}

if (!function_exists('__setAutoNumber')) {
    function __setAutoNumber($prefix , $action)
    {
        $auto_numbers = \App\Models\AutoNumber::firstOrCreate(

            //where
            ['model_name' => $action['model_name'], 
            'field_name' => $action['field_name'], 
            'prefix' => $prefix
            ],

            //update if create
            ['last_seqence' => $action['start_from'] ?? 0, 'active' => 1]
        );

        $auto_numbers->increment('last_seqence');

        return $prefix.str_pad( $auto_numbers->last_seqence, $action['length'] ?? 0, $action['padding'] ?? 0, STR_PAD_LEFT);
    }
}