@extends('layouts.master-blank')

@section('content')

    <div class="wrapper-page">
        <div class="card overflow-hidden account-card mx-3">
            <div class="account-card-content">
                <form class="form-horizontal m-t-30" method="POST" action="aCheck">
                    @csrf

                    <div style = "text-align: center; margin-top: -50px;">          
                        <img src="assets/images/IGI.jpg" width="220px" height="150px" alt="">
                    </div>


                    <div class="form-group">
                        <label for="username" class="col-form-label ">{{ __('Username') }}</label>

                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ $username }}" required autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label ">{{ __('New Password') }}</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Repeat password" class="col-form-label ">{{ __('Repeat Password') }}</label>

                        <input id="rPassword" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="rPassword" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                   
                    <div class="form-group row m-t-20">
                        <div class=" col-sm-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
    <!-- end wrapper-page -->
@endsection

@section('script')
@endsection


