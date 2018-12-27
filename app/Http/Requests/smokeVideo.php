<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class smokeVideo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'video' => 'required|file|mimes:mp4,flv,wmv,avi,mov,qt|max:10240',
        ];
    }
}
