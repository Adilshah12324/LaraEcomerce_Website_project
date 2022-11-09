<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id','DESC')->paginate(10);
        return view('admin.sliders.index',compact('sliders'));
        # code...
    }
    public function create()
    {

        return view('admin.sliders.create');
        # code...
    }
    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();
        $slider = new Slider();

        $uploadPath = 'uploads/slider/';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $a = $file->move('uploads/slider/',$filename);
            $slider->image = $uploadPath.$filename;
        }

        $slider->title = $validatedData['title'];
        $slider->description = $validatedData['description'];
        $slider->status = $request->status == true ? '1':'0';
        $slider->save();
        
        return  redirect('admin/slider')->with('message','Slider Added Successfully');

    }
    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.sliders.edit',compact('slider'));
        # code...
    }
    public function update(SliderFormRequest $request, $id)
    {
        $validatedData = $request->validated();
        $slider = Slider::find($id);
        $uploadPath = 'uploads/slider/';

        if ($request->hasFile('image')) {
            $path = 'uploads/slider/'.$slider->image;
            if (File::exists($path)) {
                File::delete($path);
                # code...
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $a = $file->move('uploads/slider/',$filename);
            $slider->image = $uploadPath.$filename;
        }

        $slider->title = $validatedData['title'];
        $slider->description = $validatedData['description'];
        $slider->status = $request->status == true ? '1':'0';
        $slider->update();
        
        return  redirect('admin/slider')->with('message','Slider Updated Successfully');
    }
    public function destroy($id)
    {
        $delete = Slider::find($id)->delete();
        return  redirect('admin/slider')->with('message','Slider Deleted Successfully');

        # code...
    }
}
