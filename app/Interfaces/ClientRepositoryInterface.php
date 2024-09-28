<?php 

namespace App\Interfaces;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\ClientLoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\Client;
use App\Models\Post;
use Illuminate\Http\Request;

interface ClientRepositoryInterface {

    public function register(UserRequest $request);
    public function allClients();
    public function login( ClientLoginRequest $request);
    public function resetPassword(Request $request);
    public function newPassword(Request $request);
    public function profile(Client $client , array $attributes);
 
}