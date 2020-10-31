<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaRequest;
use App\Models\MediaLibrary;
use App\Models\User;
use Illuminate\Http\Request;

class MediaController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:view,App\Models\User');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaRequest $request)
    {
        $media = new MediaLibrary();
        $view = $request->view;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $media->addMediaFromRequest('image')->toMediaCollection('blog');
        }
        if ($media->save()) {
            return view($view, ['media' => MediaLibrary::orderBy('id', 'desc')->paginate(10)])->render();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user )
    {
        $this->authorize('delete', $user);
        $media = MediaLibrary::whereIn('id', $request->input('id'));
        foreach ($media->get() as $item) {
            $mediaItems = $item->getMedia('blog');
            $mediaItems[0]->delete();
        }
        $true = response()->json(['true' => 'The images was deleted!']);
        $false = response()->json(['false' => 'Something went wrong - Media!']);
        return $media->delete() ? $true : $false;
    }


     /**
     *
     * Fetch data in the table
     * @param  \Illuminate\Http\Request  $request
     * @return $media
     */

    public function fetch_data(Request $request)
    {
        $view = $request->view;
        $sort_by = $request->get('column');
        $sort_type = $request->get('sort');
        $paginate = $request->get('paginate');
        $media = MediaLibrary::orderBy($sort_by, $sort_type)->paginate($paginate);
        return view($view, ['media' => $media])->render();

    }
}
