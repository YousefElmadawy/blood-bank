<?php 

namespace App\Interfaces;
interface CityRepositoryInterface {

    public function allCities();
    public function createOne($request);
    public function filterCities($id);
    public function updateOne($request,$id);
    public function removeOne($id);
}