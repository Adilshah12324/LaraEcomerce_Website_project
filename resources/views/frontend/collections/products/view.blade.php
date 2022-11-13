@extends('layouts.app')

@section('title')
{{$category->meta_title}}

@endsection

@section('meta_keyword')
{{$category->meta_keyword}}

@endsection

@section('meta_description')
{{$category->meta_description}}

@endsection

@section('content')
    <div>
         
        <div>
           
            <div class="py-3 py-md-5">
                <div class="container">
                
                    @if (session('message'))
                        <div class="alert alert-success">{{session('message')}}</div>
                    @endif
                    <div class="row">
                        <div class="col-md-5 mt-3">
                            <div class="bg-white border">
                                {{-- {{dd($product->productImages[0]->image)}} --}}
                                <img src="{{asset($product->productImages[0]->image)}}" class="w-100" alt="Img">
                            </div>
                        </div>
                        <div class="col-md-7 mt-3">
                            <div class="product-view">
                                <h4 class="product-name">
                                    {{$product->name}}
                                </h4>
                                <hr>
                                <p class="product-path">
                                    Home / {{$product->category->name}} / {{$product->name}} 
                                </p>
                                <div>
                                    <span class="selling-price">{{$product->selling_price}}</span>
                                    <span class="original-price">{{$product->original_price}}</span>
                                </div>
                                <div>
                                    @if ($product->productColors->count() > 0)
                                        @if ($product->productColors)
                                            @foreach ($product->productColors as $item)
                                                 <input type="radio" name="colorSection" value="{{$item->id}}" > {{$item->color->name}}
                                                <label class="colorSelectionLabel" style="background-color: {{$item->color->code}}">
                                                    {{$item->color->name}}
                                                </label>
                                            @endforeach
                                        @endif
                                    @else
                                        @if ($product->quantity)
                                            <label class="btn btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                        @else
                                            <label class="btn btn-sm py-1 mt-2 text-white bg-danger">Out Of Stock</label>
                                        @endif


                                    @endif
                                </div>
                                <div class="mt-2">
                                    <div class="input-group">
                                        <span class="btn btn1"><i class="fa fa-minus"></i></span>
                                        <input type="text" value="1" class="input-quantity" />
                                        <span class="btn btn1"><i class="fa fa-plus"></i></span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="" class="btn btn1"> <i class="fa fa-shopping-cart"></i> Add To Cart</a>
                                    <a href="{{url('collections-wishlist/'.$product->id)}}" class="btn btn1"> <i class="fa fa-heart"></i> Add To Wishlist </a>
                                </div>
                                <div class="mt-3">
                                    <h5 class="mb-0">Small Description</h5>
                                    <p>
                                        {{$product->small_description}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-header bg-white">
                                    <h4>Description</h4>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- <livewire:frontend.product.view :category = "$category" :product = "$product" />  --}}
    </div>
 @endsection