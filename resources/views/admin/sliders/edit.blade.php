@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>
                   Add Slider
                    <a href="{{url('admin/slider')}}" class="btn btn-danger text-white btn-sm float-end">BACK</a>
                </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                            
                        @endforeach

                    </div>
                    
                @endif
                <form action="{{url('admin/slider/'.$slider->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" value="{{$slider->title}}" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="10">{{$slider->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <div class="col-md-2"><br>
                            Old Image
                            <img src="{{asset($slider->image)}}" style="width:80px; height:80px" class=" border" alt="Img">
                        </div>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Slider Status</label><br>
                        <input type="checkbox" {{$slider->status == '1'?'checked':''}} style="width:50px; height:50px;" name="status" /><br>
                        Checked = Hidden, Unchecked = Visible
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>
                </form>


            </div>
        </div>
    </div>  
</div>
@endsection