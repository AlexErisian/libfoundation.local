<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookshelfFormRequest extends FormRequest
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
            'library_id' => 'nullable|exists:libraries,id',
            'printing_id' => 'nullable|exists:printings,id',
            'exemplars_registered' => 'required|integer|min:1',
            'exemplars_in_stock' =>  'required|integer|min:0',
            'shelf_number' => 'nullable|integer|min:1',
            'shelf_floor' => 'nullable|integer|min:1',
            'notes' => 'nullable|max:1000',
        ];
    }
}
