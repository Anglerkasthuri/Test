<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

use App\Models\Campus;
use App\Models\ProgramCategory;
use App\Models\ProgramSubCategory;
use App\Models\ProgramLevel;

class Dashboards extends Component
{
    public $data;
    
    public function render()
    {
        $this->data['page_title'] = 'Dashboard';
        $this->data['campus'] = Campus::count();
        $this->data['program_category'] = ProgramCategory::count();
        $this->data['program_sub_category'] = ProgramSubCategory::count();
        $this->data['program_level'] = ProgramLevel::count();
        
        return view('livewire.student.dashboards.dashboard')->layout(config('livewire.student-layout'));
        // return view('livewire.dashboards')->layout(config('livewire.student-layout'));
    }
}
