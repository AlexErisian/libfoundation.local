<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'title' => 'required|string|between:3,250|unique:posts',
            'slug' => 'nullable|string|between:3,250|unique:posts',
            'description' => 'required|max:1000',
            'content' => 'required|max:10000',
            'is_published' => 'required|boolean',
            'picture' => 'nullable|image|max:2048'
        ];
    }
}
