<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authorizations.roles.index', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        Role::create([
            'name' => Str::ucfirst($request->name),
            'slug' => Str::of(Str::lower($request->name))->slug('-'),
        ]);

        session()->flash('role-create', $request->name.' role has been created.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('authorizations.roles.edit', ['role' => $role, 'permissions' => Permission::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->name = Str::ucfirst($request->name);
        $role->slug = Str::of(Str::lower($request->name))->slug('-');

        // isDirty  :::::::::::::::::
        if ($role->isDirty('name')){
            session()->flash('update-role', $request->name.' role has been updated.');
            $role->save();
        }else{
            session()->flash('update-role', 'Nothing has been updated.');
        }
        // isClean :::::::::::::::::
//        if ($role->isClean('name')){
//            session()->flash('update-role', 'Nothing has been updated.');
//        }else{
//            session()->flash('update-role', $request->name.' role has been updated.');
//            $role->save();
        //}


        return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Role::whereId($role->id)->delete();

        session()->flash('role-delete', $role->name.' role has been deleted.');
        return  redirect()->back();
    }

    public function permission_attach(Request $request,Role $role){
        $role->permissions()->attach($request->permission);
        session()->flash('permission-attach', 'Permission has been attached.');
        return redirect()->back();
    }

    public function permission_detach(Request $request,Role $role){
        $role->permissions()->detach($request->permission);
        session()->flash('permission-detach', 'Permission has been detached.');
        return redirect()->back();
    }


}
