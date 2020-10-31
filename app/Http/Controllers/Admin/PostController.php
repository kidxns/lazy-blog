<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view,App\Models\Post');
    }
    /**s
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $posts = Post::orderBy('id', 'desc')->paginate(50);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $input = $request->all();
        $input['author_id'] = auth()->user()->id;
        $input['slug'] = Str::slug($request->title, '-');
        $post = Post::create($input);
        if ($post) {
            return response()->json([
                'success' => true,
                'data' => $post,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $posts, $id)
    {
        $this->authorize('update', $posts);
        $post = Post::where('id', $id)->first();
        return view('admin.posts.edit', ['post' => $post])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, PostRequest $request)
    {
        $this->authorize('update', $post);
        $post['slug'] = Str::slug($request->title, '-');
        $update = $post->fill($request->all())->update();
        if ($update) {
            return response()->json([
                'success' => true,
                'data' => $post,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Request $request)
    {
        $this->authorize('delete', $post);
        $post = Post::whereIn('id', $request->input('id'))->delete();
        $true = response()->json(['true' => 'The post was deleted!']);
        $false = response()->json(['false' => 'Something went wrong - Post!']);
        return $post ? $true : $false;
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
                ->orWhere('status', 'like', '%' . $query . '%')
                ->orWhere('posted_at', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')->paginate(50);
            return view('admin.posts._list', compact('posts'))->render();
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
        return view('admin.posts._list', compact('posts'))->render();
    }

   /**
     *
     * Fetch data in the table
     * @param App\Models\Post $post
     * @param  \Illuminate\Http\Request  $request
     * @return $post
     */


    public function fetch_data(Request $request)
    {
        $view = $request->view;
        $sort_by = $request->get('column');
        $sort_type = $request->get('sort');
        $paginate = $request->get('paginate');
        $posts = Post::orderBy($sort_by, $sort_type)->paginate($paginate);
        return view($view, ['posts' => $posts])->render();
    }
}
