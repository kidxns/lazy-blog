<?php

namespace App\Http\Controllers;

use App\Events\ViewPostHandler;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        $categories = Category::withCount('posts')->orderBy('id','desc')->paginate(10);
        $comments = Comment::orderBy('id','desc')->paginate(4);

        return view('home', ['posts' => $posts, 'categories' => $categories, 'comments' => $comments]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($param)
    {

        $post = Post::where('id', $param)
            ->orWhere('slug', $param)
            ->firstOrFail();
            event(new ViewPostHandler($post));

        $collection = Post::where('category_id', $post->category_id)->take(4)->get();
        Arr::random([$collection]);
        $diff = $collection->diffKeys([
            $post,
        ]);
        $comments = Comment::where('post_id', $post->id)->orderBy('id','desc')->paginate(30);

        return view('posts._show', ['post' => $post, 'also' => $diff, 'comments' => $comments]);
    }


      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(30);
        return view('posts.index', ['posts' => $posts]);
    }


    /**
     *
     * Fetch data in the table
     * @param App\Models\Comment $comment
     * @param  \Illuminate\Http\Request  $request
     * @return $comment container new data
     */

    public function fetch_data(Request $request)
    {
        $sort_by = $request->get('column');
        $sort_type = $request->get('sort');
        $paginate = $request->get('paginate');
        $posts = Post::orderBy($sort_by, $sort_type)->paginate($paginate);
        return view('posts._collection', ['posts' => $posts])->render();

    }


    /**
     *
     * Filter data in the table
     * @param App\Models\Post $post
     * @param  \Illuminate\Http\Request  $request
     * @return $post result
     */

    public function search(Post $post, Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $posts = Post::where('title', 'like', '%' . $query . '%')
                ->orWhere('content', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')->paginate(50);
            return view('posts._collection', compact('posts'))->render();
        }
    }

    /**
     *
     * Filter data in the table
     * @param App\Models\Post $post
     * @param  \Illuminate\Http\Request  $request
     * @return $post result
     */
    public function filter(Post $post, Request $request)
    {
        $posts = Post::where($request->get('column'), $request->get('data'))->paginate(30);
        return view('posts._collection', compact('posts'))->render();
    }

}

// Category::orderBy(DB::raw('count(post_id)'), 'DESC')->paginate(10);
