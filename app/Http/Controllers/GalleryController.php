<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;

class GalleryController extends Controller
{
    /**
     * Show galleries list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $data['galleries'] = Gallery::where('is_publish', 'yes')->orderBy('id', 'desc')->get();

        return view('gallery.index', $data);
    }

}
