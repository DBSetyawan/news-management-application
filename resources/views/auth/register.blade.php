@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Informasi requirement user testing :') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            {{ __('* username wajib disi ( admin ) :') }}
                            <div class="form-group row">
                                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Username :') }}</label>
    
                                    <label for="" class="col-md-3 col-form-label text-md-right">{{ __('admin') }} </label>
    
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('User email admin :') }}</label>
    
                                    <label for="" class="col-md-3 col-form-label text-md-right">{{ __('whateveryouwant') }}</label>
    
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Password admin :') }}</label>
    
                                    <label for="" class="col-md-3 col-form-label text-md-right">{{ __('whateveryouwant') }}</label>
    
                            </div>
                            <hr>
                            {{ __('* username wajib disi ( users ) :') }}
                            <div class="form-group">
                                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Username :') }}</label>
    
                                    <label for="" class="col-md-3 col-form-label text-md-right">{{ __('users') }} </label>
    
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('User non-admin :') }}</label>
    
                                    <label for="" class="col-md-3 col-form-label text-md-right">{{ __('whateveryouwant') }}</label>
    
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Password non-admin :') }}</label>
    
                                    <label for="" class="col-md-3 col-form-label text-md-right">{{ __('whateveryouwant') }}</label>
    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
