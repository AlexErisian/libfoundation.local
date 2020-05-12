<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReadercardFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO: auth res
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
            'code' => 'sometimes|required|integer|unique:readercards',
            'notes' => 'nullable|max:1000',
        ];
    }
}
