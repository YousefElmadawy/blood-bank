<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\DonationStoreRequest;
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

    public function __construct(
        protected GovernorateRepositoryInterface $governorateRepository,
        protected CityRepositoryInterface        $cityRepository,
        protected PostRepositoryInterface        $postRepository,
        protected DonationRepositoryInterface    $donationRepository,
        protected ClientRepositoryInterface      $clientRepository
    )
    {
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

        return view('front.index', compact('donations', 'posts', 'bloodTypes', 'cites'));
    }

    // Donations
    public function allDonations(Request $request)
    {
        $bloodTypes = $this->governorateRepository->allBloodTypes();
        $cites = $this->cityRepository->allCities();
        $donations = $this->donationRepository->filterDonations($request);

        return view('front.Donations.index', compact('donations', 'bloodTypes', 'cites'));
    }

    public function showOneDonation(DonationRequest $donation)
    {
        $donation = $this->donationRepository->showOneDonation($donation);
        return view('front.donations.show', compact('donation'));
    }

    public function getDonation()
    {
        $bloodTypes = $this->governorateRepository->allBloodTypes();
        $governorates = $this->governorateRepository->allGovornorates();
        $cities = $this->cityRepository->allCities();

        return view('front.Donations.create', compact('bloodTypes', 'governorates', 'cities'));
    }

    public function addDonation(DonationStoreRequest $request)
    {
        try {
            $donationRequest = $this->donationRepository->crateDonation($request);

            if (!$donationRequest) {
                throw new \Exception('Failed to create donation request');
            }

            // Create notification
            $notification = $donationRequest->notifications()->create([
                'title'   => 'Urgent: Blood Donation Needed',
                'content' => 'Blood type needed: ' . $donationRequest->bloodType->name . ' in ' . $donationRequest->city->name
            ]);

            if ($notification) {
                // Get relevant clients (matching blood type and location)
                $relevantClients = Client::whereHas('bloodTypes', function ($query) use ($donationRequest) {
                    $query->where('blood_types.id', $donationRequest->blood_type_id);
                })->whereHas('governorates', function ($query) use ($donationRequest) {
                    $query->where('governorates.id', $donationRequest->city->governorate_id);
                })->get();

                // Attach notification to relevant clients only
                $notification->clients()->sync($relevantClients->pluck('id'));

                // Get FCM tokens
                $clientsTokens = $relevantClients
                    ->whereNotNull('fcm_token')
                    ->pluck('fcm_token')
                    ->toArray();

                if (!empty($clientsTokens)) {
                    $this->notifyByFirebase(
                        $notification->title,
                        $notification->content,
                        $clientsTokens,
                        ['donation_id' => $donationRequest->id]
                    );
                }
            }

            return redirect()
                ->route('client-donations')
                ->with('success', 'Donation request created successfully! Notifications sent to eligible donors.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create donation request. Please try again.');
        }
    }

    // Posts
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

    public function allFavorites(Request $request)
    {
        $client = Auth::guard('client-web')->user();

        if (!$client) {
            return redirect()->route('getLogin');
        }

        $posts = $this->postRepository->allFavorites($request);
        return view('front.posts.favorites', compact('posts'));
    }

    public function toggleFavorite(Request $request)
    {
        $validated = $request->validate([
            'post_id' => ['required', 'exists:posts,id'],
        ]);

        try {
            $client = Auth::guard('client-web')->user();

            if (!$client) {
                return $this->jsonResponse(0, 'Unauthorized', null, 401);
            }

            $toggle = $client->posts()->toggle($request->post_id);

            $isFavorited = in_array($request->post_id, $toggle['attached']);

            return $this->jsonResponse(
                1,
                'Success',
                [
                    'is_favorited' => $isFavorited,
                    'message'      => $isFavorited ? 'Added to favorites' : 'Removed from favorites'
                ]
            );

        } catch (\Exception $e) {
            return $this->jsonResponse(0, 'Failed to toggle favorite', null, 500);
        }
    }

    // Pages
    public function aboutUs()
    {
        $setting = Setting::first();

        if (!$setting) {
            return redirect()
                ->route('client-home')
                ->with('error', 'About us information not available.');
        }

        return view('front.about-us.about-us', compact('setting'));
    }

    public function contactUs()
    {
        $setting = Setting::first();

        if (!$setting) {
            return redirect()
                ->route('client-home')
                ->with('error', 'Contact information not available.');
        }

        return view('front.contacts.contact-us', compact('setting'));
    }

    public function addContact(ContactRequest $request)
    {
        try {
            $this->governorateRepository->contactUs($request);

            return redirect()
                ->back()
                ->with('success', 'Thank you for contacting us! We will get back to you soon.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to send your message. Please try again.');
        }
    }
}
