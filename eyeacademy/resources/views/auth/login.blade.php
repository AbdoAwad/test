@extends('auth.layouts.app')

@push('css')
    <style>
        .auth{
            background-image: url('{{asset('image/loginBack.svg')}}');
            background-size: 400px;
            background-repeat: no-repeat;
            background-position: right bottom;
        }
        .card {
            width: 60%;
            right: -550px !important;
            height: 450px
        }

        @media (max-width: 992px) {
            .card {
                right: -50px !important; ;
            }
        }

        @media (max-width: 720px) {
            .auth .auth_left {
                width: 100% ;
            }
            .card {
                right: auto !important; ;
                width: 150%;
            }
        }
    </style>
@endpush

@section('content')

    <div class="auth">
        <div class="auth_left">
            <img src="{{asset('image/logobw.png')}}" class="img-fluid" alt="login page" width="40%" style="position: absolute"/>
            <div class="card" style="">
                <div class="text-center mb-2">
                    <a class="header-brand" ><img src="{{asset('image/EyeAcademyLogo.png')}}" width="45%" height="25%" class="img-fluid " alt="login page" /></a>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card-body">
                        <div class="card-title">Login to your account</div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection
