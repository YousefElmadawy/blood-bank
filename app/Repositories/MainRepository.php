<?php

namespace App\Repositories;

use App\Interfaces\MainRepositoryInterface;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Post;
use Illuminate\Http\Request;

class MainRepository implements MainRepositoryInterface
{
    public function allGovornorates()
    {
        return Governorate::all();
    }

    public function allCities(Request $request)
    {
        return City::where('governorate_id', $request->governorate_id)->get();
    }

    public function allCategories()
    {
        return Category::all();
    }

    public function allPosts($request)
    {
        return Post::filter($request->query())->paginate();
    }

    // public function onePost(Post $post)
    // {

    // }

    public function  allFavorites($request)
    {
        return $request->user()->posts()->latest()->paginate(10);
    }

    public function favoritePost($request)
    {
        return $request->user()->posts()->toggle($request->post_id);
    }

    public function allDonations($request)
    {
        return DonationRequest::filter($request->query())->paginate(10);
    }
    public function allBloodTypes()
    {
        return BloodType::all();
    }

    public function contactUs($request)
    {
        return Contact::create([
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'phone' => $request->user()->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
    }
    public function crateDonation($request)
    {
        return  $request->user()->donationRequests()->create($request->all());
    }
}
