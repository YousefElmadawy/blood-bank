<?php 

namespace App\Interfaces;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

interface PostRepositoryInterface {

    public function allPosts(Request $request);
    public function getPosts();
    public function showOnePost($post);
    
    public function addPost(PostRequest $request);
    public function editPost(PostRequest $request,Post $post);
    public function deletePost(Post $post);
    
    public function allFavorites();
    public function favoritePost(Request $request);

}
