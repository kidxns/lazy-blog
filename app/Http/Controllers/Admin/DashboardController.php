<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MediaLibrary;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view,App\Models\User');
    }


    public function index(){

        $posts = Post::all();
        $categories = Category::all();
        $media = MediaLibrary::all();
        $comments = User::all();
        $users = User::all();

        return view('admin.dashboard.index', ['posts' => $posts,
        'categories' => $categories, 'media' => $media, 'comments' => $comments, 'users' => $users])->render();



    }
}
