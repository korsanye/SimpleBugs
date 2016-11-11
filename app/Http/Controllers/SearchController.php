<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $this->validate($request, [
            'query' => 'required',
        ]);

        $query = $request->get('query');

        if (is_numeric($query)) {
            if ($issue = Issue::find($query)) {
                return redirect('issue/'.$issue->id);
            }
        }

        $issues = Issue::all()->filter(function($item) use ($query) {


            if(strpos(mb_strtolower($item->title), mb_strtolower($query)) !== false)
            {
                return true;
            }

            if(strpos(mb_strtolower($item->description), mb_strtolower($query)) !== false)
            {
                return true;
            }


            return false;


        });

        return view('issues.search', ['issues' => $issues]);
        
    }
}
