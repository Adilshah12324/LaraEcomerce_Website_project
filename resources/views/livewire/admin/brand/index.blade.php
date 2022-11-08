<div>
    
    @include('livewire.admin.brand.modal-form')
    <div class="row">
        <div class="col-md-12 ">
    
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
            <div class="card">
                <div class="card-header">
                    <h4>
                       
                        Brand List
                        <a href="{{url('admin/brand/create')}}" class="btn btn-primary btn-sm float-end">Add Brand</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                            
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->slug}}</td>
                            <td>{{$brand->status == '1' ? 'Hidden':'Visible'}}</td>
                            <td>
                                <a href="{{url('admin/brand/'.$brand->id.'/edit')}}" class="btn btn-success">Edit</a>
                                <a href="{{url('admin/brand/'.$brand->id)}}" onclick="return alert('Are you sure you want to delete the Record?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                       
                        <tr>
                            <td colspan="5" class="text-center">No Record Found</td>
                            
                        </tr>
                        @endforelse                        
    
                        </tbody>
    
                    </table>
                    <div>
                        {{$brands->links()}}
                    </div>
                    <div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    </div>