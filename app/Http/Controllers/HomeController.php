<?php

namespace App\Http\Controllers;

use App\Slide;
use Illuminate\Http\Request;
use App\Widget;
use App\Video;
use App\Event;
use Carbon\Carbon;

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
        $current_date = Carbon::now()->addDays(-1)->format('Y-m-d');

        $data = [];

        $data['events'] = Event::select('id', 'date_begin', 'title', 'meeting_url', 'tickets_url')
            ->where('date_begin', '>=', $current_date)
            ->where('is_publish', 'yes')
            ->orderBy('date_begin', 'asc')
            ->get();

        $data['slides'] = Slide::select('id', 'date_begin', 'title', 'url', 'image')
            ->orderBy('date_begin', 'asc')
            ->get();



        return view('welcome', $data);
    }

}
