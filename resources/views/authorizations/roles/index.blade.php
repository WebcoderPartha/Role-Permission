@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center max-auto">
            <div class="col-md-4">
                @if(session()->has('role-create'))
                    <div class="alert alert-success">
                        {{session('role-create')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Create Role</div>
                    <div class="card-body">
                        <form action="{{route('user.role.store')}}" method="POST">
                            @csrf @method('POST')
                            <div class="form-group">
                                <label for="name">Titile</label>
                                <input type="text" placeholder="Enter role name" id="name" name="name" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
            @if($roles->isNotEmpty())
            <div class="col-md-8">
                @if(session()->has('role-delete'))
                    <div class="alert alert-success">
                        {{session('role-delete')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">All the roles list below</div>
                    <div class="card-body">
                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                             <tr>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Slug</th>
                                 <th>Edit</th>
                                 <th>Delete</th>
                             </tr>
                          </thead>
                          <tfooter>
                             <tr>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Slug</th>
                                 <th>Edit</th>
                                 <th>Delete</th>
                             </tr>
                          </tfooter>
                          <tbody>
                          @foreach($roles as $role)
                             <tr>
                                 <td>{{$role->id}}</td>
                                 <td>{{$role->name}}</td>
                                 <td>{{$role->slug}}</td>
                                 <td>
                                     <a href="{{route('user.role.edit', $role)}}" class="btn btn-success">Edit</a>
                                 </td>
                                 <td>
                                     <form action="{{route('user.role.destroy', $role)}}" method="POST">
                                         @method("DELETE") @csrf
                                         <button type="submit" class="btn btn-danger">Delete</button>
                                     </form>
                                 </td>
                             </tr>
                          @endforeach
                          </tbody>
                          </table>
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>
@endsection
