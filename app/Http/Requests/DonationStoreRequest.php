<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DonationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('client-web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_name'     => ['required', 'string', 'max:255'],
            'patient_age'      => ['required', 'integer', 'min:1', 'max:120'],
            'blood_type_id'    => ['required', 'exists:blood_types,id'],
            'city_id'          => ['required', 'exists:cities,id'],
            'hospital_name'    => ['required', 'string', 'max:255'],
            'hospital_address' => ['required', 'string', 'max:500'],
            'bags_num'         => ['required', 'integer', 'min:1', 'max:10'],
            'patient_phone'    => ['required', 'string', 'max:20'],
            'notes'            => ['nullable', 'string', 'max:1000'],
            'latitude'         => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'        => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'patient_name'     => 'patient name',
            'patient_age'      => 'patient age',
            'blood_type_id'    => 'blood type',
            'city_id'          => 'city',
            'hospital_name'    => 'hospital name',
            'hospital_address' => 'hospital address',
            'bags_num'         => 'number of bags',
            'patient_phone'    => 'patient phone',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'patient_age.min' => 'The patient age must be at least 1 year.',
            'patient_age.max' => 'The patient age cannot exceed 120 years.',
            'bags_num.min'    => 'At least 1 blood bag is required.',
            'bags_num.max'    => 'Cannot request more than 10 blood bags.',
        ];
    }
}
