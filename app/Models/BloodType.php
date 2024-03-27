<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
         
    ];

    public function donationRequests()
    {
        return $this->hasMany(DonationRequest::class);
    }

    public function clients()
    {
        return $this->hasMany(DonationRequest::class);
    }

    public function notificationsClients()
    {
        return $this->belongsToMany(Client::class);
    }
}

