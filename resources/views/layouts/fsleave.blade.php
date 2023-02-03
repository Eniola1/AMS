@extends('layouts.eMaster')

@include('layouts.clock')

@section('content')
 
    <div class="eWrapper-page" style = "width: 80%; margin-left: 10%;">
        <div class="card overflow-hidden account-card mx-3">
            
            <div class="account-card-content">
                <form class="form-horizontal m-t-30" method="POST" action="fsLeave">
                    @csrf              

                    <div class="form-group">
                        <label for="Name" class="col-form-label ">{{ __('From:') }}</label>

                        <input id="firstname" type="text" style = "width: 47%;" class="form-control @error('email') is-invalid @enderror"
                            name="from" value="{{$username}}" required autocomplete="firstname" autofocus readonly>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style = "margin-top: -84.5px; margin-left: 50%">
                        <label for="Lastname" class="col-form-label ">{{ __('To:') }}</label>

                        <input id="lastname" type="text" style = "width: 100%;" class="form-control @error('email') is-invalid @enderror"
                            name="to" value="{{$to}}" required autocomplete="lastname" autofocus readonly>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div><input type="hidden" name="lid" value="{{$lid}}"></div>

                    <div class="form-group" style="margin-top: 30px;">
                        <label for="Alternate Email" class="col-form-label ">{{ __('Subject:') }}</label>

                        <input id="Staff_number" type="text" style = "width: 47%;" class="form-control @error('email') is-invalid @enderror"
                            name="subject" value="" required autocomplete="email" autofocus >

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style = "margin-top: -84.5px; margin-left: 50%">
                        <label for="Resumption" class="col-form-label ">{{ __('Date:') }}</label>

                        <input type="number" name = "r_day" value="" min="1" max="31" placeholder="Day" required="true" style = "width: 20%" class="form-control" />
            
                        <select  name = "r_month" class="form-control" style = "width: 48%; margin-left: 21%; margin-top: -35px;">  
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>  
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>

                        <input type="number" name = "r_year" value="" min="1900" max="2002" class="form-control" placeholder="Year" style = "width: 29%; margin-left: 70%; margin-top: -35px" required="true"/>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="Reason" class="col-form-label ">{{ __('Response:') }}</label>

                        <textarea id="work_phone" type="text" style = "width: 100%; height: 220px;" class="form-control @error('wphone') is-invalid @enderror"
                            name="reason" value=""  required autocomplete="work phone" autofocus>   </textarea>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <br>
                    
                    <div class="form-group row m-t-20">
                        <div class="col-sm-6 text-right" style= "margin-top: 21px; margin-left: 10%;">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit" style = "width : 50%">Submit</button>
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


