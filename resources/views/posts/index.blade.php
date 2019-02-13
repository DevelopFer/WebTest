@extends('layouts.posts')

@section('content')
    <div class="container">
        <div class="row">
                @if(count($posts) <=  0)
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">We don't have any post yet</h1>
                            <p class="lead">Register for creating a free account and share your amazing posts with the world .</p>
                        </div>
                    </div>
                @endif
                @foreach($posts as $post)
                    <div class="col-12 col-lg-6" style="margin-bottom:15px;">
                        <div class="card " >
                            <img src="{{ url('/uploads/'.$post->imageurl) }}" class="card-img-top img-thumbnail img-fluid" alt="{{$post->title}}" style="max-height:280px">
                            <div class="card-body">
                            <h2 class="card-title"><b>{{$post->title}}</b></h2>
                            <i class="fas fa-tags"></i>
                                @foreach($post->tags as $tag)
                                    <span class="badge badge-pill badge-info" style="color:#FFFFFF">{{$tag->name}}</span>
                                @endforeach
                                <p class="card-text postcard">{{ strip_tags($post->body) }}</p>
                                <a href="{{ route('showPost',['slug' => $post->slug]) }}" class="btn btn-primary">Read More</a>
                                <p class="card-text">
                                    <small class="text-muted">Published {{date('d/m/Y H:m', strtotime($post->created_at))}}</small>
                                </p>
                            </div>
                        </div>    
                    </div>
                @endforeach
            
        </div>
    </div>
@endsection