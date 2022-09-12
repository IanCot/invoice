<?php

namespace App\Http\Requests;

use App\Rules\Nip;
use Illuminate\Foundation\Http\FormRequest;

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
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_no' =>'required|unique:invoices|max:32',
            'date_of_issue'=>'required|date',
            'seller_nip' => new Nip(),
            'buyer_nip' => new Nip(),
            'product' => 'required|string|max:255|not_regex:/^[\p{Cyrillic}\p{Common}]+$/u',
            'amount' =>  'required'
        ];
    }
}
