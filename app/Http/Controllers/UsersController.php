<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{
    public function overview()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('users.overview', ['users' => $users]);
    }

    public function inactiveOverview()
    {
        $users = User::onlyTrashed()->orderBy('name', 'asc')->get();
        return view('users.overview', ['users' => $users]);
    }
    public function showcreate()
    {
        return view('users.create');
    }

    public function postcreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'is_admin' => 'required|boolean'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->is_admin = (boolean)$request->input('is_admin');
        $user->save();

        $request->session()->flash('success.message', trans('common.user_was_created'));
        return redirect('admin/users');

    }

    public function showedit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    public function postedit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'password' => 'confirmed',
            'is_admin' => 'required|boolean'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if(! empty($request->input('password')))
            $user->password = bcrypt($request->input('password'));

        $user->is_admin = (boolean)$request->input('is_admin');
        $user->save();

        $request->session()->flash('success.message', trans('common.user_was_updated'));
        return redirect('admin/users');

    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        return view('users.delete', ['user' => $user]);
    }

    public function activate(Request $request, $id)
    {

        User::withTrashed()->where('id', $id)->restore();

        $request->session()->flash('success.message', trans('common.user_was_activated'));
        return redirect('admin/users');
    }


    public function confirmdelete(Request $request, $id)
    {
        $user = User::findOrFail($id);

        foreach ($user->issues as $issue)
        {
            $issue->user_id = 0;
            $issue->save();
        }

        $user->delete();

        $request->session()->flash('success.message', trans('common.user_was_deleted'));
        return redirect('admin/users');
    }


}
