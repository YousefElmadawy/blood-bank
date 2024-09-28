<?php

namespace App\Repositories;
use App\Models\Notification;
use App\Interfaces\NotificationRepositoryInterface;
use App\Models\Client;
use Illuminate\Http\Request;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function getNotifications()
    {
       
        return Client::with('notifications')->paginate(10);

    }
    public function createNotifications($donationRequest)
    {
       return Notification::create([
        'title' => 'Need Donate to new patient',
        'content' => 'Need a blood type : '.$donationRequest->bloodType->name
       ]);
      
    }
    public function setNotifications(Request $request)
    {
        $client = $request->user();

       $client->governorates()->sync($request->governorates_ids);
       $client->bloodTypes()->sync($request->blood_types_ids);
        return $client;

    }

}