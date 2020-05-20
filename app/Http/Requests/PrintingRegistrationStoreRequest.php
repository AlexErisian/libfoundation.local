<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintingRegistrationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO: auth
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
            'exemplars_registered_initially' => 'required|integer|min:1',
            'shelf_number' => 'nullable|integer|min:1',
            'shelf_floor' => 'nullable|integer|min:1',
            'notes' => 'nullable|max:1000',
            'printing_id' => 'required|exists:printings,id'
        ];
    }
}
