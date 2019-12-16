<?php
/**
 * Class that makes cover images for the News.
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
use App\News;

class NewsFiles
{
    /**
     * @var FormRequest $request
     * Current Request instance
     */
    private $request;

    /**
     * @var News $news
     * Instance of News model for which files are uploaded
     */
    private $news;

    /**
     * @var int $max_public_width
     * Max width for news cover used for news page
     */
    private $max_public_width    = 900;

    /**
     * @var int $max_public_height
     * Max height for news cover used for news page
     */
    private $max_public_height   = 600;

    /**
     * @var int $max_public_width
     * Max width for news cover used for lists
     */
    private $max_list_width    = 350;

    /**
     * @var int $max_public_height
     * Max height for news cover used forlists
     */
    private $max_list_height   = 350;


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
     * NewsFiles constructor.
     * @param FormRequest $request
     * @param News $news
     */
    public function __construct(News $news, FormRequest $request = null)
    {
        $this->request  = $request;
        $this->news     = $news;
        $this->filename = 'cover.jpg';
        $this->listname = 'list.jpg';
        $this->absolute_public_path = storage_path('app/public/NewsImages/'.$this->news->id);
        $this->relative_public_path = 'public/NewsImages/'.$this->news->id;

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
     * Resizes public image to dimensions needed for show on news page and newss lists
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

    /**
     * Deletes directory when article is deleted
     * @return void
     */
    public function delete()
    {
        if (Storage::exists($this->relative_public_path)) {
            Storage::deleteDirectory($this->relative_public_path);
        }
    }


}