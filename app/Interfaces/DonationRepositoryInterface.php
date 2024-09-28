<?php 

namespace App\Interfaces;

use App\Http\Requests\DonationRequest as RequestDonationRequest;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

interface DonationRepositoryInterface{

    public function allDonations();
    public function showOneDonation($donation);
    public function filterDonations(Request $request);
    public function crateDonation(RequestDonationRequest $request);
    public function editDonation(DonationRequest $donationRequest);
    public function deleteDonation($id);

}