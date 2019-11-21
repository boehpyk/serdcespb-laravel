<?php

namespace App\Http\Requests;

use App\Event;
use Illuminate\Foundation\Http\FormRequest;

class StoreEvent extends FormRequest
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
            'city'          => 'required|max:255',
            'date_begin'    => 'required|date_format:d.m.Y',
            'date_end'      => 'nullable|date_format:d.m.Y',
            'club_url'      => 'nullable|url',
            'meeting_url'   => 'nullable|url',
            'tickets_url'   => 'nullable|url',
        ];
    }

}
