<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Interfaces\CityRepositoryInterface;
use Illuminate\Http\Request;
use App\Interfaces\ClientRepositoryInterface;
use App\Interfaces\DonationRepositoryInterface;
use App\Interfaces\GovernorateRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Post;
use App\Traits\Helper;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MainController extends Controller
{

    use Helper;
    public function __construct(protected GovernorateRepositoryInterface $governorateRepository, protected CityRepositoryInterface $cityRepository, protected PostRepositoryInterface $postRepository, protected DonationRepositoryInterface $donationRepository, protected ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->governorateRepository = $governorateRepository;
        $this->postRepository = $postRepository;
        $this->donationRepository = $donationRepository;
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        $donations = $this->donationRepository->allDonations();
        $posts = $this->postRepository->getPosts();
        return view('front.guest', compact('donations', 'posts'));
    }

    public function home(Request $request)
    {
        $bloodTypes = $this->governorateRepository->allBloodTypes();
        $cites = $this->cityRepository->allCities();
        $donations = $this->donationRepository->filterDonations($request);
        $posts = $this->postRepository->getPosts();
        return view('front.index', compact('donations', 'posts','bloodTypes','cites'));
    }

    //Donations
    public function allDonations(Request $request)
    {
        $bloodTypes = $this->governorateRepository->allBloodTypes();
        $cites = $this->cityRepository->allCities();
        $donations = $this->donationRepository->filterDonations($request);
        return view('front.Donations.index', compact('donations', 'bloodTypes', 'cites'));
    }

    //posts
    public function allFavorites(Request $request)
    {
        $posts = $this->postRepository->allFavorites($request);
        return view('front.posts.favorites',compact('posts'));
    } 

    public function toggleFavorite(Request $request)
    {
        // dd($request);
        $toggle=Auth::guard('client-web')->user()->posts()->toggle($request->post_id);
        return  $this->jsonResponse(1, 'sucsses', $toggle);
    } 



    public function allposts(Request $request)
    {
        $posts = $this->postRepository->getPosts($request);
        return view('front.posts.index', compact('posts'));
    }

    public function showOnePost(Post $post)
    {
      $post = $this->postRepository->showOnePost($post);
        return view('front.posts.show', compact('post'));
    }

    public function showOneDonation(DonationRequest $donation)
    {
        $donation = $this->donationRepository->showOneDonation($donation);
        return view('front.donations.show', compact('donation'));
    }

    public function aboutUs(Setting $setting)
    {
        $setting = Setting::first();
        // dd($setting);
        return view('front.about-us.about-us', compact('setting'));
    }


    public function contactUs(Setting $setting)
    {
        $setting = Setting::first();
        // dd($setting);
        return view('front.contacts.contact-us', compact('setting'));
    }

    public function addContact(Request $request)
    {
        $setting = Setting::first();
        $this->governorateRepository->contactUs($request);

        return view('front.contacts.contact-us', compact('setting'));
    }


    public function getDonation()
    {
        return view('front.Donations.create');
    }
    public function addDonation(Request $request)
    {
        $donationRequest = $this->donationRepository->crateDonation($request);
        $clients = Client::all();
        $clientsTokens = Client::pluck('api_token')->toArray();

        if ($donationRequest) {

            $notification = $donationRequest->notifications()->create([
                'title' => 'Need Donate to new patient',
                'content' => 'Need a blood type : ' . $donationRequest->bloodType->name
            ]);

            // dd( $notification);

            if ($notification) {
                $notification->clients()->sync($clients);
                $this->notifyByFirebase($notification->title, $notification->content, $clientsTokens, ['msg' => "Donation Added Successfuly"]);
                // Notification::send($clients, (new DonationRequestNotification($donationRequest, $notification)));
            }
            return to_route('client-donations');
        }
    }

   
}
