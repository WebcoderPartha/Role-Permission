<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){

    Route::put('admin/user/{user}/attach', 'UserController@attach')->name('user.role.attach');
    Route::put('admin/user/{user}/detach', 'UserController@detach')->name('user.role.detach');
    Route::put('admin/user/{user}/update', 'UserController@update')->name('user.update');


    Route::post('admin/user/role/store', 'RoleController@store')->name('user.role.store');
    Route::delete('admin/user/role/{role}/destroy', 'RoleController@destroy')->name('user.role.destroy');

    Route::put('admin/user/role/{role}/update', 'RoleController@update')->name('user.role.update');

    Route::put('admin/user/role/{role}/attach', 'RoleController@permission_attach')->name('user.role.permission.attach');
    Route::put('admin/user/role/{role}/detach', 'RoleController@permission_detach')->name('user.role.permission.detach');
    Route::get('admin/user/role/', 'RoleController@create')->name('user.role.index');
    Route::get('admin/user/permission', 'PermissionController@create')->name('user.permission.index');


});

Route::middleware(['auth', 'can:view,user'])->group(function (){
    Route::get('admin/user/{user}/edit','UserController@edit')->name('user.edit');
});

Route::middleware(['auth', 'role:administrator'])->group(function (){
    Route::post('admin/user/permission/store', 'PermissionController@store')->name('user.permission.stroe');
    Route::delete('admin/user/permission/{permission}/destroy', 'PermissionController@destroy')->name('user.permission.destroy');
});
Route::middleware(['auth', 'can:view,role'])->group(function (){
    Route::get('admin/user/role/{role}/edit', 'RoleController@edit')->name('user.role.edit');
});
