@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>
                    Create Brand
                    <a href="{{url('admin/brands')}}" class="btn btn-primary text-white btn-sm float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
            <form action="{{url('admin/brand')}}" method="post">
                @csrf
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                        @error('name') <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control">
                        @error('slug') <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status">
                    </div>
                    <br>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection