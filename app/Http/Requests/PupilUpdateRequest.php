<?php

namespace Pace\Http\Requests;

use Pace\Http\Requests\Request;

class PupilUpdateRequest extends Request
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
            'name' => 'required|max:50|min:2',
            'email' => 'required|email|max:50|min:2',
        ];
    }
}
