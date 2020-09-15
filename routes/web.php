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
Route::get('/create', function () {
    $user = User::findOrFail(1);
    //$role = new Role(['name' => 'Administrator']);
    $user->roles()->save(new Role(['name' => 'Administrator'])); //role_user table is also filled
});
Route::get('/read', function () {
    $user = User::findOrFail(1);
    //dd($user->roles);
    foreach ($user->roles as $role) {
        //dd($role);
        echo $role->name;
    }
});
Route::get('/update', function () {
    $user = User::findOrFail(1);
    if ($user->has('roles')) {
        foreach ($user->roles as $role) {
            if ($role->name == 'Administrator') {
                $role->name = 'subscriber';
                $role->save();
            }
        }
    }
});
Route::get('/delete', function () {
    $user = User::findOrFail(1);
    //$user->roles()->delete();
    foreach ($user->roles as $role) {
        //dd($role);
        $role->whereId(2)->delete();//but it doesn't delete the items in role_user table
    }
});
Route::get('/attach',function(){
     $user = User::findOrFail(1);
     $user->roles()->attach(3);//3 is the id of role that we want to attach to that user

});
Route::get('/detach',function(){
    $user = User::findOrFail(1);
    $user->roles()->detach();//if you don't pass any parameters to function detach all of the roles are gone
});
Route::get('/sync',function(){
    $user = User::findOrFail(1);
    $user->roles()->sync([3,4]);//it empties the role_user table and gives the user the roles that are in the array sync
});
