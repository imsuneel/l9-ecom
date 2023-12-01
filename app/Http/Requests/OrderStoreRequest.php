<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'first_name' => 'required|string|max:250',
            'lastname' => 'required|string|max:250',
            'telephone' => 'required|numeric|min:10',
            'payment_firstname' => 'required|string|max:250',
            'payment_lastname' => 'required|string|max:250',
            'payment_company' => 'required|string|max:250',
            'payment_address_1' => 'required|string|max:250',
            'payment_city' => 'required|string|max:250',
            'payment_postcode' => 'required|numeric|min:5',
            'shipping_firstname' => 'required|string|max:250',
            'shipping_lastname' => 'required|string|max:250',
            'shipping_company' => 'required|string|max:250',
            'shipping_address_1' => 'required|string|max:250',
            'shipping_city' => 'required|string|max:250',
            'shipping_postcode' => 'required|numeric|min:5',
        ];
    }
}
