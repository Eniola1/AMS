@extends('layouts.master-blank')

@section('content')

    <div class="wrapper-page">
        <div class="card overflow-hidden account-card mx-3">
            <div class="account-card-content">
                <form class="form-horizontal m-t-30" method="POST" action="IGI">
                    @csrf
   
                    <div style = "text-align: center; margin-top: -50px;">          
                        <img src="assets/images/IGI.jpg" width="220px" height="150px" alt="">
                    </div>

                    <br>

                    <input type="hidden" name = "mac" id = "mac">

                    <div class="form-group">
                        <label for="username" class="col-form-label ">{{ __('Username') }}</label>
                        <input id="username" name="username" type="text" class="form-control"
                            name="username" value="{{ old('username') }}" required >
                    </div>

                    <?php 
                    
                    if(isset($excpt))
                    {
                        echo '<div style="color: red;">'.$excpt.'</div>';
                    }

                    if(isset($excptDV))
                    {
                        echo '<div style="color: red;">'.$excptDV.'</div>';
                    }

                    if(isset($excptLC))
                    {
                        echo '<div style="color: red;">'.$excptLC.'</div>';
                    }

                    ?>


                    <div class="form-group">
                        <label for="password" class="col-form-label ">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

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

    <script type="text/javascript">
        document.getElementById("mac").value = unescape(macAddress);
    </script>"
@endsection

@section('script')
@endsection


