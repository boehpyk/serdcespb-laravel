<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    /**
     * Show news list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['newss'] = News::select('id', 'date', 'text', 'widget')
            ->where('is_publish', 'yes')
            ->orderBy('date', 'desc')
            ->paginate(20);

        return view('news.index', $data);
    }

}
