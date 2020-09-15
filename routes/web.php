<?php

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
use App\User;
use App\Role;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/create',function(){
   $user = User::findOrFail(1);
   //$role = new Role(['name' => 'Administrator']);
   $user->roles()->save(new Role(['name' => 'Administrator']));//role_user table is also filled
});
