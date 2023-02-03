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

    <?php 
        $MAC = exec('getmac');
        $MAC = strtok($MAC, ' ');
    ?>

    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Location Data</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    
    <body>
    
        <div id="locationData"></div>
        <div> <input type="hidden" value = "<?php echo $MAC;?>" id = 'mac'></div>
    
        <script>
            $(document).ready(function() {
                
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(locationSuccess);
                } 
                else {
                    $("#locationData").html('Your browser does not support location data retrieval.');
                }
    
                function locationSuccess(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var mac = $('#mac').val();

                    $.ajax({
                        type:'post',
                        url:'/location',
                        data:{
                            latitude:latitude,
                            mac: mac,
                            longitude:longitude,
                        },
                        success:function(response) {
                            $("#locationData").html("Latitude: " + latitude + "<br>Longitude: " + longitude);
                        }
                    });
                }
            });
        </script>

    </body>

    </html>
    <!-- end wrapper-page -->
@endsection

@section('script')
@endsection


