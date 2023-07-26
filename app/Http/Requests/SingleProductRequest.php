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
            "productId" => ['int', 'required', 'exists:products,id',],
            "email" => ["email", "required"],
            "paymentMethod" => ["string","required"],
        ];
    }

    public function toDto(): SingleProductData
    {
        return new SingleProductData(
            productId: $this->validated('productId'),
            email: $this->validated('email'),
            paymentMethod: $this->validated('paymentMethod'),
        );
    }
}
