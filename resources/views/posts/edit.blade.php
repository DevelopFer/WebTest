@extends ('layouts.posts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('updatePost', ['id' => $post->id])}}" method="post"  enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            Update Post
                        </div>
                        <div class="card-body">                            
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <img id="post-image" src="{{ url('/uploads/'.$post->imageurl) }}" class="img-thumbnail" alt="preview">
                                        </div>
                                        <div class="col-12 col-md-6 imgContainer">
                                        <br><br>
                                            <input type="file" style="display:none" name="postimage">
                                            <h6>Select an image for the new post</h6>
                                            <button class="btn btn-danger btn-upload" type="button">
                                               <i class="fa fa-upload"></i> Change Image
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control input-sm" placeholder="Enter title" required value="{{ $post->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea id="summernote" name="body">
                                        {{ $post->body }}
                                    </textarea> 
                                </div>
                                <div class="form-group ">
                                    <label for="tags">Tags</label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-control input-sm select2" name="tags[]" multiple="multiple" data-url="{{ route('tags') }}">
                                        @foreach($tags as $tag)
                                            @php ($mustSelect = false)
                                            @foreach($post->tags as $postag)
                                                @if($postag->id === $tag->id)
                                                @php ($mustSelect = true)
                                                @endif
                                            @endforeach
                                            <option {{ $mustSelect ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#tagModal">New Tag</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Url</label>
                                    <input type="text" class="form-control input-sm" name="slug" placeholder="example-post-url" value="{{ $post->slug }}">
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right btn-md">Update Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('tags.new') 
    <script src="{{ asset('js/posts/newpost.js') }}" ></script>
@endsection
