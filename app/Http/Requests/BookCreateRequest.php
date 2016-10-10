<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BookCreateRequest extends Request
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
            'title'          => 'required|min:3|max:100',
            'author'         => 'required|min:3|max:60',
            'isbn'           => 'required|min:3|max:20',
            'quantities'     => 'required|integer|min:1',
            'shelf_location' => 'required|min:3|max:100',
        ];
    }
}
