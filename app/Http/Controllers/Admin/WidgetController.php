<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Widget;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreWidget;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data['widgets'] = Widget::get();

        return view('admin.widgets.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('admin.widgets.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreWidget  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWidget $request)
    {
        $widget = new Widget();
        $widget->title = $request->input('title');
        $widget->code  = base64_encode($request->input('code'));

        $widget->save();

        return redirect()->route('admin_widgets_edit', ['widget' => $widget->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Widget $widget
     * @return \Illuminate\Http\Response
     */
    public function edit(Widget $widget)
    {
        $data = [];
        $data['widget'] = $widget;


        return view('admin.widgets.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreWidget $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreWidget $request, $id)
    {
        $widget = Widget::find($id);
        $widget->title = $request->input('title');
        $widget->code = base64_encode($request->input('code'));
        $widget->is_publish = $request->input('is_publish');
        $widget->save();

        return redirect()->route('admin_widgets_edit', ['widget' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Widget $widget
     * @return \Illuminate\Http\Response
     * @throws null
     */
    public function destroy(Widget $widget)
    {
        $widget->delete();
        return redirect()->route('admin_widgets_index');
    }
    
}
