<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotosRequest extends FormRequest
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
            'photo' => ['required','file','image','mimes:jpeg,png,jpg,gif','max:10000'],
            'tags' => ['nullable'],
            'message' => ['nullable', 'string', 'max:40']
        ];
    }
}
