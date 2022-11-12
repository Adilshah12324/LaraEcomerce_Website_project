<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status','0')->get();
        return view('frontend.index',compact('sliders'));
        # code...
    }
    public function categories()
    {
        $categories = Category::where('status','0')->get();
        return view('frontend.collections.category.index',compact('categories'));
        # code...
    }
    public function products($category_slug)
    {
        $category = Category::where('slug',$category_slug)->first();

        if ($category) {
            $products = $category->product()->get();

            return view('frontend.collections.products.index',compact('products','category'));
        }
        else{
            return redirect()->back();
        }
    }
    public function productView($category_slug,$product_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
      

        if ($category) {
            $product = $category->product()->where('slug',$product_slug)->where('status','0')->first();

            if ($product) {
                  // show count wish start
                    $wishCount = Wishlist::where('user_id',Auth::id())->count();
                    if ($wishCount) {
                        return view('layouts.inc.frontend.navbar',compact('wishCount'));
                    }
                    // show count wish start
                return view('frontend.collections.products.view',compact('product','category'));
                
            }
            else{
                return redirect()->back();
            }

        }
        else{
            return redirect()->back();
        }


        # code...
    }

    
}
