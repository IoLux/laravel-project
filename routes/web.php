<?php

use App\Models\User;
use App\Models\Article;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserCollection;
use App\Http\Controllers\HomeController;

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

//all auth route
Auth::routes();

Route::get('/users', function () {
    return UserCollection::collection(User::all());
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/home/dashboard', fn() =>view('dashboard', ["active" => "dashboard"]));

Route::get('/home/user/{user:username}', [HomeController::class, 'userIndex']);

//single view
Route::get('/home/view/{article:slug}', [HomeController::class, 'show']);

//create blog
Route::get('/home/create', fn() => view('create', ["url" => "/home/create/db", "methode" => "post"]));
Route::post('/home/create/db', [HomeController::class, 'create']);

//edit blog
Route::get('/home/edit/{article:slug}/{user:username}', fn(Article $article, $user) => view('update', [
        "url" => "/home/edit/db/" . $article->id,
        "methode" => "post",
        "article" => $article,
        "user" => $user
    ])
);
Route::post('/home/edit/db/{article:id}', [HomeController::class, 'edit']);


//detete a blog
Route::get('/home/delete/{id}', [HomeController::class, 'destroy']);


// Route::get('/users', function () {
//     return UserResource::collection(User::all());
// });

