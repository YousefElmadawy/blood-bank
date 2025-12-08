<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientLoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\ClientRepositoryInterface;
use App\Interfaces\GovernorateRepositoryInterface;
use App\Mail\ResetPassword;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function __construct(
        private ClientRepositoryInterface        $clientRepository,
        protected GovernorateRepositoryInterface $governorateRepository,
        protected CityRepositoryInterface        $cityRepository
    )
    {
    }

    public function getRegister(Request $request)
    {
        $governorates = $this->governorateRepository->allGovornorates();
        $bloodTypes = $this->governorateRepository->allBloodTypes();
        return view('front.auth.sign-up', compact('governorates', 'bloodTypes'));
    }

    public function getCities($id)
    {
        $cities = $this->cityRepository->filterCities($id);
        return response()->json($cities);
    }

    public function register(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'unique:clients,email'],
            'phone'         => ['required', 'string', 'unique:clients,phone', 'max:20'],
            'password'      => ['required', 'confirmed', Password::min(8)],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'blood_type'    => ['required', 'exists:blood_types,id'],
            'governorate'   => ['required', 'exists:governorates,id'],
            'city_id'       => ['nullable', 'exists:cities,id'],
        ]);

        try {
            // Don't manually hash - Client model has 'hashed' cast
            $client = $this->clientRepository->register($request);

            // Sync relationships
            $client->governorates()->sync($request->governorate);
            $client->bloodTypes()->sync($request->blood_type);

            // Auto-login after registration
            Auth::guard('client-web')->login($client);

            return redirect()
                ->route('client-home')
                ->with('success', 'Registration successful! Welcome to Blood Bank.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Registration failed. Please try again.');
        }
    }

    public function getLogin()
    {
        return view('front.auth.sign-in');
    }

    public function login(ClientLoginRequest $request)
    {
        try {
            $client = $this->clientRepository->login($request);

            if ($client && Hash::check($request->password, $client->password)) {
                Auth::guard('client-web')->login($client, $request->boolean('remember'));

                $request->session()->regenerate();

                return redirect()
                    ->intended(route('client-home'))
                    ->with('success', 'Welcome back, ' . $client->name . '!');
            }

            return redirect()
                ->back()
                ->withInput($request->only('phone'))
                ->with('error', 'Invalid credentials. Please check your phone and password.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput($request->only('phone'))
                ->with('error', 'Login failed. Please try again.');
        }
    }

    public function getProfile()
    {
        $client = Auth::guard('client-web')->user();

        if (!$client) {
            return redirect()->route('getLogin');
        }

        $bloodTypes = $this->governorateRepository->allBloodTypes();
        $governorates = $this->governorateRepository->allGovornorates();

        return view('front.auth.edit-profile', compact('governorates', 'bloodTypes', 'client'));
    }

    public function editProfile(ProfileRequest $request)
    {
        $client = Auth::guard('client-web')->user();

        if (!$client) {
            return redirect()->route('getLogin');
        }

        try {
            $attributes = $request->validated();

            // Only hash password if provided
            if (!empty($request->password)) {
                $attributes['password'] = $request->password; // Model will auto-hash
            } else {
                unset($attributes['password']);
            }

            $this->clientRepository->profile($client, $attributes);

            return redirect()
                ->route('getProfile')
                ->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Profile update failed. Please try again.');
        }
    }

    public function forgetPassword()
    {
        return view('front.auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['required', 'numeric', 'exists:clients,phone'],
        ]);

        try {
            $client = $this->clientRepository->resetPassword($request);

            if (!$client) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'No account found with this phone number.');
            }

            // Generate 6-digit code
            $code = rand(100000, 999999);

            $client->update(['pin_code' => $code]);

            // Send email (removed hardcoded BCC)
            Mail::to($client->email)->send(new ResetPassword($client));

            return redirect()
                ->back()
                ->with('success', 'Password reset code sent to your email!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to send reset code. Please try again.');
        }
    }

    public function GetChangePassword()
    {
        return view('front.auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'pin_code' => ['required', 'numeric', 'digits:6'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        try {
            $client = $this->clientRepository->newPassword($request);

            if (!$client) {
                return redirect()
                    ->back()
                    ->with('error', 'Invalid or expired PIN code.');
            }

            // Update password and clear PIN code
            $client->update([
                'password' => $request->password, // Model will auto-hash
                'pin_code' => null, // Clear used PIN
            ]);

            return redirect()
                ->route('getLogin')
                ->with('success', 'Password changed successfully! Please login.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Password change failed. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('client-web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('getLogin')
            ->with('success', 'You have been logged out successfully.');
    }
}
