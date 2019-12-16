<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Text;

class TextController extends Controller
{
    /**
     * Show the text page according to its slug
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $text = Text::where('slug',  $slug)->first();

        $data = [];
        $data['text'] = $text;


        return view('texts.show', $data);

    }

}
