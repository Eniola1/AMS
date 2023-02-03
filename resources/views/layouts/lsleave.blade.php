@extends('layouts.eMaster')

@include('layouts.clock')

@section('content')
 
    <div class="eWrapper-page" style = "width: 80%; margin-left: 10%;">
        <div class="card overflow-hidden account-card mx-3">
            
            <div class="account-card-content">
                <form class="form-horizontal m-t-30" method="POST" action="fsLeave">
                    @csrf              

                    @foreach($results as $results)
                        <div class="form-group">
                            To:{{$results->to}}
                        </div>

                        <div class="form-group">
                            From: {{$results->from}}
                        </div>

                        <div class="form-group">
                            Date: {{$results->created_at}}
                        </div>

                        <div class="form-group">
                            Subject: {{$results->subject}}
                        </div><hr>

                        <div class="form-group">
                            {{$results->Response}}
                        </div>

                        <br>
                    
                    @endforeach  
                </form>
            </div>
        </div>

    </div>

    <!-- end wrapper-page -->
@endsection

@section('script')
@endsection


