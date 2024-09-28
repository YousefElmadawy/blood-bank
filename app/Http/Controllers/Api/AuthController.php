<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\NewPasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\ClientRepositoryInterface;
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
    

    public function __construct(private ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function register(UserRequest $request)
    {
    
        $request->merge(['password' => bcrypt($request->password)]);
        
        $client = $this->clientRepository->register($request);
      
   

        $client->governorates()->sync($request->governorate_id);
        $client->bloodTypes()->sync($request->blood_type_id);

        return $this->jsonResponse(1, 'added succssfuly', [
            'client' => $client
        ]);

        if ($request->fails()) {
            return $this->jsonResponse(0, 'Failled', $request->errors(), 400);
        }
    }

   

    public function login(Request $request)
    {
        $client = $this->clientRepository->login($request);
        // dd($client);
      
        if ($client && Hash::check($request->password, $client->password)) {
            // dd($request->all());
            //  $fcmToken='dmaTOj8zTEqrTWk2stDK-5:APA91bESXmluB4_UsbdQQs-K6rNyh7Llxu_8N4kJ-W5J7XpZbE_TykvAn8odZF4Le4DmccHOjmsoo_ydipo_P6WB1Yn2kdexUyhLK4GcuvjdmXOfyhMn7WKIOUr4VwrhBTf83QdgrZ3k';
            // $client = Client::find('id'); // 
            // $client->fcm_token = $fcmToken;
            // dd($client->fcm_token);
            
            
            $token = $client->createToken($request->userAgent());
            $client->api_token = $token->plainTextToken;

            $client->api_token = $request->input('fcm_token');
            $client->save(); 
            return $this->jsonResponse(
                1,
                'login succssfuly',
                [
                    // 'fcm_token'=>$fcmToken,
                    'api_token' => $client->api_token,
                    'client' => $client
                ]
            );
        }
        if ($request->fails()) {
            return $this->jsonResponse(0, 'failed', $request->errors());
        }
      }

    // public function updateToken(Request $request)
    // {
    //     $client =$request->user();
    //     $client->fcm_token = $request->input('fcm_token');
    //     $client->save();

    //     return response()->json(['message' => 'Token updated']);
    // }

    public function resetPassword(Request $request)
    {

         validator()->make($request->all(), [
            'phone' => 'required|numeric',
        ]);

        $client = $this->clientRepository->resetPassword($request);

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

    public function newPassworrd(NewPasswordRequest $request)
    {
        // find the code
        $client = $this->clientRepository->newPassword($request);

        if (!$client) {
            return response()->json(['message' => 'Invalid PIN code or expired'], 400);
        }

        $client->password = Hash::make($request->password);
        $client->save();

        return response(['message' => 'password has been successfully reset'], 200);
    }

    public function profile(ProfileRequest $request ,Client $client)
    {

        $request->merge([
            'password' => bcrypt($request->password),
        ]);


        $client = $this->clientRepository->profile($client , $request->all());


        // if ($request->has('governorate_id')) {
        //     $client->governorates()->sync($request->governorate_id);
        // }

        // if ($request->has('blood_type_id')) {
        //     $client->bloodTypes()->sync($request->blood_type_id);
        // }
        return $this->jsonResponse(1, 'User Data', $client);

        if ($request->fails()) {
            return $this->jsonResponse(0, 'Failled', $request->errors());
        }
    }
}
