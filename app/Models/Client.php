<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable ;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'date_of_birth',
        'last_donation_date',
        'pin_code',
        'blood_type_id',
        'city_id',
        'api_token'
    ];

    //one to many Inverse
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }


    //one to many 
    public function donationRequests()
    {
        return $this->hasMany(DonationRequest::class);
    }


    //many to many 
    public function governorates()
    {
        return $this->belongsToMany(Governorate::class);
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class);
    }

    public function bloodTypes()
    {
        return $this->belongsToMany(BloodType::class);
    }
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }


    protected $hidden = [
        'password',
        'api_token',
    ];
}
