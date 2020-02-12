<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use App\Event;
use Carbon\Carbon;

class EventController extends Controller
{

    /**
     * Show events list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $current_date = Carbon::now()->addDays(-1)->format('Y-m-d');
        $current_date = Carbon::now();

        $data = [];

        $data['events'] = Event::select('id', 'date_begin', 'title', 'meeting_url', 'tickets_url')
            ->where('date_begin', '>=', $current_date)
            ->where('is_publish', 'yes')
            ->orderBy('date_begin', 'asc')
            ->get();

        $data['banners'] = Banner::select('image', 'url')
            ->where('is_publish', 'yes')
            ->get();


        return view('events.index', $data);
    }

}
