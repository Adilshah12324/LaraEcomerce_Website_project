<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create',compact('categories','brands'));
        
    }
    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $categories = Category::findOrFail($validatedData['category_id']);

        $product = $categories->product()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1':'0',
            'status' => $request->status == true ? '1':'0',
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);
        // return $product->id;
        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';

            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $imageFile->move($uploadPath,$filename);
                $fileImagePathName = $uploadPath.'-'.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $fileImagePathName,
                ]);               
            }
          
        }
        return redirect('/admin/product')->with('message','Product Added Successfully');
    }
   
}
