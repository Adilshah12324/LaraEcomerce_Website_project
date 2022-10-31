<div>
    
    
    
    <div class="row">
        <div class="col-md-12 ">
    
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
            <div class="card">
                <div class="card-header">
                    <h4>
                        Add Category
                        <a href="" class="btn btn-primary btn-sm float-end">Add Category</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                                
                            <tr>
                                <td>1</td>
                                <td>adil shah</td>
                                <td>Live</td>
                                <td>
                                    <a href="" class="btn btn-success">Edit</a>
                                    <a href="" onclick="return alert('Are you sure you want to delete the Record?')" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        
    
                        </tbody>
    
                    </table>
                    <div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    </div>