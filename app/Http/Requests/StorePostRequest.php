<?php

namespace App\Http\Requests;

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
        return auth()->user()?->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     * IF THE SUBMIT FORM BUTTON DOES NOTHING, THE LIST OF FIELDS IN THE RETURN IS W-R-O-N-G!!!
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required'
        ];
    }
}
