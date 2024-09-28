<?php 

namespace App\Interfaces;

use Illuminate\Http\Request;

interface NotificationRepositoryInterface {

    public function getNotifications();
    public function setNotifications(Request $request);
    public function createNotifications($donationRequest);
}