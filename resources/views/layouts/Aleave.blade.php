@extends('layouts.eMaster')

@include('layouts.clock')

@section('content')

    
    <div class="eWrapper-page" style = "width: 80%; margin-left: 10%;">
        <div class="card overflow-hidden account-card mx-3">
            
            <div class="account-card-content">
                <form class="form-horizontal m-t-30" method="POST" action="prLeave">
                    @csrf        
                                    
                    @foreach($notes as $note)
                        <div class="form-group">
                            <label for="Name" class="col-form-label ">{{ __('username') }}</label>

                            <input id="firstname" type="text" style = "width: 47%;" class="form-control @error('email') is-invalid @enderror"
                                name="username" value="{{$note->username}}" required autocomplete="firstname" autofocus readonly>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" style = "margin-top: -84.5px; margin-left: 50%">
                            <label for="Lastname" class="col-form-label ">{{ __('Designation') }}</label>

                            <input id="lastname" type="text" style = "width: 100%;" class="form-control @error('email') is-invalid @enderror"
                                name="lastname" value="{{$note->Designation}}" required autocomplete="lastname" autofocus readonly>

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group" style="margin-top: 21px;">
                            <div><label for="Designation" class="col-form-label ">{{ __('Department') }}</label></div>

                            <select disabled = 'true' name="dept" id="Typ_leave" style = "width: 47%; height: 35px;" 
                                name="email" value="" required autocomplete="email" autofocus>
                                <option>Annual</option>
                                <option>Casual</option>
                                <option>Compassionate</option>
                                <option>Sick</option>
                                <option>Study</option>
                                <option selected>{{ $note->Department }}</option>
                            </select>

                            @error('Designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" style = "margin-top: -87px; margin-left: 50%">
                            <div><label for="Branch" class="col-form-label ">{{ __('Branch') }}</label></div>

                            <select disabled = "True" name="branch" id="Typ_leave" style = "width: 100%; height: 35px;" 
                                name="email" value="" required autocomplete="email" autofocus>
                                <option>Annual</option>
                                <option>Casual</option>
                                <option>Compassionate</option>
                                <option>Sick</option>
                                <option>Study</option>
                                <option selected>{{$note->Branch}}</option>
                            </select>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group" style="margin-top: 30px;">
                            <label for="Alternate Email" class="col-form-label ">{{ __('Alternate Email') }}</label>

                            <input id="Staff_number" type="text" style = "width: 47%;" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $note->Email }}" required autocomplete="email" autofocus readonly>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" style = "margin-top: -84.5px; margin-left: 50%">
                            <label for="Work Phone" class="col-form-label ">{{ __('Work Phone') }}</label>

                            <input id="work_phone" type="text" style = "width: 100%;" class="form-control @error('wphone') is-invalid @enderror"
                                name="workphone" value="{{ $note->phone_no }}" required autocomplete="work phone" autofocus readonly>

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Leave Year" class="col-form-label ">{{ __('Leave Year') }}</label>

                            <input id="Leave Year" type="text" style = "width: 40%;" class="form-control @error('Leave year') is-invalid @enderror"
                                name="year" value="{{$note->leave_year}}" required autocomplete="email" autofocus readonly>

                            @error('Leaveyear')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" style = "margin-top: -84.5px; margin-left: 63%" >
                            <label for="Type of Leave" class="col-form-label ">{{ __('Type of Leave') }}</label>

                            <select disabled = 'True' name="lvtype" id="Typ_leave" style = "width: 100%; height: 35px;" 
                                name="email" value="" required autocomplete="email" autofocus>
                                <option>Annual</option>
                                <option>Casual</option>
                                <option>Compassionate</option>
                                <option>Sick</option>
                                <option>Study</option>
                                <option selected>{{$note->leave_type}}</option>
                            </select>

                            @error('Leaveyear')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" style = "margin-top: -84.5px; margin-left: 42%">
                            <label for="Pay Leave Allowance" class="col-form-label ">{{ __('Pay Leave Allowance') }}</label>

                            @if($note->pay_allowance == 'on')
                                <input class="form-control" type="checkbox" style = "margin-left: -38.5%; height: 20px; margin-top: 7px;" name="allwnce" id="remember"  checked autofocus>

                            @else
                                <input class="form-control" type="checkbox" style = "margin-left: -38.5%; height: 20px; margin-top: 7px;" name="allwnce" id="remember"  autofocus>                         
                            @endif

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Reason" class="col-form-label ">{{ __('Reason For Leave') }}</label>

                            <textarea id="work_phone" type="text" style = "width: 100%; height: 90px;" class="form-control @error('wphone') is-invalid @enderror"
                                name="reason" value="{{ $note->Reason }}" readonly required autocomplete="work phone" autofocus> {{ $note->Reason }}  </textarea>

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Commencement" class="col-form-label ">{{ __('Commencement') }}</label>

                            <input type="number" name = "c_day"  min="1" max="31" placeholder="Day" required="true" style = "width: 10.5% " class="form-control" value = '{{$note->start_day}}' readonly/>
                
                            <select  disabled = "true" name = "c_month" class="form-control" style = "width: 19%; margin-left: 10.7%; margin-top: -35px;">  
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
                                <option selected>{{$note->start_month}}</option>
                            </select>

                            <input type="number" name = "c_year" value="{{$note->start_year}}" min="1900" max="2002" class="form-control" placeholder="Year" style = "width: 15.5%; margin-left: 30%; margin-top: -35px" required="true" readonly/>

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group" style = "margin-top: -84.5px; margin-left: 50%">
                            <label for="Resumption" class="col-form-label ">{{ __('Resumption') }}</label>

                            <input type="number" name = "r_day" value="{{$note->resumption_day}}" min="1" max="31" placeholder="Day" required="true" style = "width: 20%" class="form-control" readonly/>
                
                            <select  disabled = "True" name = "r_month" class="form-control" style = "width: 48%; margin-left: 20.3%; margin-top: -35px;">  
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
                                <option selected>{{$note->resumption_month}}</option>
                            </select>

                            <input type="number" name = "r_year" value="{{$note->resumption_year}}" min="1900" max="2002" class="form-control" placeholder="Year" style = "width: 29%; margin-left: 70%; margin-top: -35px" required="true" readonly/>

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <br>

                        <div class="form-group" style="margin-top: -20px;">
                            <div><label for="Designation" class="col-form-label ">{{ __('H.O.D') }}</label></div>

                            <select name="hod" id="Typ_leave" style = "width: 47%; height: 35px;" 
                                name="email" value="" required autocomplete="email" autofocus>
                                <option>otijani</option>
                                <option>Casual</option>
                                <option>aiwu</option>
                                <option>Sick</option>
                                <option>Study</option>
                            </select>

                            @error('Designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <input type="hidden" name="lid" value="{{$note->id}}">
                        </div>

                        <div class="form-group" style = "margin-top: -87px; margin-left: 50%">
                            <div><label for="Branch" class="col-form-label ">{{ __('Relieving officer') }}</label></div>

                            <select disabled = "true" name="rlv" id="Typ_leave" style = "width: 100%; height: 35px;" 
                                name="email" value="" required autocomplete="email" autofocus>
                                <option>Annual</option>
                                <option>Casual</option>
                                <option>Compassionate</option>
                                <option>Sick</option>
                                <option>Study</option>
                                <option selected>{{$note->rlv}}</option>
                            </select>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group row m-t-20">
                            <div class="col-sm-6 text-right" style= "margin-top: 45px; margin-left: -10%;">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit" style = "width : 50%">Accept</button>
                            </div>

                            <div class="col-sm-6 text-right" style = "margin-left: -10px; margin-top: 45px;">
                                <a href="{{ url('rleave', ['id' => $note->id]) }}"><input type="button" value = "Reject" class="btn btn-primary w-md waves-effect waves-light" style = "width : 50%;"></a> <!-- A link containing the leave id!-->
                            </div>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>

    </div>
    
    <!-- end wrapper-page -->
@endsection

@section('script')
@endsection


