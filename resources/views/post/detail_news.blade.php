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
                        margin-right: auto;width: 86%;">
                <br/>
                    <p>
                        {{ $post->body }}
                    </p>
                    <hr />
                    <h4>Display Comments</h4>
                    <hr />
                 {{-- {{$commentx}} --}}
                @if ($message = Session::get('warning'))
                    <div class="alert alert-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                 @foreach ($commentx as $item)
                    <form method="get" action="{{ route('updates.data.detail.news', $post->id) }}" enctype="multipart/form-data">
                        {{-- @csrf --}}
                        <strong></strong>
                        <a href="" id="reply"></a>
                            <b>{{ $item->user->name}}</b>
                                <div class="form-group">
                                <input type="text" name="body[]" value="{{ $item->body}}" class="form-control" />
                                <input type="hidden" name="post_id[]" value="{{ $item->post_id }}" />
                                <input type="hidden" name="parent_id[]" value="{{ $item->id }}" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-warning" value="Update Netizen" />
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection