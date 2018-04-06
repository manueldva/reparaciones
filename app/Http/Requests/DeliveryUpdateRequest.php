<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryUpdateRequest extends FormRequest
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
            'reception_id'      => 'required|unique:deliveries,reception_id,' . $this->delivery,
            'deliverDate'       => 'required|date',
            'workPrice'         => 'required',
            'workDone'          => 'required'
        ];
    }
}
