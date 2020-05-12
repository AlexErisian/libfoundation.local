<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintingCommentFormRequest extends FormRequest
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
            'text' => 'required|max:1000',
            'printing_id' => 'nullable|exists:printings,id',
            'user_id' => 'nullable|exists:users,id',
        ];
    }
}
