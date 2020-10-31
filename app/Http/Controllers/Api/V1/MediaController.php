<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaRequest;
use App\Http\Resources\MediaResource;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = MediaLibrary::all();
        return MediaResource::collection($media);
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
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $media->addMediaFromRequest('image')->toMediaCollection('blog');
        }
        return $media->save() ? new MediaResource($media) : ['false' => 'Wrong! please try again later'];
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,  User $user)
    {
        $this->authorize('delete', $user);
        $media = MediaLibrary::whereIn('id', $request->input('id'));
        foreach ($media->get() as $item) {
            $mediaItems = $item->getMedia('blog');
            $mediaItems[0]->delete();
        }
        return $media->delete() ? ['true' => 'Done'] : ['false' => 'Wrong! please try later!'];
    }
}
