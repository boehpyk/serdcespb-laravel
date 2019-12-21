<?php

namespace App\Observers;

use App\Banner;
use Illuminate\Support\Facades\Storage;

class BannerObserver
{
    /**
     * Handle the banner "created" event.
     *
     * @param  \App\Banner  $banner
     * @return void
     */
    public function created(Banner $banner)
    {
        //
    }

    /**
     * Handle the banner "updated" event.
     *
     * @param  \App\Banner  $banner
     * @return void
     */
    public function updated(Banner $banner)
    {
        //
    }

    /**
     * Handle the banner "deleted" event.
     *
     * @param  \App\Banner  $banner
     * @return void
     */
    public function deleted(Banner $banner)
    {
        $path = 'public' . DIRECTORY_SEPARATOR . 'BannerImages' . DIRECTORY_SEPARATOR;

        if (Storage::exists($path . $banner->image)) {
            Storage::delete($path . $banner->image);
        }
    }

    /**
     * Handle the banner "restored" event.
     *
     * @param  \App\Banner  $banner
     * @return void
     */
    public function restored(Banner $banner)
    {
        //
    }

    /**
     * Handle the banner "force deleted" event.
     *
     * @param  \App\Banner  $banner
     * @return void
     */
    public function forceDeleted(Banner $banner)
    {
        //
    }
}
