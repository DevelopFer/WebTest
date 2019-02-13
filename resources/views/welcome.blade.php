@extends('layouts.posts')

@section('content')
    <div class="container">
        <div class="row">
                @for($i = 0; $i < 10; $i++)
                    <div class="col col-sm-6" style="margin-bottom:15px;">
                        <div class="card" >
                            <div class="card-header">
                                <h5 class="card-title"><b>Post title</b></h5>
                            </div>
                            <img src="https://i.kym-cdn.com/entries/icons/original/000/013/564/doge.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                            <i class="fas fa-tags"></i>
                                <span class="badge badge-pill badge-info" style="color:#FFFFFF">Info</span>
                                <p class="card-text">Post Intro</p>
                                <a href="#" class="btn btn-primary">Go to Post</a>
                                <p class="card-text">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </p>
                                
                            </div>
                        </div>    
                    </div>
                @endfor
        </div>
    </div>
@endsection