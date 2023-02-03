@extends('layouts.eMaster')

@include('layouts.clock')

@section('content')

<div class="eWrapper-page" style = "margin-top: 5px; width: 515px; height: 700px;">
        <div class="card overflow-hidden account-card mx-3">

            <div class="account-card-content" style = "margin-top: 50px;">
                    
                    <div style = "text-align: center; margin-top: -80px;">          
                        <img src="assets/images/IGI.jpg" width="220px" height="150px" alt="">
                    </div>

                    <br><br>
                    <div style ="margin-left: 128px; margin-top: -15px; font-size: 25px; color: orange; font-family: Calibri;"><b>Pick an action:</b></div>

                    <br>
                    <div class="form-group row m-t-20">
                        <div class="col-sm-6 text-right" style = "margin-left: -70px;">
                            <a href="/ncheckin"><button class="btn btn-primary w-md waves-effect waves-light" type="">Create New</button></a>
                        </div>

                        <div class="col-sm-6 text-right" style = "margin-left: -70px;">
                            <a href="/rcheckin"><button class="btn btn-primary w-md waves-effect waves-light" type="">Requests</button></a>
                        </div>

                        <div class="col-sm-6 text-right" style = "margin-left: 220px; margin-top: -35px;">
                            <a href="/scheckin"><button class="btn btn-primary w-md waves-effect waves-light" type=""> checkin sent</button></a>
                        </div>
                    </div>
            </div>
        </div>

    </div>
    <!-- end wrapper-page -->
@endsection

@section('script')
@endsection


