<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        return view('forgotpassword');
    }

    public function postForgotPassword(Request $request) {

        $this->validate($request, [
           'email' => 'required|email',
        ]);

        $email = $request->get('email');

        $response = Password::sendResetLink(['email' => $email], function (Message $message) use ($email) {

            $message->subject('Your reset password link');
            $message->from('support@simplebugs.net', 'SimpleBugs');

        });

        $request->session()->flash('success.message', trans('common.forgotpassword_response'));
        return redirect('forgotpassword');
    }

    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);

        $user->save();

        //Auth::login($user);
    }


    public function resetView($token)
    {
        return view('resetpassword', ['token' => $token, 'email' => Input::get('email')]);
    }

    public function postResetView(Request $request, $token)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );


        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        if ($response != Password::PASSWORD_RESET) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);
        }

        return redirect('/login');

    }
}
