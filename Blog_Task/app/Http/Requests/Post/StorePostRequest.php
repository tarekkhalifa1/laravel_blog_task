<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'regex:/^[a-zA-Z\s]*$/', 'unique:posts,title'],
            'content' => ['required', 'min:20'],
            'image' => ['required', 'mimes:png, jpg, webp', 'max:2048',]
        ];
    }
}
