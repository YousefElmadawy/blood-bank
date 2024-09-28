<?php

namespace App\Repositories;

use App\Interfaces\GovernorateRepositoryInterface;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateRepository implements GovernorateRepositoryInterface
{
    public function __construct(public Governorate $governorate,public Category $category) {
        $this->governorate = $governorate;
        $this->category = $category;
    }
    public function allGovornorates()
    {
        return $this->governorate->with('cities')->get();
    }
    public function createOne($request)
    {
        return $this->governorate->create($request);
    }
    public function updateOne($request,$id)
    {
        $governorate = $this->governorate->find($id);
        return $governorate->update($request);
    }
    public function removeOne($id)
    {
        $governorate = $this->governorate->find($id);
        return $governorate->delete();
    }

  
    public function allBloodTypes()
    {
        return BloodType::all();
    }
    public function allCategories()
    {
        return $this->category->all();
    }

    public function contactUs($request)
    {
        
        return Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
    }
   
}
