@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center max-auto">
            <div class="col-sm-4">
                @if(session()->has('create-permission'))
                    <div class="alert alert-success">
                        {{session('create-permission')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Create Permission</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('user.permission.stroe')}}">
                            @csrf @method('POST')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                                @error('name')
                                    {{$message}}
                                @enderror
                            </div>
                            <button class="btn btn-success">Create</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                @if(session()->has('delete-permission'))
                    <div class="alert alert-success">
                        {{session('delete-permission')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">All the permissions List below</div>
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
                          <tfoot>
                             <tr>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Slug</th>
                                 <th>Edit</th>
                                 <th>Delete</th>
                             </tr>
                          </tfoot>
                          <tbody>
                          @foreach($permissions as $permission)
                             <tr>
                                 <td>{{$permission->id}}</td>
                                 <td>{{$permission->name}}</td>
                                 <td>{{$permission->slug}}</td>
                                 <td><a href="" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                 <td>
                                     <form action="{{route('user.permission.destroy', $permission)}}" method="POST">
                                         @csrf @method('DELETE')
                                         <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
@endsection
