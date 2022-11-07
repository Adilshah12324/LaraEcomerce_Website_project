<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;

use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::orderBy('id','DESC')->paginate(10);
        return view('admin.products.index',compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::where('status','0')->get();
        return view('admin.products.create',compact('categories','brands','colors'));
        
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
            'description' => $validatedData['description'],
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
                $fileImagePathName = $uploadPath.''.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $fileImagePathName,
                ]);               
            }
          
        }
        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0,
                ]);
                # code...
            }
            # code...
        }
        return redirect('/admin/product')->with('message','Product Added Successfully');
    }
    public function edit($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::find($id);
        $product_color = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id',$product_color)->get();
        return view('admin.products.edit',compact('product','categories','brands','colors'));
        

        # code...
    }
    public function update(ProductFormRequest $request,$id)
    {
        $validatedData = $request->validated();
        $product = Category::find($validatedData['category_id'])->product()->where('id',$id)->first();

        if ($product) {
            $product->update([
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
            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/products/';
    
                foreach ($request->file('image') as $imageFile) {
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $imageFile->move($uploadPath,$filename);
                    $fileImagePathName = $uploadPath.''.$filename;
    
                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $fileImagePathName,
                    ]);               
                }
              
            }
            return redirect('/admin/product')->with('message','Product Updates Successfully');
        }

        # code...
    }
    public function destroyImage($id)
    {
        // dd($id);
        $productImage = ProductImage::findOrFail($id);
        // dd($productImage);
        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
            # code...
        }
        $productImage->delete();
        return redirect()->back()->with('message','Image Deleted Successfully');


        # code...
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                    # code...
                }
                # code...
            }
            $product->delete();
            return redirect()->back()->with('message','Product Deleted Successfully');


        }
        # code...
    }
    public function updateProdColorQty(Request $request, $prod_color_id)
    {
        
        $productColorData = Product::findOrFail($request->product_id)->productColors()->where('id',$prod_color_id)->first();
        $productColorData->update([
            'quantity' =>$request->qty,
        ]);
        return response()->json(['message'=>'Product Colors Qty Updated']);
        # code...
    }
   
}
