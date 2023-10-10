<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        $user = Auth::user();
        return view('home', ['posts' => $posts, 'user'=> $user]);
    }
}