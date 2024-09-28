<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Http\Requests\ClientLoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\ClientRepositoryInterface;
use App\Interfaces\GovernorateRepositoryInterface;
use App\Mail\ResetPassword;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function __construct(private ClientRepositoryInterface $clientRepository, protected GovernorateRepositoryInterface $governorateRepository, protected CityRepositoryInterface $cityRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->governorateRepository = $governorateRepository;
        $this->cityRepository = $cityRepository;
    }


    public function getRegister(Request $request)
    {

        $governorates = $this->governorateRepository->allGovornorates();
        $bloodTypes = $this->governorateRepository->allBloodTypes();
        return view('front.auth.sign-up', compact('governorates', 'bloodTypes'));
    }

    public function getCities($id)
    {
        // $cities=City::where('governorate_id',$id)->pluck('name','id');
        $cities = $this->cityRepository->filterCities($id);
        return response()->json($cities);
    }

    public function register(Request $request)
    {
       
        $request->merge(['password' => bcrypt($request->password)]);


        $client = $this->clientRepository->register($request);
        // dd($request->all());
        $client->governorates()->sync($request->governorate);
        $client->bloodTypes()->sync($request->blood_type);

        return to_route('client-home');
    }


    public function getLogin()
    {


        return view('front.auth.sign-in');
    }

    public function login(ClientLoginRequest $request)
    {


        $client = $this->clientRepository->login($request);

        if ($client && Hash::check($request->password, $client->password)) {

            Auth::guard('client-web')->attempt($request->only('phone', 'password'));

            return to_route('client-home');
        } else {
            return redirect()->back()->with('message', 'Invalid Data!');
        }
    }
    public function getProfile(Client $client, Request $request)
    {
        $client = Auth::guard('client-web')->user();

        $bloodTypes = $this->governorateRepository->allBloodTypes();
        $governorates = $this->governorateRepository->allGovornorates();
        return view('front.auth.edit-profile', compact('governorates', 'bloodTypes', 'client'));
    }

    public function editProfile(ProfileRequest $request, Client $client)
    {
        $attributes = $request->all();

        if (!empty($request->password)) {
            $attributes['password'] = bcrypt($request->password);
        }

        $client = Auth::guard('client-web')->user();

        $this->clientRepository->profile($client, $attributes);

        // if ($request->has('governorate_id')) {
        //     $client->governorates()->sync($request->governorate_id);
        // }

        // if ($request->has('blood_type_id')) {
        //     $client->bloodTypes()->sync($request->blood_type_id);
        // }

        return to_route('client-home');
    }
    public function forgetPassword(Request $request)
    {
        return view('front.auth.reset-password');
    }

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
                return redirect()->back()->with('message', 'check your mail!');
            }
        }
    }
    public function GetChangePassword()
    {
        return view('front.auth.change-password');
    }

    public function changePassword(Request $request)
    {

        $client = $this->clientRepository->newPassword($request);


        if (!$client) {
            return redirect()->back()->with('message', 'Invalid Data!');
        }

        $client->password = Hash::make($request->password);
        $client->save();

        // return Redirect::route('client-home')->with('message', 'Password Changed sucssesfuly');
        return to_route('client-home');
    }

    public function logout(Request $request)
    {

        Auth::guard('client-web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('getLogin');
    }
}
