<?php

namespace App\Http\Requests\Competitions;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
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
        $array = [
            'title' => 'required|min:5|max:50|string',
        ];
        foreach ($this->competition->contestants as $contestant){
            $array['points' . $contestant->id] = 'required|min:0|max:10000|integer';
        }
        return $array;
    }

    /**
     * Define the error messages with the name of the Contestants in.
     *
     * @return array
     */
    public function messages(){
        $array = [];
        foreach ($this->competition->contestants as $contestant){
            $array['points' . $contestant->id . '.required'] = 'Please enter data for ' . $contestant->name . '.';
            $array['points' . $contestant->id . '.min'] = 'The data for ' . $contestant->name . ' cannot have a negative value.';
            $array['points' . $contestant->id . '.max'] = 'The data for ' . $contestant->name . ' cannot exceed 10000.';
            $array['points' . $contestant->id . '.integer'] = 'The data for ' . $contestant->name . ' must be a whole number.';
        }
        return $array;
    }
}
