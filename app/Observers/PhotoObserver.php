<?php

namespace App\Observers;

use App\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoObserver
{
    /**
     * Handle the photo "created" event.
     *
     * @param  \App\Photo  $photo
     * @return void
     */
    public function created(Photo $photo)
    {
        //
    }

    /**
     * Handle the photo "updated" event.
     *
     * @param  \App\Photo  $photo
     * @return void
     */
    public function updated(Photo $photo)
    {
        //
    }

    /**
     * Handle the photo "deleted" event.
     *
     * @param  \App\Photo  $photo
     * @return void
     */
    public function deleted(Photo $photo)
    {
        $path = 'public' . DIRECTORY_SEPARATOR . 'GalleryFiles' . DIRECTORY_SEPARATOR . $photo->gallery->id . DIRECTORY_SEPARATOR;

        if (Storage::exists($path . $photo->image)) {
            Storage::delete($path . $photo->image);
        }
        if (Storage::exists($path . $photo->thumb)) {
            Storage::delete($path . $photo->thumb);
        }
    }

    /**
     * Handle the photo "restored" event.
     *
     * @param  \App\Photo  $photo
     * @return void
     */
    public function restored(Photo $photo)
    {
        //
    }

    /**
     * Handle the photo "force deleted" event.
     *
     * @param  \App\Photo  $photo
     * @return void
     */
    public function forceDeleted(Photo $photo)
    {
        //
    }
}
