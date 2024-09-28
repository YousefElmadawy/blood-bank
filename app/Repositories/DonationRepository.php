<?php

namespace App\Repositories;

// use App\Http\Requests\DonationRequest;
use App\Interfaces\DonationRepositoryInterface;
use App\Models\DonationRequest;

class DonationRepository implements DonationRepositoryInterface
{
    public function __construct(public DonationRequest $donationRequest) {
        $this->donationRequest = $donationRequest;
    }

    public function filterDonations($request)
    {
        return $this->donationRequest->filter($request->query())->latest()->paginate(5);
    }
    public function showOneDonation($donation)
    {
        return  $this->donationRequest->findOrFail($donation->id);
        //  Post::where('post_id',$id)->first();
    }
    public function allDonations()
    {
        return  $this->donationRequest->latest()->paginate(4);
    }
    public function crateDonation($request)
    {
        return  $this->donationRequest->create($request->all());
    }
    public function editDonation($request)
    {
        return  $request->user()->donationRequests()->create($request->all());
    }
    public function deleteDonation($id)
    {
        return $this->donationRequest->destroy($id);
    }
}
