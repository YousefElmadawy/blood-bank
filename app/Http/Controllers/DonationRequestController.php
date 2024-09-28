<?php

namespace App\Http\Controllers;

use App\Interfaces\DonationRepositoryInterface;
use App\Models\Client;
use App\Http\Requests\DonationRequest as RequestsDonationRequest;
use App\Models\DonationRequest;
use App\Traits\Helper;

use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    use Helper;
    public function __construct(protected DonationRepositoryInterface $donationRepository)
    {
        $this->donationRepository = $donationRepository;
        $this->middleware('permission:donations-list', ['only' => ['index']]);
        $this->middleware('permission:donations-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $donations = $this->donationRepository->allDonations($request);

        return view('admin.donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.donations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsDonationRequest  $request)
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
            return to_route('donations.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $donationRequest=DonationRequest::findOrFail($id);
        return view('admin.donations.show',compact('donationRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonationRequest $donationRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DonationRequest $donationRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($donationRequest);
        $this->donationRepository->deleteDonation($id);
        return to_route('donations.index');
    }
}
