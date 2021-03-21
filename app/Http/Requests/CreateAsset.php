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
            'ministry_id.required' => 'Ministry diperlukan',
            'premise_id.required' => 'Premise is required',
            'deadline.required' => 'Tarikh is required',
            'attachment.required' => 'Sila lampirkan 1 fail',
        ];
    }
}
