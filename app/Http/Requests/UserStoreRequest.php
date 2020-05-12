<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        //TODO: change email validation
        return [
            'name' => 'required|string|between:3,100',
            'role_id' => 'required|exists:roles,id',
            'readercard_id' => 'required|exists:readercards,id',
            'is_banned' => 'nullable|boolean',
            'phone' => 'nullable|string',
            'notes' => 'nullable|max:1000',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|between:6,20|confirmed',
            'password_confirmation' => 'required|string|between:6,20',
        ];
    }
}
