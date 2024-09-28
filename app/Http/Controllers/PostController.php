<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Interfaces\GovernorateRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(protected PostRepositoryInterface $postRepository,protected GovernorateRepositoryInterface $governorateRepository) {
        $this->postRepository = $postRepository;
        $this->governorateRepository = $governorateRepository;
        $this->middleware('permission:post-list', ['only' => ['index']]);
        $this->middleware('permission:post-create', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:post-edit', ['only' => ['update','edit']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $posts =$this->postRepository->allPosts($request);
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=$this->governorateRepository->allCategories();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $this->postRepository->addPost($request);
        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $post=Post::findOrFail($post->id);
        $categories=$this->governorateRepository->allCategories();
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->postRepository->editPost($request, $post);
        return to_route('posts.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->postRepository->deletePost($post->id);
        return to_route('posts.index');

    }
}
