<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Http\Request;

use App\Http\Requests;

class MilestonesController extends Controller
{
    public function overview()
    {
        $milestones = Milestone::orderBy('milestone', 'asc')->get();
        return view('milestones.overview', ['milestones' => $milestones]);
    }

    public function create()
    {
        return view('milestones.create');
    }

    public function postcreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:milestones,name',
            'milestone' => 'required|date_format:Y-m-d',
        ]);

        $milestone = Milestone::all();

        $milestone = new Milestone();
        $milestone->name = $request->get('name');
        $milestone->milestone = $request->get('milestone');

        $milestone->save();

        $request->session()->flash('success.message', trans('common.milestone_was_created'));
        return redirect('admin/milestones');
    }

    public function edit($id)
    {
        $milestone = Milestone::findOrFail($id);
        return view('milestones.edit', ['milestone' => $milestone]);
    }

    public function postedit(Request $request, $id)
    {
        $milestone = Milestone::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:milestones,name,' . $milestone->id,
            'milestone' => 'required|date_format:Y-m-d',
        ]);

        $milestone->name = $request->get('name');
        $milestone->milestone = $request->get('milestone');
        $milestone->save();

        $request->session()->flash('success.message', trans('common.milestone_was_updated'));
        return redirect('admin/milestones');
    }

    public function delete(Request $request, $id)
    {
        $milestone = Milestone::findOrFail($id);

        if (count($milestone->issues) == 0 && false) {
            $milestone->delete();

            $request->session()->flash('success.message', trans('common.milestone_was_deleted'));
            return redirect('admin/milestones');
        }

        return view('milestones.delete', ['milestone' => $milestone, 'milestones' => Milestone::all()]);
    }

    public function postdelete(Request $request, $id)
    {
        $milestone = Milestone::findOrFail($id);
        
        foreach ($milestone->issues as $issue) {
            $issue->milestone_id = 0;
            $issue->save();
        }

        $milestone->delete();

        $request->session()->flash('success.message', trans('common.milestone_was_deleted'));
        return redirect('admin/milestones');
    }
}
