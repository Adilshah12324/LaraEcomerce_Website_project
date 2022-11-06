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
                    <a href="{{url('admin/product/create')}}" class="btn btn-primary text-white btn-sm float-end">Add Product</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->selling_price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->status == '1' ? 'Hidden':'Visible'}}</td>
                            <td>
                                <a href="{{url('admin/product/'.$product->id.'/edit')}}" class="btn btn-success">Edit</a>
                                <a href="{{url('admin/product/'.$product->id.'/delete')}}" onclick="return confirm('Are you sure, you want to delete this record?')" class="btn btn-danger">Delete</a>
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