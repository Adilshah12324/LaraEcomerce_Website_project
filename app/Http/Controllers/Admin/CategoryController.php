<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

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
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
        # code...
    }
    public function update(CategoryFormRequest $request,$category)
    {
        $categoryData = $request->validated();
        $category = Category::findOrFail($category);
        $category->name = $categoryData['name'];
        $category->slug = Str::slug($categoryData['slug']);
        $category->description = $categoryData['description'];
        if ($request->hasFile('image')) {
            $path = 'uploads/category/'.$category->image;
            if (File::exists($path)) {
                File::delete($path);
                # code...
            }
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
        $category->update();

        return redirect('admin/category')->with('message','Category Updated Successfully');
    }
    public function delete($id)
    {
      
        $category = Category::find($id);
        $path = 'uploads/category/'.$category->image;
        if (File::exists($path)) {
            File::delete($path);
            # code...
        }
        $category->delete();
        return redirect('admin/category')->with('message','Category Deleted Successfully');

        # code...
    }
    //
}
