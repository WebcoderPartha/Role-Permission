@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center max-auto">

            <div class="col-md-6">
                @if(session()->has('update-role'))
                    <div class="alert alert-success">
                        {{session('update-role')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Edit Role: {{$role->name}}</div>
                    <div class="card-body">
                        <form action="{{route('user.role.update', $role)}}" method="POST">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{$role->name}}" class="form-control @error('name') is-invalid @endif">
                                @error('name')
                                    {{$message}}
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if($permissions->isNotEmpty())

            <div class="row justify-content-center mx-auto mt-4">
                <div class="col-md-8">
                     <div class="card">
                         <div class="card-header">All the permissions list below</div>
                         <div class="card-body">
                             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                 <thead>
                                 <tr>
                                     <th>Options</th>
                                     <th>Name</th>
                                     <th>Slug</th>
                                     <th>Attach</th>
                                     <th>Detach</th>
                                 </tr>
                                 </thead>
                                 <tfoot>
                                 <tr>
                                     <th>Options</th>
                                     <th>Name</th>
                                     <th>Slug</th>
                                     <th>Attach</th>
                                     <th>Detach</th>
                                 </tr>
                                 </tfoot>
                                 <tbody>
                                 @foreach($permissions as $permission)
                                     <tr>
                                         <td>
                                             <input
                                                 type="checkbox"
                                                 @foreach($role->permissions as $role_permission)
                                                 @if($role_permission->slug == $permission->slug)
                                                 checked
                                                 @endif
                                                 @endforeach
                                             >
                                         </td>
                                         <td>{{$permission->name}}</td>
                                         <td>{{$permission->slug}}</td>
                                         <td>
                                             <form action="{{route('user.role.permission.attach', $role)}}" method="POST">
                                                 @csrf @method('PUT')
                                                 <input type="hidden" name="permission" value="{{$permission->id}}">
                                                 <button class="btn btn-primary" @if($role->permissions->contains($permission)) disabled @endif>Attach</button>
                                             </form>
                                         </td>
                                         <td>
                                             <form action="{{route('user.role.permission.detach', $role)}}" method="POST">
                                                 @csrf @method('PUT')
                                                 <input type="hidden" name="permission" value="{{$permission->id}}">
                                                 <button type="submit" class="btn btn-danger" @if(!$role->permissions->contains($permission)) disabled @endif>Detach</button>
                                             </form>
                                         </td>
                                     </tr>
                                 @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                </div>
            </div>

        @endif
    </div>
@endsection
