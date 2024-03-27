<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Client;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Setting;
use App\Notifications\DonationRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MainController extends Controller
{
    public function jsonResponse($status, $message, $data = null)
    {

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response);
    }

    public function governorates()
    {

        $governorates = Governorate::all();
        return $this->jsonResponse(1, 'success', $governorates);
    }

    public function cities(Request $request)
    {

        $cities = City::where('governorate_id', $request->governorate_id)->get();
        return $this->jsonResponse(1, 'success', $cities);
    }

    public function bloodTypes()
    {

        $bloodTypes = BloodType::all();
        return $this->jsonResponse(1, 'success', $bloodTypes);
    }

    public function categories()
    {

        $categories = Category::all();
        return $this->jsonResponse(1, 'success', $categories);
    }

    public function posts()
    {
        $request = request();
        $posts = Post::filter($request->query())->paginate();
        return $this->jsonResponse(1, 'success', $posts);
    }

    public function post(Post $post)
    {
        return response()->json(['message' => 'sucsses', 'data' => $post]);
    }

    public function favoritePost(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'post_id' => 'required|exists:posts,id',

        ]);

        if ($validator->fails()) {
            return $this->jsonResponse(0, 'Failled', $validator->errors(), 400);
        }

        $toggle = $request->user()->posts()->toggle($request->post_id);

        return response()->json(['message' => 'sucsses', $toggle]);
    }

    public function allFavorites(Request $request)
    {
        $posts = $request->user()->posts()->latest()->paginate(10);
        return $this->jsonResponse(1, 'get successfuly',  $posts);
    }




    public function createDonationRequest(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'patient_name' => 'required',
            'patient_age' => 'required|integer',
            'blood_type_id' => 'required|exists:blood_types,id',
            'bags_num' => 'required|integer|min:1',
            'hospital_name' => 'required',
            'hospital_adress' => 'required',
            'details' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'city_id' => 'required|exists:cities,id',
            'patient_phone' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->jsonResponse(0, "Failled Data", $validator->errors(), 400);
        }

        //create donation request
        $client = $request->user();
        // dd($client);
        $donationRequest = $client->donationRequests()->create($request->all());
        $clients = Client::all();

        if ($donationRequest) {

            $notification = $donationRequest->notifications()->create([
                'title' => 'Need Donate to new patient',
                'content' => 'Need a blood type : ' . $donationRequest->bloodType->name
            ]);

            // dd( $notification);

            if ($notification) {

                $notification->clients()->sync($clients);

                Notification::send($clients, (new DonationRequestNotification($donationRequest, $notification)));
            } 
            return $this->jsonResponse(1, "Donation Added Successfuly", $donationRequest);
        }

        // dd($donationRequest);
        //find client sutible for this request
        // $clientsIds = $donationRequest->city->governorate->clients()
        //     ->whereHas('bloodTypes', function ($query) use ($donationRequest) {
        //         $query->where('blood_types.id', $donationRequest->blood_type_id);
        //     })->pluck('clients.id')->toArray();
        // $clientsIds = Client::whereHas('governorates', function ($query)  use ($donationRequest) {
        //     $query->where('governorate_id', $donationRequest->city->governorate->governorate_id);
        // })->whereHas('bloodTypes', function ($query) use ($donationRequest) {
        //         $query->where('blood_type_id', $donationRequest->blood_type_id);
        //     })->pluck('id')->toArray();

        // dd($clientsIds);
        // //check count client id
        // if (count($clientsIds)) {
        // 
        // } else {
        //     return $this->jsonResponse(0, "Notification  Failed");
        // }
        //__send notification__
        //$clientsIds->notify(new DonationRequestNotification($donationRequest));



    }



    public function allDonations(Request $request)
    {
        $donations = DonationRequest::filter($request->query())->paginate(10);
        return $this->jsonResponse(1, 'success', $donations);
    }
    public function getNotifications()
    {
        $client = auth()->guard('api')->user();
        // $client=$request->user();
        $client = Client::with('notifications')->paginate(10);
        return $this->jsonResponse(1, 'All Notifications', $client->notifications->content);
    }


    public function setNotifications(Request $request)
    {

        $validator = validator()->make($request->all(), [
            'governorates_ids' => 'required|exists:governorates,id',
            'blood_types_ids' => 'required|exists:blood_types,id'
        ]);
        if ($validator->fails()) {
            return $this->jsonResponse(0, 'Failled', $validator->errors(), 400);
        }

        $client = $request->user();

        $client->governorates()->sync($request->governorates_ids);
        $client->bloodTypes()->sync($request->blood_types_ids);
        return $this->jsonResponse(1, "Changed Sucsessfuly ",);
    }



    public function contactUs(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            $this->jsonResponse(0, "Failled ", null, 400);
        }

        $client = $request->user();

        $contact = new Contact($request->all());
        $contact->name = $client->name;
        $contact->email = $client->email;
        $contact->phone = $client->phone;
        $contact->save();

        return $this->jsonResponse(1, 'Sent Sucssfully', $contact);
    }



    public function settings()
    {

        $client = auth()->guard('api')->user();
        $settings = Setting::all();
        return $this->jsonResponse(1, 'About', $settings);
    }
}
