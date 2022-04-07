<?php

namespace Dawnstar\Popup\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PopupRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status' => ['required'],
            'devices' => ['required', 'array'],
            'type' => ['required', 'numeric'],
            'star_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'display' => ['required', 'numeric'],
            'urls' => ['nullable', 'array'],
            'limit' => ['required', 'numeric'],
            'limit_count' => ['required_if:limit,2', 'required_if:limit,3', 'numeric', 'min:0'],
            'trigger' => ['required', 'numeric'],
            'trigger_count' => ['required_if:trigger,2', 'required_if:trigger,3', 'numeric', 'min:0'],
            'display_second' => ['nullable', 'numeric', 'min:0'],
            'show_name' => ['required', 'boolean'],

            'translations.*.name' => ['required_if:languages.*,1'],
            'translations.*.detail' => ['required_if:languages.*,1'],
        ];
    }

    public function attributes()
    {
        return __('Popup::general.labels');
    }
}
