<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $comment = new Comment();
        $request->name ? $comment['name'] = $request->name : $comment['author_id'] = Auth::user()->id;
        $comment['content'] = $request->comment;
        $comment['post_id'] = $request->post;
        if($comment->save()){
            return view('comments._list', ['comments' => Comment::where('post_id', $request->post)->orderBy('id','desc')->paginate(10)]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete',$comment);
        $delete = $comment->delete();
        $true = response()->json(['true' => 'Successfully!']);
        $false = response()->json(['false' => 'Something went wrong!']);
        return $delete ? $true : $false;
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
        // dd($request->all());
        $sort_by = $request->get('column');
        $sort_type = $request->get('sort');
        $paginate = $request->get('paginate');
        $comment = Comment::where('post_id', $request->view)->orderBy($sort_by, $sort_type)->paginate($paginate);
        return view('comments._list', ['comments' => $comment])->render();

    }
}
