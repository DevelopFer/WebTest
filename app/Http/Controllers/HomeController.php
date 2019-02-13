<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;


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
        $id   = \Auth::user()->id;
        $user = User::findOrFail($id);
        $posts = $user->posts()->get();
        foreach( $posts as $post ) {  
            $tags = $post->tags;
        }        
        return view('home', ["posts"=>$posts]);
    }
}
