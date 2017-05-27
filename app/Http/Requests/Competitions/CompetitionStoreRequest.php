<?php

namespace App\Http\Requests\Competitions;

use App\Models\Competitions\Competition;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CompetitionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
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

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'body.required'  => 'A message is required',
        ];
    }
}
