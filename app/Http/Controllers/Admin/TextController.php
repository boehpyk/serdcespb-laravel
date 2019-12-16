<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Text;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreText;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data['texts'] = Text::get();

        return view('admin.texts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('admin.texts.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreText  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreText $request)
    {
        $text = new Text();
        $text->title = $request->input('title');
        $text->slug  = $request->input('slug');

        $text->save();

        return redirect()->route('admin_texts_edit', ['slug' => $text->slug]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $text = Text::where('slug',  $slug)->first();

        $data = [];
        $data['text'] = $text;


        return view('admin.texts.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreText $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function update(StoreText $request, $slug)
    {
        $text = Text::where('slug',  $slug)->first();

        $text->title = $request->input('title');
        $text->slug = $request->input('slug');
        $text->text = $request->input('text');
//        $text->is_publish = $request->input('is_publish');
        $text->save();

        return redirect()->route('admin_texts_edit', ['slug' => $text->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Text $text
     * @return \Illuminate\Http\Response
     * @throws null
     */
    public function destroy(Text $text)
    {
        $text->delete();
        return redirect()->route('admin_texts_index');
    }
    
}
