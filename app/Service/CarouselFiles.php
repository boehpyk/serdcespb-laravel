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
use Illuminate\Http\UploadedFile;
use App\Slide;

class CarouselFiles
{
    /**
     * @var FormRequest $request
     * Current Request instance
     */
    private $request;

    /**
     * @var Slide $slide
     * Instance of Event model for which files are uploaded
     */
    private $slide;

    /**
     * @var int $max_public_width
     * Max width for event cover used for event page
     */
    private $max_public_width    = 920;

    /**
     * @var int $max_public_height
     * Max height for event cover used for event page
     */
    private $max_public_height   = 212;

    /**
     * @var string $upload_path
     * Path to public cover image in filesystem.
     */
    private $upload_path;


    /**
     * EventFiles constructor.
     * @param FormRequest $request|null
     * @param Slide $slide
     */
    public function __construct(Slide $slide, FormRequest $request = null)
    {
        $this->request  = $request;
        $this->slide    = $slide;
        $this->upload_path = 'public/CarouselImages';

    }

    /**
     * @return string
     */
    public function save()
    {
        if ($this->request->hasFile('cover')) {

            // Delete old cover and list
            $old_filename = $this->upload_path . '/' . $this->slide->image;

            if (Storage::exists($old_filename)) {
                Storage::delete($old_filename);
            }

            // Save big image
            $path = Storage::putFile($this->upload_path, $this->request->file('cover'));

            $filename = basename($path);

            // Resize public cover image
            $this->makePublicCover(storage_path('app') . DIRECTORY_SEPARATOR . $path);

            return $filename;

        }
    }

    /**
     * @return void
     */
    public function delete()
    {
        $old_filename = $this->upload_path . '/' . $this->slide->image;

        if (Storage::exists($old_filename)) {
            Storage::delete($old_filename);
        }
    }

    /**
     * Resizes public image to dimensions needed for show on event page and events lists
     * @param string $path
     * @return void
     */
    private function makePublicCover($path)
    {
//        dd(storage_path($path));
        $ratio = $this->max_public_width/$this->max_public_height;

        $image = ImageFacade::make($path);

        if ($image->width()/$image->height() >= $ratio) {
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

}