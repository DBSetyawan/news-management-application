@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- User : {{ auth()->user()->name }} --}}
            <h1>Admin Panel (only admin can create , update, delete the news)</h1>
            <a href="{{ route('post.create') }}" class="btn btn-success" style="float: right">Create Post</a>
            <br/>
            <br/>
            <table class="table table-bordered">
                <thead>
                    <th width="80px">Id</th>
                    <th>Gambar Berita</th>
                    <th>Judul Berita</th>
                    <th width="150px">Action</th>
                </thead>
                <tbody>
                @foreach($post as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->file }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">View Post</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection