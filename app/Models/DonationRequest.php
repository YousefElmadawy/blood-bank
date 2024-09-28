<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_name',
        'patient_age',
        'patient_phone',
        'hospital_name',
        'hospital_adress',
        'blood_type_id',
        'latitude',
        'longitude',
        'bags_num',
        'details',
        'city_id',
        'client_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

       
    public function scopeFilter(Builder $bulider , $filters)
    {

        if ($filters['patient_name'] ?? false ) {
            $bulider->where('patient_name', 'LIKE', "%{$filters['patient_name']}%");
        } 
        if ($filters['hospital_name'] ?? false ) {
            $bulider->where('hospital_name', '=', "%{$filters['hospital_name']}%");
        }
        if ($filters['city_id'] ?? false ) {
            $bulider->where('city_id', '=',  $filters["city_id"]);
        } 
        if ($filters['blood_type_id'] ?? false ) {
            $bulider->where('blood_type_id', '=', $filters["blood_type_id"]);
        }

        
      

    }
}
