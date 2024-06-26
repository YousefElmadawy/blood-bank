<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Mail\ResetPassword;
use App\Models\Client;
use App\Models\Contact;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    use Helper;
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(UserRequest $request)
    {
        // dd($request->all());
        $request->merge(['password' => bcrypt($request->password)]);
        $client=$this->authRepository->register($request);
       
        $client->governorates()->sync($request->governorate_id);
        $client->bloodTypes()->sync($request->blood_type_id);

        return $this->jsonResponse(1, 'added succssfuly', [ 
            'client' => $client
        ]);
        
        if ($request->fails()) {
            return $this->jsonResponse(0, 'Failled', $request->errors(), 400);
        }
    }

    public function login(LoginRequest $request)
    {
      
        $client =$this->authRepository->login($request) ;

        if ($client && Hash::check($request->password, $client->password)) {
            $token = $client->createToken($request->userAgent());
            $client->api_token = $token->plainTextToken;
            $client->save();
            return $this->jsonResponse(
                1,
                'login succssfuly',
                [
                    'api_token' => $client->api_token,
                    'client' => $client
                ]
            );
        } 
         if ($request->fails()) {
            return $this->jsonResponse(0, 'failed', $request->errors());
        }
    }

    public function resetPassword(Request $request)
    {

        $validitor = validator()->make($request->all(), [
            'phone' => 'required|numeric',
        ]);

        $client = Client::where('phone', $request->phone)->first();
        
        if ($client) {

            $code = rand(1111, 9999);
            $data = $client->update([
                'pin_code' => $code
            ]);
            if ($data) {
                //send mail with code to user e-mail 
                Mail::to($client->email)
                    ->bcc("yousefelmadawy95@gmail.com")
                    ->send(new ResetPassword($client));

                return $this->jsonResponse(
                    1,
                    'Reset succssfuly',
                    [
                        'pin_code' => $code,
                        'api_token' => $client->api_token,
                        // 'client' => $client,
                        // 'mail'=>Mail::failures()
                        'user_email' => $client->email

                    ]
                );
            } else {
                return $this->jsonResponse(
                    0,
                    'failled',
                    ['client' => $client]
                );
            }
        }
    }

    public function newPassworrd(Request $request)
    {
        $request->validate([
            'pin_code' => 'required|string|exists:clients',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        // find the code
        $client = Client::where('pin_code', $request->pin_code)
            ->where('phone', $request->phone)->first();

        if (!$client) {
            return response()->json(['message' => 'Invalid PIN code or expired'], 400);
        }

        $client->password = Hash::make($request->password);
        $client->save();

        return response(['message' => 'password has been successfully reset'], 200);
    }

    public function profile(Request $request) {

        $validitor = validator()->make($request->all(), [
            'password' => 'confirmed',
            'email'=>Rule::unique('clients')->ignore($request->id),
            'phone'=>Rule::unique('clients')->ignore($request->id),
        ]);

        if ($validitor->fails()) {
            return $this->jsonResponse(0, 'Failled', $validitor->errors());
        }
      
        $client =$request->user();
        $client->update($request->all());

        if ($request->has('password')) {
            $client->password = bcrypt($request->password);
        }

        $client->save();

        if ($request->has('governorate_id')) {
            $client->governorates()->sync($request->governorate_id);
        }

        if ($request->has('blood_type_id')) {
            $client->bloodTypes()->sync($request->blood_type_id);
        }

        return $this->jsonResponse(1, ' User Data', $client);
    }








  
}
