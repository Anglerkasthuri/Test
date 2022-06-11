<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        // replace this with your own code
        // the user can be located with Auth facade
        
        // if (auth()->check()) {
        //     if(auth()->user()->user_type == config('settings.user_type_id.staff')) {
        //         return redirect()->route('dashboard');
        //     } else if(auth()->user()->user_type == config('settings.user_type_id.student')) {
        //         return redirect()->route('student.dashboard');
        //     }
        // }
        return redirect('/');
    }

}