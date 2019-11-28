<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Event;
use App\Http\Requests\StoreEvent;
use App\Files\YoutubeParser;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param boolean $archive - show archive of events or future events
     * @return \Illuminate\Http\Response
     */
    public function index($archive = false)
    {
        $data = [];

        $current_date = Carbon::now()->format('Y-m-d');

        $data['events'] = Event::where('date_begin', (($archive) ? '<=' : '>='), $current_date)->orderBy('date_begin', 'desc')->paginate(20);
        $data['title'] = (($archive) ? 'Архив концертов' : 'Будущие концерты');

        return view('admin.events.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('admin.events.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEvent  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvent $request)
    {
        $event = Event::create([
            'city'          => $request->input('city'),
            'date_begin'    => Carbon::parse($request->input('date_begin'))->format('Y-m-d')
        ]);


        return redirect()->route('admin_events_edit', ['event' => $event->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $data = [];
        $data['event'] = $event;


        return view('admin.events.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreEvent $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEvent $request, $id)
    {
        $event = Event::find($id);
        $event->update($request->all());
        $event->is_publish = $request->input('is_publish');
        $event->date_begin = Carbon::parse($request->input('date_begin'))->format('Y-m-d');
        if ($request->input('date_end') && strlen($request->input('date_end')) > 0) {
            $event->date_end = Carbon::parse($request->input('date_end'))->format('Y-m-d');
        }
        else {
            $event->date_end = null;
        }
        $event->save();

        $file_handler = new YoutubeParser($request, $event);
        $file_handler->save();


        return redirect()->route('admin_events_edit', ['event' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Event $event
     * @return \Illuminate\Http\Response
     * @throws null
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin_events_index');
    }

}
