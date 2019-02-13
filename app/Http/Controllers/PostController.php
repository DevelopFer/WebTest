<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        foreach( $posts as $post ) {  
            $tags = $post->tags;
        }
        return View('posts/index',["posts"=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('posts/new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
        ]);
        $tags = Tag::findOrFail($request->input('tags'));
        $id   = \Auth::user()->id;
        $user = User::findOrFail($id);
        $post = new Post();
        $post->title    = $request->input('title');
        $post->body     = $request->input('body');
        $post->slug     = $request->input('slug');
        $user->posts()->save($post);
        if ($request->hasFile('postimage') && $request->file('postimage')->isValid()) {
            $newPost = Post::find($post->id);
            $extension = $request->postimage->extension();
            //Storage::disk('local')->put(base64_encode('post'.$newPost->id.date('Y-m-d H:m:s')).".".$extension, 'Contents');
            $fileName           = base64_encode('post'.$newPost->id.date('Y-m-d H:m:s')).".".$extension;
            $path               = public_path().'/uploads';
            $uplaod             = $request->postimage->move($path,$fileName);
            $newPost->imageurl  = $fileName;
            $newPost->save();
        }
        foreach($tags as $tag){
            $tag->posts()->save($post);
        }
        $request->session()->flash('status', 'Post successfully created!');
        return redirect()->action('HomeController@index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
        $post = Post::where('slug', $slug)->first();
        return View('posts/view',["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('id', $id)->first();
        $tags = Tag::all();
        return View('posts/edit',["post" => $post, 'tags'=>$tags]);
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
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
        ]);
        $post = Post::find($id)->first();
        $post->title     = $request->input('title');
        $post->body      = $request->input('body');
        $post->slug      = $request->input('slug');
        
        if ($request->hasFile('postimage') && $request->file('postimage')->isValid()) {
            $extension = $request->postimage->extension();
            if( file_exists(public_path().'/uploads/'.$post->imageurl) ){
                unlink(public_path().'/uploads/'.$post->imageurl);
            }
            $fileName           = base64_encode('post'.$post->id.date('Y-m-d H:m:s')).".".$extension;
            $path               = public_path().'/uploads';
            $upload             = $request->postimage->move($path,$fileName);
            $post->imageurl  = $fileName;
        }
        $post->tags()->sync($request->input('tags'));
        $post->save();
        $request->session()->flash('status', 'Post successfully updated!');
        return redirect()->action('HomeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id)->first();
        if( file_exists(public_path().'/uploads/'.$post->imageurl) ){
            unlink(public_path().'/uploads/'.$post->imageurl);
        }
        $post->delete();
        return redirect()->action('HomeController@index');
    }
}
