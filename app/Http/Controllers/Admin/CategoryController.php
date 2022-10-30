<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
        # code...
    }
    public function create()
    {
        return view('admin.category.create');
        # code...
    }
    public function store(CategoryFormRequest $request)
    {
        $categoryData = $request->validated();
        $category = new Category();
        $category->name = $categoryData['name'];
        $category->slug = Str::slug($categoryData['slug']);
        $category->description = $categoryData['description'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/category/',$filename);
            $category->image = $filename;

            # code...
        }
        $category->meta_title = $categoryData['meta_title'];
        $category->meta_keyword = $categoryData['meta_keyword'];
        $category->meta_description = $categoryData['meta_description'];
        $category->status = $request->status == true ? '1':'0';
        $category->save();

        return redirect('admin/category')->with('message','Category Added Successfully');
    }
    //
}
