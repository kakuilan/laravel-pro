<?php

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


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
Route::any('/formrec', function (Request $request) {
    $arr = [
        'path' => $request->path(),
        'url' => $request->url(),
        'furl' => $request->fullUrl(),
        'post' => $request->post(),
        'method' => $request->method(),
        'all' => $request->all(),
        'status1' => $request->old('status'),
        'status2' => session('status'),
    ];
    return json_encode($arr);
});

//单行为控制器
Route::get('showprofile', App\Http\Controllers\ShowProfile::class);

//资源路由
Route::resource('photos', App\Http\Controllers\PhotoController::class);
//隐含的路由
//HTTP方法 	    URI 	        动作 	路由名称
//GET 	    /photos 	        index 	photos.index
//GET 	    /photos/create 	    create 	photos.create
//POST 	    /photos 	        store 	photos.store
//GET 	    /photos/{photo} 	show 	photos.show
//GET 	    /photos/{photo}/edit edit 	photos.edit
//PUT/PATCH /photos/{photo} 	update 	photos.update
//DELETE 	/photos/{photo} 	destroy photos.destroy

// JSON input
// {"user":{"name":"Li4","age":20},"list":[]}
Route::get('/jsontest', function (Request $request) {
    $arr = [
        'name' => $request->input('user.name'),
        'qry' => $request->query(),
    ];
    return json_encode($arr);
});

// cookie
Route::get('/cookies', function (Request $request, Response $response) {
    $arr = [
        'cook1' => $request->cookie('cook1'),
        'cook2' => Cookie::get('cook2'),
    ];
    return response(json_encode($arr))->cookie(
        'cook1', 'value', 500
    );
});

// 上传
Route::post('/upload', function (Request $request, Response $response) {
    $img = $request->file('img');
    $file1 = [
        'ext' => $img->extension(),
        'path' => $img->store('images'),
        'ok' => $img->isValid(),
    ];

    $photo = $request->photo;
    $file2 = [
        'ext' => $photo->extension(),
        'path' => $photo->store('images'),
        'ok' => $photo->isValid(),
    ];

    $arr = [
        'file1' => $file1,
        'file2' => $file2,
    ];

    return $arr;
});

//缓存中间件
Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function () {
    Route::get('privacy', function () {
        return date('Y-m-d H:i:s');
    });
    Route::get('terms', function () {
        return  date('Y-m-d H:i:s');
    });
});

// 重定向并传输数据
Route::get('redirect/flash', function () {
    return redirect('formrec')->with('status', 'old data value.');
});

// 流下载
Route::get('download/stream', function () {
    return response()->streamDownload(function () {
        echo file_get_contents(__FILE__);
    }, 'test.md');
});






