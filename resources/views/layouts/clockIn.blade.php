@extends('layouts.eMaster')

@include('layouts.clock')

@section('content')

    <div class="wrapper-page">
        <div class="card overflow-hidden account-card mx-3">
            
            <div class="account-card-content">
                <form class="form-horizontal m-t-30" method="POST" action="clockOut">
                    @csrf              
                    <div style = "text-align: center; margin-top: -50px;">          
                        <img src="assets/images/IGI.jpg" width="220px" height="150px" alt="">
                    </div>

                    <div class="flex-center position-ref full-height">
                        
                        <div class="content">
                            <div class="title m-b-md">
                                <div class="clockStyle" style = "color:orange; font-size: 50px; margin-top: -20px; text-align: center;" id="clock">123</div>
                            </div>            
                        </div>
                    </div>

                    <div class="form-group row m-t-20">
                        <div class="col-sm-6 text-right">
                            <button style = "margin-left: 100px; border-width: 0px; background-color: #626ed4; color:white; width: 200px; height: 50px; text-align: center; font-family: calibri; font-size: 18px; border-radius: 7px;" type="submit">Clock Out</button>
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


