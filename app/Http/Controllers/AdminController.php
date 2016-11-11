<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function overview()
    {

        $data['issues'] = Issue::all();
        $data['users'] = User::all();

        return view('admin.overview', $data);
    }
}
