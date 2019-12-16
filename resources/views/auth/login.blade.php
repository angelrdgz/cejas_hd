@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center d-flex justify-content-center">
        <div class="col-md-4">
            <h1 class="text-center title">CEJAS HD</h1>
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset('/images/profile.jpg') }}" class="rounded-circle mx-auto d-block" alt="">
                    <form method="POST" action="{{ url('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="">
                                    @error('email')
                                    <span class="invalid-feedback form-text text-muted" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Contraseña</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--<div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="el-switch">
                                        <input type="checkbox" name="switch">
                                        <span class="el-switch-style"></span>
                                    </label>
                                    <label class="custom-control-label" for="customSwitch1">{{ __('Remember Me') }}</label>
                                </div>
                            </div>
                        </div>-->

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-block btn-primary">
                                    ENTRAR
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection