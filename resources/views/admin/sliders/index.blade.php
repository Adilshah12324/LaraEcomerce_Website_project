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
                    Products
                    <a href="{{url('admin/slider/create')}}" class="btn btn-primary text-white btn-sm float-end">Add Slider</a>
                </h4>
            </div>
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sliders as $slider)
                        <tr>
                            <td>{{$slider->id}}</td>
                            <td>{{$slider->title}}</td>
                            <td>{{$slider->description}}</td>
                            <td>
                                <img src="{{asset("$slider->image")}}" style="width:80px; height:80px" class=" border" alt="No Image">
                            </td>
                            <td>{{$slider->status == '1' ? 'Hidden':'Visible'}}</td>
                            <td>
                                <a href="{{url('admin/slider/'.$slider->id.'/edit')}}" class="btn btn-success">Edit</a>
                                <a href="{{url('admin/slider/'.$slider->id.'/delete')}}" onclick="return confirm('Are you sure, you want to delete this record?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan='7'>No Products Available</td>
                        </tr>
                        @endforelse
                        
                    </tbody>

                </table>

            </div>
        </div>
    </div>  
</div>
@endsection