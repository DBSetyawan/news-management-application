@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Something News</div>
                <div class="card-body">
                    <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        <label class="">Pilih Gambar Berita:</label>
                        <br/>
                        <label class="btn btn-primary" for="my-file-selector">
                            <input id="my-file-selector" type="file" name="file" 
                            onchange="$('#upload-file-info').html(this.files[0].name)" class="d-none">
                            Pilih gambar
                        </label>
                        <span class='label label-info' id="upload-file-info"></span>
                        <div class="form-group">
                            @csrf
                            <label class="label">Judul Berita: </label>
                            <input type="text" name="title" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label class="label">Isi berita: </label>
                            <textarea name="body" rows="10" cols="30" class="form-control" required></textarea>
                        </div>
                        @if (session()->get('privilages') == "admin")
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" />
                            </div>
                            @else
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection