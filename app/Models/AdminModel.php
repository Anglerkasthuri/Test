<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Illuminate\Support\{Str, Arr};
// use Illuminate\Support\Arr;

use Carbon;

use App\Observers\AdminModelObserver;

class AdminModel extends Model implements HasMedia
{
    use HasFactory, SoftDeletes;
    use InteractsWithMedia;
    use LogsActivity;

    protected $log_disabled;

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->setUuid();
    //     });
    // }

    public function getActivitylogOptions(): LogOptions
    {
        if(isset($this->log_disabled) && $this->log_disabled) {
            return LogOptions::defaults()->dontSubmitEmptyLogs();
        }

        $log_options = LogOptions::defaults()
            ->dontSubmitEmptyLogs()
            ->logOnlyDirty()
            ->useLogName(class_basename($this));

        if($this->log_only || $this->log_except || $this->log_with) {
            $options = $this->fillable;
            
            if($this->log_only) {
                // $options = Arr::only($options, array_flip($this->log_only));
                $options = $this->log_only;
                // dd($options);
            }

            if($this->log_except) {
                //$options = Arr::except(Arr::flatten($options), $this->log_except);
                $options = Arr::where($options, function ($value, $key) {
                    return !in_array($value, $this->log_except) ?? $value;
                });
                //dd($options);
            }

            if($this->log_with) {
                $options = Arr::collapse([$options, $this->log_with]);
                // dd($options);
            }
            //dd($options);
            $log_options->logOnly($options);
        } else {
            $log_options->logFillable();
        }
     
        // Chain fluent methods for configuration options
        return $log_options;
    }

    protected static function boot()
    {
        // you MUST call the parent boot method 
        // in this case the \Illuminate\Database\Eloquent\Model
        parent::boot(); 

        // note I am using static::observe(...) instead of Config::observe(...)
        // this way the child classes auto-register the observer to their own class
        static::observe( AdminModelObserver::class );
    }

    public function setUuid()
    {
        $this->attributes['uuid'] = (string) Str::uuid();
    }

    public function setCreatedBy()
    {
        if(auth()->check()) $this->attributes['created_by_id'] = auth()->user()->id;
    }

    public function setUpdatedBy()
    {
        if(auth()->check()) $this->attributes['updated_by_id'] = auth()->user()->id;
    }

    public function setDeletedBy()
    {
        if(auth()->check()) $this->attributes['deleted_by_id'] = auth()->user()->id;
    }
    
    // public function setSequenceNumber()
    // {
    //     $baseClass = get_class($this);
    //     $new_class = new $baseClass;
    //     dump($baseClass, $new_class);
    //     dump($this->model, $this->fillable);
    // }
    
    public function created_by()
    {
        return $this->belongsTo(User::class);
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class);
    }

    public function deleted_by()
    {
        return $this->belongsTo(User::class);
    }

    protected function getCreatedAtDisplayAttribute()
    {
        return isset($this->attributes['created_at']) ? __dpDatetimeConvertOrgTZ($this->attributes['created_at']) : ''; 
    }

    protected function getUpdatedAtDisplayAttribute()
    {
        return isset($this->attributes['updated_at']) ? __dpDatetimeConvertOrgTZ($this->attributes['updated_at']) : ''; 
    }

    public function enableCreateLog()
    {
        $this->log_disabled = true;
    }

    // Use the below function in your Model "To Enable Log for Create"
    // public function enableCreateLog()
    // {
    //     $this->log_disabled = false;
    // }

}
