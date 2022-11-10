@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Brand
                    <a href="{{url('admin/brand')}}" class="btn btn-primary text-white btn-sm float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
            <form action="{{url('admin/brand/'.$brand->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-6 mb-3">
                    <label>Categories</label>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == $brand->category_id ? 'selected':''}}>
                                {{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" value="{{$brand->name}}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" value="{{$brand->slug}}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <input type="checkbox" {{$brand->status == '1'?'checked':''}} name="status">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary ">Update</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection