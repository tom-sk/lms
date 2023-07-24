<?php

namespace App\Http\Requests;

use App\DataTransferObjects\SingleProductData;
use Illuminate\Foundation\Http\FormRequest;

class SingleProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "id" => ['int', 'required', 'exists:products,id',],
            "title" => ["string"],
            "price" => ["string","required"],
        ];
    }

    public function toDto(): SingleProductData
    {
        return new SingleProductData(
            id: $this->validated('id'),
            title: $this->validated('title'),
            price: $this->validated('price'),
        );
    }
}
