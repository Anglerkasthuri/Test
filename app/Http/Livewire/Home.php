<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function mount()
    {
        if (auth()->check()) {
            if(auth()->user()->user_type == config('settings.user_type_id.staff')) {
                return redirect()->route('dashboard');
            } else if(auth()->user()->user_type == config('settings.user_type_id.student')) {
                return redirect()->route('student.dashboard');
            }
        } else {
            return redirect(route('login'));
        }
    }

}