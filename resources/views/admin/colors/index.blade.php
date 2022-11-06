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
                   Colors List
                    <a href="{{url('admin/color/create')}}" class="btn btn-primary text-white btn-sm float-end">Add Color</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($colors as $color)
                        <tr>
                            
                                <td>{{$color->id}}</td>
                                <td>{{$color->name}}</td>
                                <td>{{$color->code}}</td>
                                <td>{{$color->status ? 'Hidden':'Visible'}}</td>
                                <td>
                                    <a href="{{url('admin/color/'.$color->id.'/edit')}}" class="btn btn-success">Edit</a>
                                    <a href="{{url('admin/color/'.$color->id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure, you want to delete this record?')">Delete</a>
                                </td>
                            @empty
                                
                            
                            
                        </tr>
                        @endforelse
                    </tbody>

                </table>



            </div>
        </div>
    </div>  
</div>
@endsection