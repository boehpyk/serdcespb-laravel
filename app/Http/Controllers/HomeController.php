<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widget;
use App\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the main page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $data = [];
        $data['widgets'] = Widget::select('code')
            ->where('is_publish', 'yes')
            ->orderBy('id', 'asc')->get();

        $data['videos'] = Video::select('code')
            ->where('is_publish', 'yes')
            ->orderBy('id', 'desc')->get();


        return view('welcome', $data);
    }

}
