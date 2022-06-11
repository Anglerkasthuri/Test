<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use Jantinnerezo\LivewireAlert\LivewireAlert;

use Illuminate\Support\Arr;

use Carbon\Carbon;

class AdminComponent extends Component
{
    use WithPagination; 
    use LivewireAlert;

    public $page_title;

    protected $paginationTheme = 'bootstrap';
    public $isModalOpen = false;

    public $search = [], $show_filter = false;
    public $facet_data = [], $facet_filter = [], $facet_active = [];
    public $sortField = "title", $sortDirection = "ASC", $sortFieldData = [];

    public $export_fields = [];
    public $export_type = "query";

    public $model = "";
    public $record_id;
    public $fdata;

    public function mount()
    {
        $page_title = config('app.name', "Texila CMS");
        $this->search['perPage'] = config('settings.perPage');
      
        if (method_exists($this, 'customConstruct')) {
            $this->customConstruct();
        }
    }

    // Common

    public function dehydrate()
    {
        $this->dispatchBrowserEvent('dehydrateSelectPicker');
    }

    private function resetCreateForm() 
    {
        $this->record_id = null;
        $this->fdata = null;
    }

    public function openModalPopover()
    {
        // Clean errors if were visible before
        $this->resetErrorBag();
        $this->resetValidation();
                
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    public function makeModalClose() {
        $this->closeModalPopover();
        $this->resetCreateForm();
        
        $this->dispatchBrowserEvent('modalClose',['modal_id'=>'#modalCreate']);
    }

    public function search()
    {
        $this->show_filter = true;
        $this->resetPage();
        $this->index();
    }
    public function searchValue($search = [])
    {
        $this->search = $search;
        $this->search();
    }
    public function resetSearch()
    {
        $this->search = [];
        $this->show_filter = false;
        $this->search();
    }

    public function updatedSearchperPage()
    {
        $this->search();
    }

    public function setFacetValue($key, $field, $value="")
    {
        if(!empty($value)) {
            $this->facet_filter['equalTo'][$field] = $value;
            $this->facet_active[$key][$field] = $value;
            
        } else {
            unset( $this->facet_filter['equalTo'][$field] );
            unset( $this->facet_active[$key][$field] );
        }
        $this->search();
    }
    
    public function sortBy($sortField)
    {
        $this->sortField = $sortField; 
        $this->sortDirection = (!$this->sortDirection || $this->sortDirection == 'DESC') ? 'ASC' : 'DESC';
        $this->search();
        $this->sortFieldData = [];
        $this->sortFieldData[$sortField]['css_class'] = "sortby text-primary ";
        $this->sortFieldData[$sortField]['css_class'] .= ($this->sortDirection == 'DESC') ? 'asc' : 'desc';
    }

    public function create()
    {
        $this->resetCreateForm();

        if (method_exists($this, 'customCreate')) {
            $this->customCreate();
        }

        $this->openModalPopover();
    }

    public function edit($id)
    {
        $record = $this->model->findOrFail($id);
        $this->record_id = $id;
        $this->fdata = $record->toArray();
     
  
        if (method_exists($this, 'customEdit')) {
            $this->customEdit($record);
        }
    
        $this->isModalOpen = true;
        $this->openModalPopover();
        //$this->alert('success', 'sssss');
        //$this->dispatchBrowserEvent('modalOpen',['modal_id'=>'#modalCreate']);
    }

  

    public function alertMessage($name='', $type='success')
    {
        $this->alert($type,  __($this->record_id ? 'msg.update' : 'msg.create', ['name' => $name ? $name : $this->page_title]) );
    }

    public function applyFacetFilter($query) {
        return  __reportConditions($query, $this->facet_filter);
    }

    public function applyOrderBy($query) {
        return  __reportOrderBy($query, $this->sortField, $this->sortDirection);
    }

    public function exportExcel($params = "") 
    {
        $query = $this->model->with([]);
        $query = $this->applySearchFilter($query);
        $query = $this->applyFacetFilter($query);
        $query = $this->applyOrderBy($query);
        
        [$columns, $headings] = Arr::divide($this->export_fields);
        // dump($this->export_type);
        if($this->export_type == 'query') {
            // Query Method
            return (new \App\Exports\ExcelExport())
            ->setQueryBuilder($query)
            ->setFileName($this->page_title)
            ->setHeadings($headings)
            ->setColumns($columns);
        } else {
            // View Method
            return (new \App\Exports\ExcelExportFromView($query, $headings, $columns, ($params['view_file']) ?? ''))
                ->setFileName($this->page_title)
                ->download();
                // ->download($this->page_title .'.xlsx');
            
            /* Below alse works and tested */
            // return (new ExcelExportFromView())->download('FileName.xlsx');
            // return (new ExcelExportFromView($columns, $result))->download('FileName.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            // return \Maatwebsite\Excel\Facades\Excel::download(new ExcelExportFromView, 'FileName.xlsx');
        }

    }

}
