<?php
/**
 * Created by PhpStorm.
 * User: programmer
 * Date: 13/12/2019
 * Time: 16:22
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\StoreTextFile;
use App\Service\TextFiles;
use App\Text;

class CkeditorController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ckeditor');
    }

    /**
     * success response method.
     * @param Request $request
     * @return void
     */
    public function upload(StoreTextFile $request)
    {
        $handler = new TextFiles($request);

        $response = $handler->save();

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
    }
}