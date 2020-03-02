@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- User : {{ auth()->user()->name }} --}}
            @if (session()->get('privilages') == "admin")
            <h1>Admin Panel (only admin can create , update, delete the news)</h1>
                @else
                <h1>non-admin users can post comments to a news.</h1>
            @endif
            <span class="">Hak akses : [ {{ session()->get('privilages') }} ]</span> 
            <a href="{{ route('post.create') }}" class="btn btn-success" style="float: right">Create Post</a>
            <br/>
            <br/>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('danger'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <th width="80px">Id</th>
                    <th>Gambar Berita</th>
                    <th>Judul Berita</th>
                    <th width="303px">Opsi Berita</th>
                </thead>
                <tbody>
                @foreach($post as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->file }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if( session()->get('privilages') == "admin")
                                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">View Post</a>
                                    <a href="{{ route('show.detail.news', $post->id) }}" class="btn btn-primary">Manage Post</a>
                                    <a href="{{ route('destr', $post->id) }}" class="btn btn-danger">Delete</a>
                                @else
                                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">View Post</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection