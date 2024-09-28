<?php

namespace App\Repositories;

use App\Http\Requests\PostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepository implements PostRepositoryInterface{

    public function allPosts($request)
    {
        return Post::filter($request->query())->paginate();
    }
    public function getPosts()
    {
        return Post::take(2)->get();
    }
    public function showOnePost($post)
    {
        return Post::findOrFail($post->id);
        //  Post::where('post_id',$id)->first();
    }

    public function addPost(PostRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
        }

        $post = Post::create([

            "title" => $request->title,
            "category_id" => $request->category_id,
            "image" => $path ?? "",
            "content" => $request->content,

        ]);

        return  $post;

         

    }

    public function editPost(PostRequest $request ,Post $post){

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
        }

        $post->update([
         
            "title" => $request->title,
            "category_id" => $request->category_id,
            "image" => $path ?? "",
            "content" => $request->content,

        ]);

        return  $post;
    }

    public function deletePost($id)
    {
        
        return Post::destroy($id);
    }

    public function allFavorites()
    {
        return Auth::guard('client-web')->user()->posts()->latest()->paginate(10);
    }

    public function favoritePost($request)
    {
        return $request->user()->posts()->toggle($request->post_id);
    }

}