<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Banner;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreBanner;
use App\Service\UploadFileService;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data['banners'] = Banner::get();

        return view('admin.banners.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('admin.banners.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBanner  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBanner $request)
    {
        $upload_service = new UploadFileService(
            'BannerImages',
            array($request->file('image')),
            'image',
            false,
            null,
            null,
            null,
            ['width' => 250, 'height' => 354]
        );

        $img = $upload_service->upload()[0];

        $banner = new Banner();
        $banner->url  = $request->input('url');
        $banner->image = $img['filename'];

        $banner->save();


        return redirect()->route('admin.banners.edit', ['banner' => $banner->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Banner $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $data = [];
        $data['banner'] = $banner;


        return view('admin.banners.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreBanner $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBanner $request, $id)
    {
        $banner = Banner::find($id);
        $banner->url = $request->input('url');
        $banner->is_publish = $request->input('is_publish');

        if ($request->has('image')) {
            $upload_service = new UploadFileService(
                'BannerImages',
                array($request->file('image')),
                'image',
                false,
                null,
                null,
                null,
                ['width' => 250, 'height' => 354]
            );

            $img = $upload_service->upload()[0];
            $banner->image = $img['filename'];
        }
        $banner->save();

        return redirect()->route('admin.banners.edit', ['banner' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Banner $banner
     * @return \Illuminate\Http\Response
     * @throws null
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banners.index');
    }
    
}
