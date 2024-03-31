<?php 

namespace App\Interfaces;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\Client;
use App\Models\Post;
use Illuminate\Http\Request;

interface AuthRepositoryInterface {

    public function register(UserRequest $request);
    public function login(LoginRequest $request);
 
}