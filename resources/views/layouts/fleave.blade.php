@extends('layouts.eMaster')

@include('layouts.clock')

@section('content')

    <div class="eWrapper-page" style = "width: 80%; margin-left: 10%;">
        <div class="card overflow-hidden account-card mx-3">
            
            <div class="account-card-content">
                <form class="form-horizontal m-t-30" method="POST" action="Leave">
                    @csrf              
                    <div style = "text-align: center; margin-top: -50px;">          
                        <img src="assets/images/IGI.jpg" width="220px" height="150px" alt="">
                    </div>

                    <div class="form-group">
                        <label for="Name" class="col-form-label ">{{ __('username') }}</label>

                        <input id="firstname" type="text" style = "width: 47%;" class="form-control @error('email') is-invalid @enderror"
                            name="username" value="{{ $username }}" required autocomplete="firstname" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style = "margin-top: -84.5px; margin-left: 50%">
                        <label for="Lastname" class="col-form-label ">{{ __('Lastname') }}</label>

                        <input id="lastname" type="text" style = "width: 100%;" class="form-control @error('email') is-invalid @enderror"
                            name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="Designation" class="col-form-label ">{{ __('Designation') }}</label>

                        <input id="Designation" type="text" style = "width: 47%;" class="form-control @error('email') is-invalid @enderror"
                            name="designation" value="{{ old('lastname') }}" required autocomplete="Designation" autofocus>

                        @error('Designation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group" style = "margin-top: -85px; margin-left: 50%">
                        <label for="Unit/Dept/Branch" class="col-form-label ">{{ __('Unit/ Dept /Branch') }}</label>

                        <input id="Unit" type="text" style = "width: 100%;" class="form-control @error('email') is-invalid @enderror"
                            name="unit" value="{{ old('Unit') }}" required autocomplete="Unit" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="Alternate Email" class="col-form-label ">{{ __('Alternate Email') }}</label>

                        <input id="Staff_number" type="text" style = "width: 47%;" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('Alt') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style = "margin-top: -84.5px; margin-left: 50%">
                        <label for="Work Phone" class="col-form-label ">{{ __('Work Phone') }}</label>

                        <input id="work_phone" type="text" style = "width: 100%;" class="form-control @error('wphone') is-invalid @enderror"
                            name="workphone" value="{{ old('workphone') }}" required autocomplete="work phone" autofocus>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Leave Year" class="col-form-label ">{{ __('Leave Year') }}</label>

                        <input id="Leave Year" type="text" style = "width: 40%;" class="form-control @error('Leave year') is-invalid @enderror"
                            name="year" value="{{ old('Leaveyear') }}" required autocomplete="email" autofocus>

                        @error('Leaveyear')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style = "margin-top: -84.5px; margin-left: 63%" >
                        <label for="Type of Leave" class="col-form-label ">{{ __('Type of Leave') }}</label>

                        <select name="type" id="Typ_leave" style = "width: 100%; height: 35px;" 
                            name="email" value="" required autocomplete="email" autofocus>
                            <option>Annual</option>
                            <option>Casual</option>
                            <option>Compassionate</option>
                            <option>Sick</option>
                            <option>Study</option>
                        </select>

                        @error('Leaveyear')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style = "margin-top: -84.5px; margin-left: 42%">
                        <label for="Pay Leave Allowance" class="col-form-label ">{{ __('Pay Leave Allowance') }}</label>

                        <input class="form-control" type="checkbox" style = "margin-left: -38.5%; height: 20px; margin-top: 7px;" name="allowance" id="remember"
                                    {{ old('remember') ? 'checked' : '' }} autofocus>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Reason" class="col-form-label ">{{ __('Reason For Leave') }}</label>

                        <textarea id="work_phone" type="text" style = "width: 100%; height: 90px;" class="form-control @error('wphone') is-invalid @enderror"
                            name="reason" value="{{ old('workphone') }}" required autocomplete="work phone" autofocus> </textarea>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Commencement" class="col-form-label ">{{ __('Commencement') }}</label>

                        <input type="number" name = "c_day" value="" min="1" max="31" placeholder="Day" required="true" style = "width: 10.5% " class="form-control"/>
            
                        <select name = "c_month" class="form-control" style = "width: 19%; margin-left: 10.7%; margin-top: -35px;">  
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

                        <input type="number" name = "c_year" value="" min="1900" max="2002" class="form-control" placeholder="Year" style = "width: 15.5%; margin-left: 30%; margin-top: -35px" required="true"/>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group" style = "margin-top: -84.5px; margin-left: 50%">
                        <label for="Resumption" class="col-form-label ">{{ __('Resumption') }}</label>

                        <input type="number" name = "r_day" value="" min="1" max="31" placeholder="Day" required="true" style = "width: 20%" class="form-control"/>
            
                        <select name = "r_month" class="form-control" style = "width: 48%; margin-left: 20.3%; margin-top: -35px;">  
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

                    <br>

                    <div class="form-group">
                        <label for="Name" class="col-form-label ">{{ __('H.O.D Name') }}</label>

                        <input id="firstname" type="text" style = "width: 47%;" class="form-control @error('email') is-invalid @enderror"
                            name="hod" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style = "margin-top: -84.5px; margin-left: 50%">
                        <label for="Designation" class="col-form-label ">{{ __('H.O.D Designation') }}</label>

                        <input id="lastname" type="text" style = "width: 100%;" class="form-control @error('email') is-invalid @enderror"
                            name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="Name" class="col-form-label ">{{ __('HR Name') }}</label>

                        <input id="firstname" type="text" style = "width: 47%;" class="form-control @error('email') is-invalid @enderror"
                            name="hr" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style = "margin-top: -84.5px; margin-left: 50%">
                        <label for="Designation" class="col-form-label ">{{ __('HR Designation') }}</label>

                        <input id="lastname" type="text" style = "width: 100%;" class="form-control @error('email') is-invalid @enderror"
                            name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row m-t-20" style= "margin-top: 45px; margin-left: 30%;">
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit" style = "width : 100%">Submit</button>
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


