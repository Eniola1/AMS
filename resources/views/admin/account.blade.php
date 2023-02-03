@extends('layouts.master-blank')

@section('content')

    <div class="eWrapper-page" style = "margin-top: 150px; width: 515px;">
        <div class="card overflow-hidden account-card mx-3">

            <div class="account-card-content" style = "margin-top: 50px;">
                    
                    <div style = "text-align: center; margin-top: -50px;">          
                        <img src="assets/images/IGI.jpg" width="220px" height="150px" alt="">
                    </div>

                    <br><br>
                    <div style ="margin-left: 158px; margin-top: -15px; font-size: 25px; color: orange; font-family: Calibri;"><b>LOGIN AS</b></div>
                    <br>
                    <div class="form-group row m-t-20">
                        <div class="col-sm-6 text-right" style = "margin-left: -30px;">
                            <a href="/admin"><button class="btn btn-primary w-md waves-effect waves-light" type="">Admin</button></a>
                        </div>

                        <div class="col-sm-6 text-right">
                            <a href="/employee"><button class="btn btn-primary w-md waves-effect waves-light" type="">Staff</button></a>
                        </div>
                    </div>

            </div>
        </div>

    </div>
    <!-- end wrapper-page -->
@endsection

@section('script')
@endsection


