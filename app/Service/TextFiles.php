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
use App\Text;
use Illuminate\Support\Str;

class TextFiles
{
    /**
     * @var FormRequest $request
     * Current Request instance
     */
    private $request;

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
     * @var string $dirname
     * Name of Text files directory
     */
    private $dirname = 'TextFiles';

    /**
     * @var string $upload_path
     * Path to public image in filesystem.
     */
    private $upload_path;


    /**
     * EventFiles constructor.
     * @param FormRequest $request|null
     */
    public function __construct(FormRequest $request = null)
    {
        $this->request  = $request;
        $this->upload_path = 'public' . DIRECTORY_SEPARATOR . $this->dirname;

    }

    /**
     * @return string
     */
    public function save()
    {
        if ($this->request->hasFile('upload')) {

            $originName = $this->request->file('upload')->getClientOriginalName();

            $fileName = Str::slug(pathinfo($originName, PATHINFO_FILENAME));

            $extension = $this->request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $type = $this->request->file('upload')->getClientMimeType();

            // Save big image
            $path = $this->request->file('upload')->storeAs(
                $this->upload_path, $fileName
            );

            $CKEditorFuncNum = $this->request->input('CKEditorFuncNum');
            $url = asset('storage' . DIRECTORY_SEPARATOR . $this->dirname . DIRECTORY_SEPARATOR . $fileName);
            $msg = 'Файл загружен';

            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            return $response;

        }
    }

    /**
     * @return void
     */
    public function delete()
    {
    }

    /**
     * Resizes public image to dimensions needed for show on event page and events lists
     * @param string $path
     * @return void
     */
    private function makePublicCover($path)
    {
//        dd(storage_path($path));
        $image = ImageFacade::make($path);

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

}