<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\Client;

class AuthRepository implements AuthRepositoryInterface
{
    public function register($request){
        return  Client::create($request->all());
        
    }
    public function login($request){
        return Client::where('phone', $request->phone)->first();
        
    }

}