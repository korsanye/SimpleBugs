<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Http\Request;

use App\Http\Requests;

class PrioritiesController extends Controller
{
    public function overview()
    {
        $priorities = Priority::orderBy('sort', 'asc')->get();
        return view('priorities.overview', ['priorities' => $priorities]);
    }

    public function create()
    {
        return view('priorities.create');
    }

    public function up(Request $request, $id)
    {
        $priority = Priority::findOrFail($id);
        $old_sort = $priority->sort;

        if ($priority->sort != 0) {
            if (!$prev_priority = Priority::where('sort', $priority->sort - 1)->first()) {
                abort(403);
            }

            $priority->sort = $old_sort - 1;
            $prev_priority->sort = $old_sort;
            $priority->save();
            $prev_priority->save();
        }

        $request->session()->flash('success.message', trans('common.priority_was_updated'));
        return redirect('admin/priorities');

    }

    public function down(Request $request, $id)
    {
        $priorities = Priority::all();
        $priority = Priority::findOrFail($id);
        $old_sort = $priority->sort;

        if ($priority->sort != count($priorities) - 1) {
            if (!$prev_priority = Priority::where('sort', $priority->sort + 1)->first()) {
                abort(403);
            }

            $priority->sort = $old_sort + 1;
            $prev_priority->sort = $old_sort;
            $priority->save();
            $prev_priority->save();
        }

        $request->session()->flash('success.message', trans('common.priority_was_updated'));
        return redirect('admin/priorities');
    }


    public function makedefault(Request $request, $id)
    {
        $priorities = Priority::all();
        $priority = Priority::findOrFail($id);
        foreach ($priorities as $prio)
        {
            $prio->default = false;
            $prio->save();
        }
        $priority->default = true;
        $priority->save();

        $request->session()->flash('success.message', trans('common.priority_was_updated'));
        return redirect('admin/priorities');
    }


    public function postcreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:priorities,name',
        ]);

        $priorities = Priority::all();

        $priority = new Priority();
        $priority->name = $request->get('name');
        $priority->sort = count($priorities);

        $priority->save();

        $request->session()->flash('success.message', trans('common.priority_was_created'));
        return redirect('admin/priorities');
    }

    public function edit($id)
    {
        $priority = Priority::findOrFail($id);
        return view('priorities.edit', ['priority' => $priority]);
    }

    public function postedit(Request $request, $id)
    {
        $priority = Priority::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:priorities,name,' . $priority->id,
        ]);

        $priority->name = $request->get('name');
        $priority->save();

        $request->session()->flash('success.message', trans('common.priority_was_updated'));
        return redirect('admin/priorities');
    }

    public function delete(Request $request, $id)
    {
        $priority = Priority::findOrFail($id);

        if (count($priority->issues) == 0 && false) {
            $priority->delete();

            $request->session()->flash('success.message', trans('common.priority_was_deleted'));
            return redirect('admin/priorities');
        }

        return view('priorities.delete', ['priority' => $priority, 'priorities' => Priority::all()]);
    }

    public function postdelete(Request $request, $id)
    {
        $priority = Priority::findOrFail($id);

        $this->validate($request, [
            'new_priority' => 'required|exists:priorities,id',
        ]);


        foreach ($priority->issues as $issue) {
            $issue->priority_id = $request->get('new_priority');
            $issue->save();
        }

        $priority->delete();

        $request->session()->flash('success.message', trans('common.priority_was_deleted'));
        return redirect('admin/priorities');
    }
}
