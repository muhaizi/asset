<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAsset extends FormRequest
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
            'premise_id' => 'required|max:255',
            'ministry_id' => 'required',
            'amount' => 'required|numeric',
            'deadline' => 'required|date_format:d/m/Y',
            'attachment' => 'required|max:10000|mimes:pdf,png'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'premise_id.required' => ':ATTRIBUTE is required',
            'ministry_id.required' => ':Attribute diperlukan',
            'deadline.required' => ':Attribute is required',
            'deadline.date_format' => 'Format :attribute anda mestilah :format',
            'attachment.required' => 'Sila lampirkan 1 :attribute',
        ];
    }
}

//'deadline.date_format' => 'Format Tarikh anda mestilah dd/mm/YYYY',