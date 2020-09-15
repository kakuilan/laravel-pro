<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
//必填参数
Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return "post:{$postId},comment:{$commentId}";
});
//可选参数
Route::get('user1/{name?}', function ($name = 'John') {
    return $name;
});
//正则限制参数
Route::get('user2/{name}', function ($name) {
    return $name;
})->where('name', '[A-Za-z]+');
//路由命名
Route::get('users/profile', function () {
    $data = [
        'name' => '',
        'date' => '',
        'url' => route('profile'), //生成URL
    ];
    return view('routeview', $data);
})->name('profile');

//路由模型绑定
Route::get('usr/{user}', function (App\Models\User $user) {
    return $user->email;
});

//年龄中间件
Route::get('uage/{age?}', function ($age = 20) {
    return $age;
})->middleware('checkage');

//表单
Route::view('/form', 'form');
Route::post('/formrec', function (Request $request) {
    return json_encode($request->post());
});

