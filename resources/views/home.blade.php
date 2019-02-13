@extends('layouts.posts')

@section('content')

<div class="container">
    <div class="row justify-content-center ">
        <div class="col-sm-12">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('status') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
            <div class="card text-white bg-primary mb-3" >
                <div class="card-header primary" style="min-height:150px;">
                    <div class="row">
                        <div class="col-10">
                            <h1 style="margin-top:10%">My Posts</h1>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('createPost') }}" class="btn btn-warning fabBtn" ><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="background:#FFFFFF">
                    <div class="row">
                            @if(count($posts) <=  0)
                            <div class="jumbotron jumbotron-fluid" style="background:#FFFFFF;color:#000000">
                                <div class="container">
                                    <h1 class="display-4">Create your first post</h1>
                                    <p class="lead">Click on the add button and share your ideas .</p>
                                </div>
                            </div>
                        @endif
                        @for($i = 0; $i < count($posts); $i++)
                            <div class="col col-12 col-md-6 col-lg-4" style="margin-bottom:15px;margin-top:15px;">
                                <div class="card" style="color:#000000">
                                    <div class="card-header">
                                        <div class="row  ">
                                            <div class="col-8">
                                                <h5 class="card-title" ><b>{{ $posts[$i]->title}}</b></h5>
                                            </div>
                                            <div class="col-2">
                                                <a href="{{ route('editPost',['id' => $posts[$i]->id])}}" class="btn btn-sm btn-info text-white" title="Edit post"><i class="fas fa-edit align-right"></i></a>
                                            </div>
                                            <div class="col-2">
                                                <a href="{{ route('destroyPost', ['id' => $posts[$i]->id])}}" class="btn btn-sm btn-danger" title="Delete post"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{ url('/uploads/'.$posts[$i]->imageurl) }}" class="card-img-top img-fluid" alt="{{ $posts[$i]->title}}" style="max-height: 150px;max-width: auto;object-fit: contain;">
                                    <div class="card-body">
                                        <i class="fas fa-tags"></i>
                                        @foreach($posts[$i]->tags as $tag)
                                            <span class="badge badge-pill badge-info" style="color:#FFFFFF">{{ $tag->name }}</span>
                                        @endforeach
                                        <br><br>
                                        <a href="{{ route('showPost',['slug' => $posts[$i]->slug]) }}" class="btn btn-primary">View Post</a>
                                        <p class="card-text">
                                            <small class="text-muted">Published {{date('d/m/Y', strtotime($posts[$i]->created_at)) }}</small>
                                        </p>
                                    </div>
                                </div>    
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
