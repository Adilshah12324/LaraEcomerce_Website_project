<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function wishlist($id)
    {
        // $wishlist = Product::find($id);
        $wishlist = Wishlist::where("product_id",$id)->where('user_id',Auth::id())->first();

        if (Auth::check()) {
            if ($wishlist) {
                return redirect()->back()->with('message','Product Already Exist In Wishlist');    
            } else {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
        
                ]);
                return redirect()->back()->with('message','Product Added In Wishlist Successfully');
            }   
        } else {
            return redirect()->back()->with('message','Please Login To Continue');
        }

    }
    public function index()
    {
        $wishlist = Wishlist::where('user_id',auth()->user()->id)->get();

        
        
        return view('frontend.wishlist.index',compact('wishlist'));
        # code...
    }
    public function destroy($id)
    {
        Wishlist::find($id)->delete();
        return redirect()->back()->with('message','Product Delete From Wishlist Successfully');
        # code...
    }
    // public function wishCountShow()
    // {
    //     $wishCount = Wishlist::where('user_id',Auth::id())->count();
    //                 if ($wishCount) {
    //                     return view('layouts.inc.frontend.navbar',compact('wishCount'));
    //                 }
    //     # code...
    // }
}
