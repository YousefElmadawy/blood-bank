<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonationRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            "id" => 43,
            "patient.name" => $this->patient_name,
            "patient.age" => $this->patient_age,
            "patient.phone" => $this->patient_phone,
            "hospital.name" => $this->hospital_name,
            "hospital.adress" => $this->hospital_adress,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "bags number" => $this->bags_num,
            "details" => $this->details,

            "blood_types" => [
                'blood_type_id'=> $this->bloodType->id,
                'blood_type_name'=> $this->bloodType->name
            ],
            "city" => [
               'city_id'=> $this->city->id,
               'city_name'=> $this->city->name
             ],

            "client" => [
                'client_id'=> $this->client->id,
                'client_name'=> $this->client->name
              ],
        ];
    }
}
