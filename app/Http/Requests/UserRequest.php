<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:clients',
            'date_of_birth' => 'required|date',
            'last_donation_date' => 'required|date',
            'password' => 'required|min:6',
            'city_id' => 'required',
            'blood_type_id' =>'required',
            'phone' => 'required|numeric',
        ];
    }
}
