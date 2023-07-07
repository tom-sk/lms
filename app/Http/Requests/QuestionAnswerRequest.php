<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionAnswerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'formData.*.id' => ['required', 'exists:questions,id'],
            'formData' => ['required', 'array'],
            'formData.*.text_answer' =>['required_if:formData.*.type,"text"', 'string'],
            'formData.*.options_answer' =>['required_if:formData.*.type,"multiselect"', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'formData.*.text_answer' => 'Answer must be string',
            'formData.*.options_answer' => 'Answer must be array'
        ];
    }
}
