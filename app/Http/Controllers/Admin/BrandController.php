<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function create()
    {
        return view('admin.brand.create');
        echo "adil";
        
    }
    public function store(Request $request)
    {

        $brand = new Brand();
        $brand->name = $request['name'];
        $brand->slug = Str::slug($request['slug']);
        $brand->status = $request->status == true ? '1':'0';
        $brand->save();

        return redirect('admin/brands')->with('message','Brand Added Successfully');
    }
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit',compact('brand'));
        
    }
    public function update(Request $request, $brand)
    {
        $brand = Brand::findOrFail($brand);
        $brand->name = $request['name'];
        $brand->slug = Str::slug($request['slug']);
        $brand->status = $request->status == true ? '1':'0';
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
