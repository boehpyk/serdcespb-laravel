<?php
/**
 * Class that makes cover images for the Event.
 * Cover file can be uploaded or generated (if not exists)
 * User: programmer
 * Date: 16/06/2019
 * Time: 14:12
 */

namespace App\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageFacade;
use Intervention\Image\Image;
use App\Event;

class EventFiles
{
    /**
     * @var FormRequest $request
     * Current Request instance
     */
    private $request;

    /**
     * @var Event $event
     * Instance of Event model for which files are uploaded
     */
    private $event;

    /**
     * @var int $max_public_width
     * Max width for event cover used for event page
     */
    private $max_public_width    = 900;

    /**
     * @var int $max_public_height
     * Max height for event cover used for event page
     */
    private $max_public_height   = 600;

    /**
     * @var int $max_public_width
     * Max width for event cover used for lists
     */
    private $max_list_width    = 249;

    /**
     * @var int $max_public_height
     * Max height for event cover used forlists
     */
    private $max_list_height   = 352;


    /**
     * @var string $absolute_public_path
     * Path to public cover image in filesystem.
     */
    private $absolute_public_path;

    /**
     * @var string $relative_public_path
     * Path to public cover image relative to storage.
     */
    private $relative_public_path;

    /**
     * @var string
     * Name of cover file. For all bopoks it's 'cover.jpg'
     */
    private $filename;


    /**
     * EventFiles constructor.
     * @param FormRequest $request
     * @param Event $event
     */
    public function __construct(FormRequest $request, Event $event)
    {
        $this->request  = $request;
        $this->event     = $event;
        $this->filename = 'cover.jpg';
        $this->listname = 'list.jpg';
        $this->absolute_public_path = storage_path('app/public/EventImages/'.$this->event->id);
        $this->relative_public_path = 'public/EventImages/'.$this->event->id;

    }

    /**
     * @return void
     */
    public function save()
    {
        if ($this->request->hasFile('cover')) {

            // Delete old cover and list
            if (Storage::exists($this->relative_public_path . '/' . $this->filename)) {
                Storage::delete($this->relative_public_path . '/' . $this->filename);
            }

            if (Storage::exists($this->relative_public_path . '/' . $this->listname)) {
                Storage::delete($this->relative_public_path . '/' . $this->listname);
            }

            // Save big image
            $this->request->cover->storeAs($this->relative_public_path, $this->filename);

            // Save list image
            Storage::copy($this->relative_public_path . '/' . $this->filename, $this->relative_public_path . '/' . $this->listname);

            // Resize public cover image
            $this->makePublicCover();

            // Resize list image
            $this->makeListCover();

        }
    }

    /**
     * Resizes public image to dimensions needed for show on event page and events lists
     * @return void
     */
    private function makePublicCover()
    {
        $image = ImageFacade::make($this->absolute_public_path . '/' . $this->filename);

        if ($image->width() >= $image->height()) {
            $image->resize(null, $this->max_public_height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        else {
            $image->resize($this->max_public_width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        $image->crop($this->max_public_width, $this->max_public_height);
        $image->save();
    }

    /**
     * Resizes list image to dimensions needed for show in lists
     * @return void
     */
    private function makeListCover()
    {
        $image = ImageFacade::make($this->absolute_public_path . '/' . $this->listname);

        if ($image->width() >= $image->height()) {
            $image->resize(null, $this->max_list_height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        else {
            $image->resize($this->max_list_width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        $image->crop($this->max_list_width, $this->max_list_height);
        $image->save();
    }


}