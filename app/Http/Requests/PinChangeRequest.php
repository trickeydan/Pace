<?php

namespace Pace\Http\Requests;

use Pace\Http\Requests\Request;

class PinChangeRequest extends Request
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
            'pin' => 'required|confirmed|min:4|max:20'
        ];
    }
}
