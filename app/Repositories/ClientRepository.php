<?php

namespace App\Repositories;

use App\Interfaces\ClientRepositoryInterface;
use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{
    public function register($request)
    {
        return  Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'last_donation_date' => $request->last_donation_date,
          
            'blood_type_id' => $request->blood_type_id,
            'city_id' => $request->city_id,
            // 'api_token',
            // 'fcm_token'
        ]);
    }
    public function allClients()
    {
        return Client::all();
    }

    public function login($request)
    {
        return Client::where('phone', $request->phone)->first();
    }

    public function resetPassword($request)
    {
        return Client::where('phone', $request->phone)->first();
    }

    public function newPassword($request)
    {
        return Client::where('pin_code', $request->pin_code)
            ->first();
    }
    public function profile(Client $client , array $attributes)
    {
     
        return $client->update($attributes);
    }
}
