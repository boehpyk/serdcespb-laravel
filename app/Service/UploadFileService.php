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

class UploadFileService
{
    /**
     * @var array $files
     * array of UploadedFiles objects to upload
     */
    private $files;

    /**
     * @var string
     * Type of upload file: image or file
     */
    private $type;

    /**
     * @const array MAX_DEFAULT_DIMENSIONS
     * Default Max width and height for big images
     */
    const MAX_DEFAULT_DIMENSIONS    = [
        'width'     => 900,
        'height'    => 600
    ];

    /**
     * @var string $upload_path
     * Path to public image in filesystem.
     */
    private $upload_path;

    /**
     * Max width and height for big images passed to __constructor
     * @var array
     */
    private $max_dimensions;

    /**
     * Max width and height for thumb images passed to __constructor
     * @var array
     */
    private $thumb_dimensions;

    /**
     * name of file if needed
     * @var $filename
     */
    private $filename;

    /**
     * name of thumb file if needed
     * @var $thumbname
     */
    private $thumbname;

    /**
     * Is needed to crop big images
     * @var bool $crop
     */
    private $crop;

    /**
     * Allowed extensions
     * @const ALLOWED_EXTENSIONS
     */
    const ALLOWED_EXTENSIONS = ['pdf','jpg','jpeg','JPG','JPEG','png','gif','doc','docx','pdf'];

    /**
     * Image extensions
     * @const ALLOWED_EXTENSIONS
     */
    const IMAGE_EXTENSIONS = ['jpg','jpeg','JPG','JPEG','png','gif'];




    /**
     * EventFiles constructor.
     * @param string $dirname
     * @param array $files
     * @param string $type*
     * @param bool $crop - is needed to crop big image
     * @param string $filename - name of file if needed,
     * @param string $thumbname - name of thumb file if needed
     * @param array $max_dimensions - max allowed width and height
     * @param array $thumb_dimensions - width and height for thumbnail images ()
     */
    public function __construct(
        string $dirname,
        array $files,
        string $type            = 'image',
        bool $crop              = false,
        string $filename        = null,
        string $thumbname       = null,
        array $thumb_dimensions = null,
        array $max_dimensions   = null
    )
    {
        $this->dirname          = $dirname;
        $this->type             = $type;
        $this->files            = $files;
        $this->crop             = $crop;
        $this->filename         = $filename;
        $this->thumbname        = $thumbname;
        $this->upload_path      = 'public' . DIRECTORY_SEPARATOR . $dirname;
        $this->thumb_dimensions = $thumb_dimensions;
        $this->max_dimensions   = $max_dimensions ?? self::MAX_DEFAULT_DIMENSIONS;
    }

    /**
     * @return array
     */
    public function upload()
    {
        $res = [];
        foreach ($this->files as $file) {
            $extension = $file->getClientOriginalExtension();

            if(in_array($extension,self::ALLOWED_EXTENSIONS)) {

                $thumbname = '';

                $fileName = ($this->filename) ? $this->filename : uniqid() . '.' . $extension;

                $path = $file->storeAs(
                    $this->upload_path, $fileName
                );

                if (in_array($extension, self::IMAGE_EXTENSIONS) && $this->type == 'image') {
                    // Resize image
                    $this->resizeImage($path, $this->max_dimensions, $this->crop);
                }

                if ($this->thumb_dimensions) {
                    // Save thumb image
                    $thumbname = ($this->thumbname) ? $this->thumbname : 'sm_' . $fileName;
                    Storage::copy($path, $this->upload_path . DIRECTORY_SEPARATOR . $thumbname);

                    // Resize list image
                    $this->resizeImage($this->upload_path . DIRECTORY_SEPARATOR . $thumbname, $this->thumb_dimensions, true);
                }

                $res[] = [
                    'filename'  => $fileName,
                    'path'      => $path,
                    'thumb'     => $thumbname
                ];

            }
        }
        return $res;
    }

    /**
     * @return void
     */
    public function delete($path)
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    /**
     * Resizes public image to dimensions needed for show on event page and events lists
     * @param string $path
     * @param array $dimensions - max width and height of the image
     * @param $crop - is neede to crop reduced image
     * @return void
     */
    private function resizeImage(string $path, array $dimensions, bool $crop = true)
    {
        $path = storage_path('app' . DIRECTORY_SEPARATOR . $path);

//        dd($dimensions);
        $image = ImageFacade::make($path);

        if ($image->width() <= $dimensions['width'] && $image->height() <= $dimensions['height']) {
            return;
        }

        if ($image->width() >= $image->height()) {
            $image->resize(null, $dimensions['height'], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        else {
            $image->resize($dimensions['width'], null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        if ($crop) {
            $image->crop($dimensions['width'], $dimensions['height']);
        }
        $image->save();
    }

}