<?php

namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;
 
class CityRepository implements CityRepositoryInterface
{
    public function __construct(public City $city) {
        $this->city = $city;
    }

    public function allCities()
    {
        return $this->city->all();
    }
    
    public function filterCities($id)
    {
       return   $this->city->where('governorate_id',$id)->pluck('name','id');
    }

    public function createOne($request)
    {
     
        return $this->city->create($request);
    }

    public function updateOne($request,$id)
    {
        $city= $this->city->find($id);
        return $city->update($request); 
    
    }
    public function removeOne($id)
    {
        $city= $this->city->find($id);
        return $city->delete();
    }
    
}
