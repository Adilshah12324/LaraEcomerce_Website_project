<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function create()
    {
        $categories = Category::where('status','0')->get();
        return view('admin.brand.create',compact('categories'));
        echo "adil";
        
    }
    public function store(Request $request)
    {

        $brand = new Brand();
        $brand->name = $request['name'];
        $brand->slug = Str::slug($request['slug']);
        $brand->status = $request->status == true ? '1':'0';
        $brand->category_id = $request['category_id'];
        $brand->save();

        return redirect('admin/brands')->with('message','Brand Added Successfully');
    }
    public function edit(Brand $brand)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.brand.edit',compact('brand','categories'));
        
    }
    public function update(Request $request, $brand)
    {
        $brand = Brand::findOrFail($brand);
        $brand->name = $request['name'];
        $brand->slug = Str::slug($request['slug']);
        $brand->status = $request->status == true ? '1':'0';
        $brand->category_id = $request['category_id'];
        $brand->update();

        return redirect('admin/brands')->with('message','Brand Updated Successfully');
    
    }
    public function delete($id)
    {
        $delete = Brand::find($id)->delete();
        return redirect('admin/brands')->with('message','Brand Deleted Successfully');


        # code...
    }
}
