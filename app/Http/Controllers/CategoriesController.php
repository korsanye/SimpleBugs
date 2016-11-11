<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{

    private $icons = [
        "fa-bug",
        "fa-database",
        "fa-cube",
        "fa-flag",
        "fa-phone",
        "fa-support",
        "fa-user",
        "fa-file",
        "fa-bar-chart",
    ];

    public function overview()
    {
        $categories = Category::all();
        return view('categories.overview', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.create', ['icons' => $this->icons]);
    }

    public function postcreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
            'fa_icon' => 'required|string',
        ]);

        $category = new Category();
        $category->name = $request->get('name');
        $category->fa_icon = $request->get('fa_icon');
        $category->save();

        $request->session()->flash('success.message', trans('common.category_was_created'));
        return redirect('admin/categories');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', ['category' => $category, 'icons' => $this->icons]);
    }

    public function postedit(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:categories,name,' . $category->id,
            'fa_icon' => 'required|string',
        ]);

        $category->name = $request->get('name');
        $category->fa_icon = $request->get('fa_icon');
        $category->save();

        $request->session()->flash('success.message', trans('common.category_was_updated'));
        return redirect('admin/categories');
    }

    public function delete(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        if( count($category->issues) == 0 && false)
        {
            $category->delete();

            $request->session()->flash('success.message', trans('common.category_was_deleted'));
            return redirect('admin/categories');
        }

        return view('categories.delete', ['category' => $category, 'categories' => Category::all()]);
    }

    public function postdelete(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $this->validate($request, [
            'new_category' => 'required|exists:categories,id',
        ]);



        foreach ($category->issues as $issue) {
            $issue->category_id = $request->get('new_category');
            $issue->save();
        }

        $category->delete();

        $request->session()->flash('success.message', trans('common.category_was_deleted'));
        return redirect('admin/categories');
    }
}
