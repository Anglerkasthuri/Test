<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramCategory;
use Illuminate\Http\Request;


class ProgramCategoryController extends Controller
{
    public $id;
    public $page_records = 15;
    protected $programcategory;
    
    public function __construct(ProgramCategory $programcategory)
    {
        $this->programcategory = $programcategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query = $this->programcategory->with([]);
        $data['filter_config']['display'] = false;
        if($search_value = $request->title) { 
            $query->where('title', 'LIKE', "%$search_value%");  
            $data['filter_config']['display'] = " show "; 
        }
        if($search_value = $request->short_name) {  
            $query->where('short_name', 'LIKE', "%$search_value%");  
            $data['filter_config']['display'] = " show "; ;  
        }
        if(isset($request->active)) {  
            $search_value = $request->active;
            $query->where('active', $search_value);
            $data['filter_config']['display'] = " show "; ; 
        }
        $data['records'] =$query->paginate($this->page_records);
        // Filter Datas
        $data['filter']['active'] = [ '1' => 'Active', '0' => 'Disabled'];

        return view('admin.programcategory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->id = null;
        $data['record'] = new ProgramCategory;

       return view('admin.programcategory.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($request, $rule_set['rules'], $rule_set['messages']);
        $record = ProgramCategory::updateOrCreate(['id' => $this->id], $validatedData);  

        return redirect(route('programcategories.index'))->with('flash_message',' Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProgramCategory  $programCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramCategory $programCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProgramCategory  $programCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = ProgramCategory::findOrFail($id);
        $this->id = $record->id;
        $data['record'] = $record;

        return view('admin.programcategory.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProgramCategory  $programCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record = ProgramCategory::findOrFail($id);
        $this->id = $record->id;
        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($request, $rule_set['rules'], $rule_set['messages']);
        if(!$request->has('active')) {
            $validatedData['active'] = 0;
        }
        $record = $record->update($validatedData);  

        return redirect(route('programcategories.index'))->with('flash_message', ' Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProgramCategory  $programCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramCategory $programCategory)
    {
        //
    }

    public function validation_rules()
    {
        $rules = [
            'title' => ['required', 'max:100', "unique:program_categories,title,$this->id,id"],
            'short_name' => ['required'],
            'active' => ['nullable']
        ];

        $messages = [];

        return [
            'rules' => $rules,
            'messages' => $messages,
        ];
    }
}
