<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view,App\Models\User');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('id', 'desc')->paginate(50);
        return view('admin.comments.index', compact('comments'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        $this->authorize('delete', $user);
        $delete = Comment::whereIn('id', $request->input('id'))->delete();
        $true = response()->json(['true' => 'Successfully!']);
        $false = response()->json(['false' => 'Something went wrong!']);
        return $delete ? $true : $false;
    }


      /**
     * Fetch data
     * @param  \Illuminate\Http\Request  $request
     * @return result
     *
     */

    public function search(Request $request)
    {
        $query = $request->get('query');
        $comments = Comment::where('content', 'like', '%' . $query . '%')
            ->orderBy('id', 'desc')->paginate(50);
        return view('admin.comments._list', compact('comments'))->render();

    }


    /**
     * Fetch data
     * @param  \Illuminate\Http\Request  $request
     * @return comment
     *
     */
    public function fetch_data(Request $request)
    {
        $view = $request->view;
        $sort_by = $request->get('column');
        $sort_type = $request->get('sort');
        $paginate = $request->get('paginate');
        $comment = Comment::orderBy($sort_by, $sort_type)->paginate($paginate);
        return view($view, ['comments' => $comment])->render();

    }
}
