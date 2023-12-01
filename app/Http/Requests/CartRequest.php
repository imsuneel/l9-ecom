<?php

namespace App\Http\Requests;

use App\Rules\CartQuantityRule;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_id' => 'required|numeric|exists:products,id',
            'quantity' => [
                'required',
                'numeric',
                'min:1',
                new CartQuantityRule($this->product_id),
            ],
            'cart_id' => 'nullable|numeric|exists:carts,id',
        ];
    }
}
