<?php

use App\Models\role_user;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\role;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('contactos', App\Http\Controllers\ContactoController::class);

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('contactos', [App\Http\Controllers\ContactoController::class, 'index'])->name('contactos.index');
});


Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});



Route::get('/admins', function (){
   $role = role::find(1);

   return $role->User;
});

Route::get('/user', function (){
   $user = User::find(1);

   return $user->role;
});

Route::get('/createrole', function () {
    $response = role::create([
        'name'=>'user',
    ]);
    return $response;
});

Route::get('/createuser', function () {
    $response = User::create([
        'name'=>'Paulo Zabala',
        'email' => 'paulo@gmail.com',
        'password'=> bcrypt('12345678'),
    ]);
    return $response;
});

Route::get('/assignrole', function () {
    $user = User::find(2);

    $user->role()->attach([1]);

    return $user;
});