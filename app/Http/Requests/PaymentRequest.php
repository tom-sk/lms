<?php

namespace App\Http\Requests;

use App\DataTransferObjects\SubscriptionData;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'productId' => 'required|int',
            'coupon' => 'nullable|string',
            'paymentMethod'=> 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'productId.required' => 'Product is required!',
            'coupon.string' => 'Must be string!',
            'paymentMethod.required' => 'Must have valida payment method!'
        ];
    }

    public function toDto(): SubscriptionData
    {
        return new SubscriptionData(
            productId: $this->validated('productId'),
            paymentMethod: $this->validated('paymentMethod'),
            coupon: $this->validated('coupon'),
        );
    }
}
