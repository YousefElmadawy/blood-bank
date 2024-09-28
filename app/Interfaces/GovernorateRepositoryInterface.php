<?php 

namespace App\Interfaces;

 
interface GovernorateRepositoryInterface {

    public function allGovornorates();
    public function createOne($request);
    public function updateOne($request, $id);
    public function removeOne($id);

    public function allCategories();


    public function allBloodTypes();
    public function contactUs($request);
     
}