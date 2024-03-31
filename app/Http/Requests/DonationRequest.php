<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
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
            'patient_name' => 'required',
            'patient_age' => 'required|integer',
            'blood_type_id' => 'required|exists:blood_types,id',
            'bags_num' => 'required|integer|min:1',
            'hospital_name' => 'required',
            'hospital_adress' => 'required',
            'details' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'city_id' => 'required|exists:cities,id',
            'patient_phone' => 'required',
        ];
    }
}
