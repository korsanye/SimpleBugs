<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Issue;
use App\Models\Milestone;
use App\Models\Post;
use App\Models\Priority;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class IssuesController extends Controller
{
    public function overview()
    {
        $issues = Issue::all()->sortBy(function($issue, $key) {
            return $issue->priority->sort;
        })->filter(function($issue, $key) {
            return !$issue->closed;
        });

        return view('issues.allissues', ['issues' => $issues]);
    }

    public function bypriority()
    {
        $priorities = Priorities::all();
        return view('issues.bypriority', ['priorities' => $priorities]);
    }

    public function byproject()
    {
        $projects = Project::all();
        return view('issues.byproject', ['projects' => $projects]);
    }

    public function myissues(Request $request)
    {
        $issues = $request->user()->issues;
        return view('issues.myissues', ['issues' => $issues]);
    }

    public function userissues($id)
    {
        $user = User::findOrFail($id);
        $issues = $user->issues;

        return view('issues.userissues', ['issues' => $issues, 'user' => $user]);
    }

    public function showissue($id)
    {
        $issue = Issue::findOrFail($id);
        return view('issues.issue', ['issue' => $issue]);
    }

    public function addcomment(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);
        $this->validate($request, [
            'comment' => 'required',
        ]);

        $post = new Post();
        $post->issue_id = $issue->id;
        $post->user_id = $request->user()->id;
        $post->content = $request->get('comment');
        $post->save();
        $issue->touch();

        //preg_match_all("/(\[@[^]]+\])/m", $post->content, $out, PREG_PATTERN_ORDER);
        //dd($out);

        return redirect('issue/' . $issue->id . "#comment_" . $post->id);
    }

    public function issueform()
    {

        $users = User::all();
        $projects = Project::all();
        $milestones = Milestone::all();
        $categories = Category::all();
        $priorities = Priority::orderBy('sort', 'asc')->get();

        return view('issues.create', [
            'users' => $users,
            'projects' => $projects,
            'milestones' => $milestones,
            'categories' => $categories,
            'priorities' => $priorities,
        ]);
    }

    public function storeissue(Request $request)
    {

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'category_id' => 'required|exists:categories,id',
            'priority_id' => 'required|exists:priorities,id',
            'milestone_id' => 'exists:milestones,id',
            'title' => 'required',
            'description' => 'required',
            'estimate' => 'string',
        ]);

        $data = $request->all();
        $data['estimate'] = toTime($request->get('estimate'));
        $data['created_by'] = $request->user()->id;
        $issue = Issue::create($data);

        return redirect('issue/' . $issue->id);

    }

    public function showEdit($id)
    {
        $issue = Issue::findOrFail($id);
        $users = User::all();
        $projects = Project::all();
        $milestones = Milestone::all();
        $categories = Category::all();
        $priorities = Priority::orderBy('sort', 'asc')->get();

        return view('issues.edit',[
                'issue' => $issue,
                'users' => $users,
                'projects' => $projects,
                'milestones' => $milestones,
                'categories' => $categories,
                'priorities' => $priorities,
            ]);
    }

    public function postEdit(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'category_id' => 'required|exists:categories,id',
            'priority_id' => 'required|exists:priorities,id',
            'milestone_id' => 'exists:milestones,id',
            'title' => 'required',
            'description' => 'required',
            'estimate' => 'string',
        ]);

        $issue->user_id = $request->get('user_id');
        $issue->project_id = $request->get('project_id');
        $issue->category_id = $request->get('category_id');
        $issue->priority_id = $request->get('priority_id');
        $issue->milestone_id = $request->get('milestone_id');
        $issue->title = $request->get('title');
        $issue->description = $request->get('description');
        $issue->estimate = toTime($request->get('estimate'));
        $issue->save();

        return redirect('issue/' . $issue->id);

    }


}
