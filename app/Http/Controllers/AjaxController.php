<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AjaxController extends Controller
{
    public function userlist(Request $request)
    {
        $usernames = [];
        $users = User::all()->all();

        foreach($users as $user)
        {
            $usernames[] = ['id' => $user->id, 'text' => $user->name];
        }
        return response()
            ->json(['results' => $usernames])
            ->setCallback($request->input('callback'));
    }

}
