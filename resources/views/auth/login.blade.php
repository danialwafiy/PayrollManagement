@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card-transparent">
                <div class="card-header text-center border-0" style="background-color:rgba(0,0,0,0)">
                    <img class="img img-fluid w-25 mx-auto" src="/img/logo.png">
                </div>
                <div class="card-body mt-3">
                     <hr class="bg-white">
                    <h4 class="text-center text-white">Payroll Management System</h4>
                    <hr class="bg-white">
                    <br>
                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf
                        <div class="form-group row mt-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right text-white">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right text-white">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right text-white">{{ __('Login as') }}</label>

                            <div class="col-md-6 text-white">
                                <input type="radio" class="toggle" name="role" value="admin" required> Administrator
                                <br>
                                <input type="radio" class="toggle" name="role" value="employee"> Employee
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="col-md-3 btn btn-primary mr-1">
                                    <i class="fa fa-sign-in-alt"></i> {{ __('Login') }}
                                </button>

                                <button class="col-md-3 btn btn-secondary text-white"  onclick="resetForm();">
                                <i class="fa fa-undo"></i> {{ __('Clear') }}
                                </button>
                            </div>
                        </div>
<!--                         <div class="form-group row mt-3">
                            <div class="col-md-8 offset-md-4">
                                <a href="/password/reset" class="text-white">Forgot Password ?</a>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    function resetForm() {
        event.preventDefault()
        document.getElementById("login-form").reset();
    }
</script>
