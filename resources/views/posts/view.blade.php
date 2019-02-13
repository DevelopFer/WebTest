@extends('layouts.posts')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="card mb-3">
					<img class="card-img-top img-fluid" src="{{ url('/uploads/'.$post->imageurl) }}" alt="{{ $post->title}}}">
					<div class="card-body">
						<h1 class="card-title"><b>{{ $post->title }}</b></h1>
						<div class="row">
							<div class="col-4">
								<i class="fas fa-calendar"></i>&nbsp;<small class="text-muted">Publisehd {{ date('F, jS Y')}}</small>
							</div>
							<div class="col-4">
								<i class="fas fa-user"></i>&nbsp;<small class="text-muted">{{$post->user->name}}</small>
							</div>
							<div class="col-4">
								<i class="fas fa-tags"></i>
								@foreach($post->tags as $tag)
									<span class="badge badge-pill badge-info" style="color:#FFFFFF">{{ $tag->name }}</span>
								@endforeach
							</div>
						</div>
						<p class="card-text">{!!html_entity_decode($post->body)!!}</p>
						<a href="{{ url()->previous() }}" class="card-link">Go Back</a>
					</div>
 				</div>
			</div>
		</div>
	</div>
@endsection