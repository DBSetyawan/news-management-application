@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 style="text-align: center">{{ $post->title }}&nbsp;</h2>
                    <img 
                        src="{{ asset('News/'.$post->file) }}" 
                        alt="Logo" 
                        style="
                        display: block;
                        margin-left: auto;
                        margin-right: auto;width: 86%;"
                    >
                <br/>
                    <p>
                        {{ $post->body }}
                    </p>
                    <hr />
                    <h4>Display Comments</h4>
  
                    @include('post.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
   
                    <hr />
                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection