<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Slide;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreSlide;
use App\Service\CarouselFiles;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data['slides'] = Slide::get();

        return view('admin.carousel.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('admin.carousel.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSlide  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlide $request)
    {
        $slide = new Slide();
        $slide->url = $request->input('url');

        // upload and rsize image
        $file_handler = new CarouselFiles($slide, $request);
        $image = $file_handler->save();

        $slide->image = $image;

        $slide->save();

        return redirect()->route('admin_carousel_edit', ['slide' => $slide->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Slide $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        $data = [];
        $data['slide'] = $slide;


        return view('admin.carousel.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreSlide $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSlide $request, $id)
    {
        $slide = Slide::find($id);
        $slide->url = $request->input('url');

        if ($request->hasFile('cover')) {
            // upload and rsize image
            $file_handler = new CarouselFiles($slide, $request);
            $image = $file_handler->save();

            $slide->image = $image;
        }

        $slide->save();

        return redirect()->route('admin_carousel_edit', ['slide' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Slide $slide
     * @return \Illuminate\Http\Response
     * @throws null
     */
    public function destroy(Slide $slide)
    {
        $file_handler = new CarouselFiles($slide);
        $file_handler->delete();
        $slide->delete();
        return redirect()->route('admin_carousel_index');
    }
    
}
