<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'donation_request_id',  
    ];
    
    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
    
    public function donationRequest()
    {
        return $this->belongsTo(DonationRequest::class);
    }
   
}
