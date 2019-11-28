<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Video;
use Symfony\Component\HttpFoundation\Request;
use App\Service\YoutubeParser;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data['videos'] = Video::select('id', 'code', 'title', 'is_publish')->orderBy('id', 'desc')->get();

        return view('admin.videos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('admin.videos.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @param YoutubeParser $parser - service for getting information about Youtube videos
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, YoutubeParser $parser)
    {
        $request->validate([
            'url' => 'required'
        ]);

        $info = $parser->parse($request->input('url'));

        $video = new Video();
        $video->title = $info['title'];
        $video->code  = $info['code'];

        $video->save();

        return redirect()->route('admin_videos_index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Video $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $data = [];
        $data['video'] = $video;


        return view('admin.videos.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->input('exists') as $key => $value) {
            $video = Video::find($key);
            $video->is_publish = $request->input('is_publish')[$key] ?? 'no';
            $video->save();
        }

        foreach ($request->input('delete') as $key => $value) {
            if ($value === 'yes') {
                $video = Video::find($key);
                $video->delete();
            }
        }


        return redirect()->route('admin_videos_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Video $video
     * @return \Illuminate\Http\Response
     * @throws null
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin_videos_index');
    }
    
}
