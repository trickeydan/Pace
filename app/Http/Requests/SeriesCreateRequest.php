<?php

namespace Pace\Http\Requests;

use Pace\Http\Requests\Request;

class SeriesCreateRequest extends Request
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
            'name' => 'required|min:2|max:50',
            'awardedTo' => 'required|in:user,tutorgroup,house',
            'affectTotals' => 'boolean',
            'binary' => 'boolean'
        ];
    }
}
