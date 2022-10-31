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
}
