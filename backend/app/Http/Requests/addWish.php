<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addWish extends FormRequest
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
        if(request()->isMethod('put'))
        {
            return [
                'name' => ['required', 'min:3', 'max: 200'],
            ];
        } else {
            return [
                'name' => ['required', 'min:3', 'max: 200'],
                'url' => ['nullable'],
                'user_id' => ['required']
            ];
        }

    }
}
