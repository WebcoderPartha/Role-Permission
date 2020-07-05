@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('user-update'))
                    <div class="alert alert-success">
                        {{session('user-update')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Edit your profile information</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('user.update',$user)}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}">
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}">
                                    @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"></label>

                                <div class="col-md-6">
                                    <button class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('viewAny', $user)
        <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('attach'))
                    <div class="alert alert-success">
                        {{session('attach')}}
                    </div>
                @elseif(session('detach'))
                    <div class="alert alert-danger">
                        {{session('detach')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Roles</div>

                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                            <tr>
                                <th>Options</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Attach</th>
                                <th>Detach</th>
                            </tr>
                         </thead>
                         <tbody>

                         @foreach($roles as $role)
                            <tr>
                                <td><input
                                        type="checkbox"
                                        @foreach($user->roles as $user_role)
                                            @if($user_role->slug == $role->slug)
                                                checked
                                            @endif
                                        @endforeach
                                    >
                                </td>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->slug}}</td>
                                <td>
                                    <form method="POST" action="{{route('user.role.attach', $user)}}">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-success @if($user->roles->contains($role)) disabled @endif">Attach</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="{{route('user.role.detach', $user)}}">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-danger" @if(!($user->roles->contains($role))) disabled @endif>Detach</button>
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
    </div>
    @endcan



@endsection
