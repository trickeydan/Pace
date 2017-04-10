<?php

namespace App\Http\Requests\Competitions;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Competitions\Competition;

class CreateFormTwoRequest extends FormRequest
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
        $keys = array_keys(Competition::getValidContestants());
        return [
            'title' => 'required|min:5|unique:competitions,title',
            'contestable_type' => 'required|in:' . implode(',',$keys),
            'contestant_amount' => 'required|min:1|max:20'
        ];
    }

    /**
     * Get the messages to displau
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'contestable_type.required'  => 'Please provide a competition type.',
            'contestable_type.in'  => 'Please provide a valid competition type.',
        ];
    }
}
