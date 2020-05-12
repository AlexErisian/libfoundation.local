<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintingStoreRequest extends FormRequest
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
            'title' => 'required|min:3|max:250|unique:printings',
            'printing_author_id' => 'required|integer',
            'printing_pubhouse_id' => 'required|integer',
            'printing_type_id' => 'required|integer',
            'genre_ids' => 'required|array',
            'publication_year' => 'required|integer',
            'isbn' => 'nullable|integer',
            'annotation' => 'required|max:2000',
            'picture' => 'nullable|image|max:2048',
        ];
    }
}
