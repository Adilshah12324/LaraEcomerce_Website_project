<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::orderBy('id','DESC')->paginate(10);
        return view('admin.colors.index',compact('colors'));
        
    }
    public function create()
    {
        return view('admin.colors.create');
        # code...
    }
    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();
        Color::create([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'status' => $request->status == true ? '1':'0',
        ]);
        
        // dd($validatedData);
        return redirect('admin/color')->with('message','Color Added Successfully');

    }
    public function edit($id)
    {
        $color = Color::find($id);
        return view('admin.colors.edit',compact('color')); 
        # code...
    }
    public function update(ColorFormRequest $request,$id)
    {
        $validatedData = $request->validated();
        Color::find($id)->update($validatedData); 

        return redirect('admin/color')->with('message','Color Updated Successfully');
        
    }
    public function destroy($id)
    {
        $color = Color::find($id)->delete();
        return redirect('admin/color')->with('message','Color Deleted Successfully');
        
        # code...
    }
}
