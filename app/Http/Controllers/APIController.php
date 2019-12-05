<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Event;

class APIController extends Controller
{
    /**
     * Display a list of events
     *
     * @param boolean $archive - show archive of events or future events
     * @return \Illuminate\Http\Response
     */
    public function events($archive = false)
    {
        $data = [];

        $current_date = Carbon::now()->format('Y-m-d');

        $events = Event::select('id', 'date_begin', 'date_end', 'city', 'meeting_url', 'club_name')
            ->where('date_begin', (($archive) ? '<=' : '>='), $current_date)
            ->where('is_publish', 'yes')
            ->orderBy('date_begin', 'asc')
            ->paginate(20);

        return response()->json($events);
    }
    //
}
