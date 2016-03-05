<?php

namespace Pace\Http\Requests;

use Pace\Http\Requests\Request;

class SubEventCreateRequest extends Request
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
            'type' => 'required|in:tutorgroup,pupil,house',
            'affect_totals' => 'boolean'
        ];
    }
}
