<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Photo;
use App\Service\UploadFileService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PhotoController extends Controller
{
    /**
     * List og photos in the given gallery
     * @param Gallery $gallery
     * @return View
     */
    public function index(Gallery $gallery)
    {
        $data = [];
        $data['gallery'] = $gallery;
        $data['photos'] = $gallery->photos()->get();

        return view('admin.photos.index', $data);
    }

    /**
     * Uploads photos to the given gallery
     * @param Gallery $gallery
     * @param Request $request
     * @return Response
     */
    public function add(Gallery $gallery, Request $request)
    {
        if (null !== $request->file('photos') && count($request->file('photos')) > 0) {
            $upload_service = new UploadFileService(
                'GalleryFiles' . DIRECTORY_SEPARATOR . $gallery->id,
                $request->file('photos'),
                'image',
                false,
                null,
                null,
                ['width' => 150,'height' => 150]
            );

            $photos = $upload_service->upload();

            $gallery_photos = [];
            foreach ($photos as $item) {
                $photo = new Photo();
                $photo->image   = $item['filename'];
                $photo->thumb   = $item['thumb'];
                $photo->save();
                $gallery_photos[] = $photo;
            }
            $gallery->photos()->saveMany($gallery_photos);
            $gallery->save();

            return redirect()->route('admin.galleries.photos.list', ['gallery' => $gallery->id]);
        }
    }

    /**
     * Update/delete a bunch of photos.
     *
     * @param Gallery $gallery
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Gallery $gallery, Request $request)
    {
        foreach ($request->input('exists') as $key => $value) {
            $photo = Photo::find($key);
            $photo->is_publish = $request->input('is_publish')[$key] ?? 'no';
            $photo->title = $request->input('title')[$key];
            $photo->save();
        }

        if ($request->input('delete') !== null && count($request->input('delete')) > 0) {
            foreach ($request->input('delete') as $key => $value) {
                if ($value === 'yes') {
                    $photo = Photo::find($key);
                    $photo->delete();
                }
            }
        }


        return redirect()->route('admin.galleries.photos.list', ['gallery' => $gallery->id]);
    }

}
