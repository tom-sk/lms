<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'slide_id' => ['integer', 'required'],
            'slide_complete' => ['boolean'],
            'topic_id' => ['integer', 'required'],
        ];
    }
}
