<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\DonationRequest as RequestsDonationRequest;
use App\Http\Requests\FavoriteRequest;
use App\Http\Resources\DonationRequestResource;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\ClientRepositoryInterface;
use App\Interfaces\DonationRepositoryInterface;
use App\Interfaces\GovernorateRepositoryInterface;
use App\Interfaces\MainRepositoryInterface;
use App\Interfaces\NotificationRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
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
use App\Repositories\GovernorateRepository;
use Illuminate\Support\Facades\Notification;
use App\Traits\Helper;
use Illuminate\Http\Request;

class MainController extends Controller
{
    use Helper;
    private GovernorateRepositoryInterface $governorateRepository;
    private PostRepositoryInterface $postRepository;
    private DonationRepositoryInterface $donationRepository;
    private NotificationRepositoryInterface $notificationRepository;

    public function __construct(NotificationRepositoryInterface $notificationRepository,private CityRepositoryInterface $cityRepository,private CategoryRepositoryInterface $categoryRepository , GovernorateRepositoryInterface $mainRepository, PostRepositoryInterface $postRepository, DonationRepositoryInterface $donationRepository,protected ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->governorateRepository = $mainRepository;
        $this->postRepository = $postRepository;
        $this->donationRepository = $donationRepository;
        $this->notificationRepository = $notificationRepository;
        $this->categoryRepository = $categoryRepository;
        $this->cityRepository = $cityRepository;
    }

    public function governorates()
    {
        $governorates = $this->governorateRepository->allGovornorates();
        return $this->jsonResponse(1, 'success', $governorates);
    }

    public function cities(Request $request)
    {
        $cities = $this->cityRepository->filterCities($request);
        return $this->jsonResponse(1, 'success', $cities);
    }

    public function bloodTypes()
    {
        $bloodTypes = $this->governorateRepository->allBloodTypes();
        return $this->jsonResponse(1, 'success', $bloodTypes);
    }

    public function categories()
    {
        $categories = $this->categoryRepository->allCategories();
        return $this->jsonResponse(1, 'success', $categories);
    }

    public function posts(Request $request)
    {
        $posts = $this->postRepository->allPosts($request);
        return $this->jsonResponse(1, 'success', $posts);
    }

    public function post(Post $post)
    {
        return $this->jsonResponse(1, 'sucsses', $post);
    }

    public function favoritePost(FavoriteRequest $request)
    {
        $toggle = $this->postRepository->favoritePost($request);
        return  $this->jsonResponse(1, 'sucsses', [
            'toggle' => $toggle,
        ]);

        if ($request->fails()) {
            return $this->jsonResponse(0, 'Failled', $request->errors(), 400);
        }
    }

    public function allFavorites(Request $request)
    {
        $posts = $this->postRepository->allFavorites($request);
        return $this->jsonResponse(1, 'get successfuly',  $posts);
    }

    public function createDonationRequest(RequestsDonationRequest $request)
    {
        $donationRequest = $this->donationRepository->crateDonation($request);
        //0
        $clients =$this->clientRepository->allClients();
        $clientsTokens = Client::where('fcm_token' ,'!=' ,'')->pluck('fcm_token')->toArray(); 
      
        if ($donationRequest) {
//1
            $notification =$this->notificationRepository->createNotifications($donationRequest);

            // dd( $notification);

            if ($notification) {
                $notification->clients()->sync($clients);
                //2
                $this->notifyByFirebase($notification->title, $notification->content, $clientsTokens ,['msg'=>"Donation Added Successfuly"]);
                // Notification::send($clients, (new DonationRequestNotification($donationRequest, $notification)));
            }
            return $this->jsonResponse(1, "Donation Added Successfuly", $donationRequest);
        }

        if ($request->fails()) {
            return $this->jsonResponse(0, "Failled Data", $request->errors(), 400);
        }
    }

    public function allDonations(Request $request)
    {
        $donations = $this->donationRepository->allDonations($request);
        return $this->jsonResponse(1, 'success', DonationRequestResource::collection($donations));
    }

    public function getNotifications()
    {
        $client = $this->notificationRepository->getNotifications();
        return $this->jsonResponse(1, 'All Notifications', $client);
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

        $client = $this->notificationRepository->setNotifications($request);
        return $this->jsonResponse(1, "Changed Sucsessfuly ", $client->governorates);
    }

    public function contactUs(ContactRequest $request)
    {
        $contact = $this->governorateRepository->contactUs($request);
        return $this->jsonResponse(1, 'Sent Sucssfully', $contact);

        if ($request->fails()) {
            $this->jsonResponse(0, "Failled ", null, 400);
        }
    }


    public function settings()
    {
        //3
        $settings = Setting::first();
        return $this->jsonResponse(1, 'About', $settings);
    }
}
