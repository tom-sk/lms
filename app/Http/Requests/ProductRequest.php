<?php

namespace App\Http\Requests;

use App\DataTransferObjects\ProductData;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "stripe_id" => ["string","required"],
            "type" => ["string","required"],
            "price" => ["string","required"],
        ];
    }

    public function toDto(): ProductData
    {
        return new ProductData(
            id: $this->validated('id'),
            title: $this->validated('title'),
            stripe_id: $this->validated('stripe_id'),
            type: $this->validated('type'),
            price: $this->validated('price'),
        );
    }
}
