<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Gallery;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreGallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data['galleries'] = Gallery::get();

        return view('admin.galleries.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('admin.galleries.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreGallery  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGallery $request)
    {
        $gallery = new Gallery();
        $gallery->title = $request->input('title');

        $gallery->save();

        return redirect()->route('admin.galleries.edit', ['gallery' => $gallery->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $data = [];
        $data['gallery'] = $gallery;

        return view('admin.galleries.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreGallery $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGallery $request, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->update($request->all());
        $gallery->is_publish = $request->input('is_publish');
        $gallery->save();

        return redirect()->route('admin.galleries.edit', ['gallery' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gallery $gallery
     * @return \Illuminate\Http\Response
     * @throws null
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.galleries.index');
    }
    
}
