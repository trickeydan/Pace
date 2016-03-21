<?php

namespace Pace\Http\Requests;

use Pace\Http\Requests\Request;

class PupilCreateRequest extends Request
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
            'email' => 'required|max:50|min:2|email|unique,users,email',
            'name' => 'required|max:50|min:2',
            'adno' => 'required|integer|unique:users,id',
            'tutorgroup' => 'required|exists:tutorgroups,id',
            'house' => 'required|exists:houses,id',
        ];
    }
}
