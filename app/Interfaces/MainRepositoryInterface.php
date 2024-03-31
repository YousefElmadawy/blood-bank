<?php 

namespace App\Interfaces;

use App\Models\Client;
use App\Models\Post;
use Illuminate\Http\Request;

interface MainRepositoryInterface {

    public function allGovornorates();
    public function allCities(Request $request);
    public function allCategories();
    public function allPosts(Request $request);
    // public function onePost(Post $post);
    public function allFavorites(Request $request);
    public function favoritePost(Request $request);
    public function allDonations(Request $request);
    public function crateDonation(Request $request);
    public function allBloodTypes();
    public function contactUs(Request $request);
     
}