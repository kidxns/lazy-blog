<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\ViewPostHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Event;
use Illuminate\Session\Store;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view,App\Models\Post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Category $category)
    {
        $this->authorize('update', $category);
        $input = $request -> all();
        $input['author_id'] =  auth()->user() -> id;
        $post = Post::create($input);
        return new PostResource($post);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        event(new ViewPostHandler($post));
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->only(['categories']));
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $delete =  $post -> delete();
        return  $delete ? ['true' => 'Deleted'] : ['false' => 'Something went wrong!'] ;
    }





    //  public function force_delete(Post $post){
    //     $delete = $post->forceDelete();
    //     return  $delete ? ['true => 'Sucessfully'] : ['false' => 'Wrong! o oh"] ;
    //  }


    // public function restore(Post $post){
    //     $restore = $post->withTrashed()->restore();
    //     return  $restore ? ['true => 'Sucessfully'] : ['false' => 'Wrong! o oh"] ;

    // }
}
