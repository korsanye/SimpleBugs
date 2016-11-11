<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProjectsController extends Controller
{
    public function overview()
    {
        $projects = Project::all();
        return view('projects.overview', ['projects' => $projects]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function postcreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:projects,name',
        ]);

        $project = new Project();
        $project->name = $request->get('name');
        $project->save();

        $request->session()->flash('success.message', trans('common.project_was_created'));
        return redirect('admin/projects');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', ['project' => $project]);
    }

    public function postedit(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:projects,name,' . $project->id,
        ]);

        $project->name = $request->get('name');
        $project->save();

        $request->session()->flash('success.message', trans('common.project_was_updated'));
        return redirect('admin/projects');
    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.delete', ['project' => $project]);
    }

    public function postdelete(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        foreach ($project->issues as $issue) {
            $issue->delete();
        }

        $project->delete();

        $request->session()->flash('success.message', trans('common.project_was_deleted'));
        return redirect('admin/projects');
    }
}
