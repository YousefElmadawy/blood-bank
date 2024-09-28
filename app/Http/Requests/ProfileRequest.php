<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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


            // 'name' => 'required',
            // 'blood_type' => 'required',
            // 'governorate' => 'required',
            // 'city ' => 'r',
            // ' date_of_birth' => 'required', 'date',
            // 'last_donation_date' => 'required', 'date',
            // 'password' => 'required',
            // 'password_confirmation' => 'required',
            'email' => Rule::unique(Client::class)->ignore(Auth::guard('client-web')->user()->id),
            'phone' => Rule::unique(Client::class)->ignore(Auth::guard('client-web')->user()->id),
        ];
    }
}
