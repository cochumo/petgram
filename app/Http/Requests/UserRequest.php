<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'current-password' => [
                'required',
                'string',
                'min:8',
                function ($attribute, $value, $fail) {
                    \Debugbar::info($value);
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('現在のパスワードが違います');
                    }
                }
            ],
            'new-password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
