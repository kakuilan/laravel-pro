<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/14
 * Time: 15:55
 * Desc:
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;


/**
 * Class HomeController
 * @package App\Http\Controllers\Frontend
 */
class HomeController extends Controller {


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('frontend.index');
    }

}
