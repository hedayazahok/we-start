<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'phone'=>'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'arrival_date'=>'required|date|after:yesterday',
            'departure_date'=>'required|date|after:arrival_date',
            'num_adult'=>'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Enter your name',
            'phone.required'=>'Enter your phone',
            'phone.regex'=>'Enter the right number',
            'phone.min'=>'Enter the least 10 digit',
            'arrival_date.required'=>'Enter when you want to arrive',
            'arrival_date.after'=>'Your Enter arrive date in past',
            'departure_date.required'=>'Enter when you want to leave',
            'departure_date.after'=>'Your depature date is before your arrival date',
            'num_adult.required'=>'Enter the number of people',
            'num_adult.numeric'=>'Enter right number ',
        ];
    }


}
