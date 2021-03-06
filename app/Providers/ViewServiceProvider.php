<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/15
 * Time: 17:44
 * Desc: 视图服务器提供器
 */

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * 注册任何应用服务
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * 引导任何应用服务
     *
     * @return void
     */
    public function boot()
    {
        // 使用基于合成器的类
        View::composer(
            'profile', 'App\Http\View\Composers\ProfileComposer'
        );

        // 使用基于合成器的闭包
        View::composer('dashboard', function ($view) {
            //
        });
    }
}
