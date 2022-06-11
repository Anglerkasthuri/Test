<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Logout extends Component
{
    public function mount()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
        // auth()->logout();
        // dd(auth()->user()->toArray());
       
        // Auth::logout();
        // session()->flash('message', 'Account has been blocked');
        return redirect('/');
    }

}