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

Route::any('/', App\Http\Controllers\Frontend\HomeController::class.'@index');
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('hello', function () {
    return 'Hello World';
});
Route::match(['get', 'post', 'put'], 'time', function () {
    return date('Y-m-d H:i:s');
});
//Route::get('/user', 'UserController@index');

//重定向
Route::redirect('/index', '/', 301);
//视图路由
Route::view('/routeview', 'routeview', ['name'=>'ZhangSan', 'date'=>date('Y-m-d H:i:s')]);

