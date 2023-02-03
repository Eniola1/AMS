@extends('layouts.eMaster')

@include('layouts.clock')

@section('content')

    <div class="eWrapper-page" style = "width: 80%; margin-left: 10%;">
        <div class="card overflow-hidden account-card mx-3">
            
            <div class="account-card-content">
                <form class="form-horizontal m-t-30" method="POST" action="{{ route('login') }}">
                    @csrf              
                    <div style = "text-align: center; margin-top: -50px;">          
                        <img src="assets/images/IGI.jpg" width="220px" height="150px" alt="">
                    </div>

                    <div class="form-group">
                        <label for="Name" class="col-form-label ">{{ __('Receiver') }}</label>

                        <input id="firstname" type="text" style = "width: 100%;" class="form-control @error('email') is-invalid @enderror"
                            name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="Designation" class="col-form-label ">{{ __('Title') }}</label>

                        <input id="Designation" type="text" style = "width: 100%;" class="form-control @error('email') is-invalid @enderror"
                            name="Designation" value="{{ old('lastname') }}" required autocomplete="Designation" autofocus>

                        @error('Designation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="Reason" class="col-form-label ">{{ __('Week Activity') }}</label>

                        <textarea id="work_phone" type="text" style = "width: 100%; height: 90px;" class="form-control @error('wphone') is-invalid @enderror"
                            name="workphone" value="{{ old('workphone') }}" required autocomplete="work phone" autofocus> </textarea>

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


