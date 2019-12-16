<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\News;
use App\Http\Requests\StoreNews;
use App\Service\NewsFiles;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param boolean $archive - show archive of newss or future newss
     * @return \Illuminate\Http\Response
     */
    public function index($archive = false)
    {
        $data = [];

        $current_date = Carbon::now()->format('Y-m-d');

//        $data['newss'] = News::where('date', (($archive) ? '<=' : '>='), $current_date)->orderBy('date', 'desc')->paginate(20);
        $data['newss'] = News::where('id', '>', 0)->orderBy('date', 'desc')->paginate(20);
        $data['title'] = (($archive) ? 'Архив новостей' : 'Новости');

        return view('admin.news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('admin.news.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreNews  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNews $request)
    {

        $news = new News;
        $news->date = Carbon::parse($request->input('date'))->format('Y-m-d');

        $news->save();


        return redirect()->route('admin.news.edit', ['news' => $news->id]);
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
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $data = [];
        $data['news'] = $news;


        return view('admin.news.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreNews $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNews $request, $id)
    {
        $news = News::find($id);
        $news->update($request->all());
        $news->is_publish = $request->input('is_publish');
        $news->date = Carbon::parse($request->input('date'))->format('Y-m-d');
        $news->widget = base64_encode($request->input('widget'));
        $news->save();

        $file_handler = new NewsFiles($news, $request);
        $file_handler->save();


        return redirect()->route('admin.news.edit', ['news' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  News $news
     * @return \Illuminate\Http\Response
     * @throws null
     */
    public function destroy(News $news)
    {
        $file_handler = new NewsFiles($news);
        $file_handler->delete();
        $news->delete();
        return redirect()->route('admin.news.index');
    }

}
