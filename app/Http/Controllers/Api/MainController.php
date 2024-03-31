<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\DonationRequest as RequestsDonationRequest;
use App\Http\Requests\FavoriteRequest;
use App\Http\Resources\DonationRequestResource;
use App\Interfaces\MainRepositoryInterface;
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
use App\Traits\Helper;


class MainController extends Controller
{
    use Helper;
    private MainRepositoryInterface $mainRepository;

    public function __construct(MainRepositoryInterface $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function governorates()
    {
        $governorates = $this->mainRepository->allGovornorates();
        return $this->jsonResponse(1, 'success', $governorates);
    }

    public function cities(Request $request)
    {
        $cities = $this->mainRepository->allCities($request);
        return $this->jsonResponse(1, 'success', $cities);
    }

    public function bloodTypes()
    {
        $bloodTypes = $this->mainRepository->allBloodTypes();
        return $this->jsonResponse(1, 'success', $bloodTypes);
    }

    public function categories()
    {
        $categories = $this->mainRepository->allCategories();
        return $this->jsonResponse(1, 'success', $categories);
    }

    public function posts(Request $request)
    {
        $posts = $this->mainRepository->allPosts($request);
        return $this->jsonResponse(1, 'success', $posts);
    }

    public function post(Post $post)
    {
        return $this->jsonResponse(1, 'sucsses', $post);
    }

    public function favoritePost(FavoriteRequest $request)
    {              
        $toggle =$this->mainRepository->favoritePost($request);
        return  $this->jsonResponse(1, 'sucsses', [
            'toggle'=>$toggle,
        ]);

        if ($request->fails()) {
            return $this->jsonResponse(0, 'Failled', $request->errors(), 400);
        }
    }

    public function allFavorites(Request $request)
    {
        $posts = $this->mainRepository->allFavorites($request);
        return $this->jsonResponse(1, 'get successfuly',  $posts);
    }

    public function createDonationRequest(RequestsDonationRequest $request)
    {
        //create donation request
        // $client = $request->user();
        // dd($client); $client->donationRequests()->create($request->all())
        $donationRequest =$this->mainRepository->crateDonation($request);
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
            return $this->jsonResponse(1, "Donation Added Successfuly", ($donationRequest));

          
        }
        // dd($request->all());
        if ($request->fails()) {
            return $this->jsonResponse(0, "Failled Data", $request->errors(), 400);
        }
    }

    public function allDonations(Request $request)
    {
        $donations =$this->mainRepository->allDonations($request);
        return $this->jsonResponse(1, 'success', DonationRequestResource::collection($donations));
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

    public function contactUs(ContactRequest $request)
    {
        $contact = $this->mainRepository->contactUs($request);
        return $this->jsonResponse(1, 'Sent Sucssfully', $contact);

        if ($request->fails()) {
            $this->jsonResponse(0, "Failled ", null, 400);
        }
    }



    public function settings()
    {
        $client = auth()->guard('api')->user();
        $settings = Setting::first();
        return $this->jsonResponse(1, 'About', $settings);
    }
}
