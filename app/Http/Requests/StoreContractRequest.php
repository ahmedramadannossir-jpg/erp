<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'product_name' => ['required', 'string', 'max:255'],
            'total_price' => ['required', 'numeric', 'min:0'],
            'profit_type' => ['required', 'in:percent,fixed'],
            'profit_value' => ['required', 'numeric', 'min:0'],
            'down_payment' => ['required', 'numeric', 'min:0'],
            'installments_count' => ['required', 'integer', 'min:1'],
            'delivery_date' => ['required', 'date'],
            'first_installment_mode' => ['required', 'in:auto,manual'],
            'first_installment_date' => ['nullable', 'date', 'required_if:first_installment_mode,manual'],
        ];
    }
}
