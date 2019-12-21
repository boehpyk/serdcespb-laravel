<?php

namespace App\Http\Requests;

use App\Banner;
use Illuminate\Foundation\Http\FormRequest;

class StoreBanner extends FormRequest
{
    private $allowed_types = ['supaBoss'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        $event = Event::find((int)$this->route('event'));
        return in_array($this->user()->type, $this->allowed_types);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url'       => 'required|url',
            'image'     => 'nullable|image'
        ];
    }

}
