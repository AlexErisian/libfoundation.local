<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibraryServiceStoreRequest extends FormRequest
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
            'bookshelf_id' => 'required|integer|exists:bookshelves,id',
            'exemplars_in_stock' => 'required|integer',
            'exemplars_given' => 'required|integer|lte:exemplars_in_stock',
            'readercard_code' => 'required|integer|exists:readercards,code',
            'given_up_to' => 'required|date',
        ];
    }
}
