<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    public function show()
    {
        if (Auth::user()) {
            return redirect('/');
        }
        return View('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }


    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')],
            $request->get('remember_me', false))
        ) {
            return redirect()->intended('/');
        }

        return redirect('login')->with('error', true);

    }
    
}
