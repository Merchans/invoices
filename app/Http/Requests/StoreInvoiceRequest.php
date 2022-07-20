<?php

namespace App\Http\Requests;

use App\Rules\CompanyExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreInvoiceRequest extends FormRequest
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
            'receiver' => [
                'required',
                'digits:8',
                'numeric',
                'copamyexists'
            ],
            'supplier' => [
                'required',
                'digits:8',
                'numeric',
                'copamyexists'
                
            ],
            'descriptions' => 'required',
            'descriptions.*' => 'required',
            'quantities' => 'required',
            'quantities.*' => 'required|min:1',
            'price_per_units' => 'required',
            'price_per_units.*' => 'required|min:1',
        ];
    }

    public function messages()
    {
        $error = [
            'required' => __('Field is required'),
            'size' => __('The registration number must contain 8 numbers.'),
            'numeric' => __('The field must be a number'),
        ];

        return [
            'receiver.required' => $error['required'],
            'receiver.digits' => $error['size'],
            'receiver.numeric' => $error['size'],
            'supplier.required' => $error['required'],
            'supplier.digits' => $error['size'],
            'supplier.numeric' => $error['size'],
            'amount.required' => $error['required'],
            'amount.numeric' => $error['numeric'],
        ];
    }
}
