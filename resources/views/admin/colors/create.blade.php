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
                   Add Color
                    <a href="{{url('admin/color')}}" class="btn btn-danger text-white btn-sm float-end">BACK</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{url('admin/color/create')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label>Color Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Color Code</label>
                        <input type="text" name="code" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Color Status</label><br>
                        <input type="checkbox" style="width:50px; height:50px;" name="status" /><br>
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