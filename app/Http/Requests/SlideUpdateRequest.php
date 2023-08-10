<?php

namespace App\Http\Requests;

use App\DataTransferObjects\SlideUpdateData;
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
            'slideId' => ['integer', 'required'],
            'slideComplete' => ['boolean'],
            'topicId' => ['integer', 'required', 'exists:topics,id'],
            'moduleId' => ['integer', 'required', 'exists:modules,id'],
        ];
    }

    public function toDto(): SlideUpdateData
    {
        return new SlideUpdateData(
            slideId: $this->validated('slideId'),
            slideComplete: $this->validated('slideComplete'),
            topicId: $this->validated('topicId'),
            moduleId: $this->validated('moduleId'),
        );
    }
}
