@extends('layouts.eMaster')

@include('layouts.clock')

@section('css')
<!-- Table css -->
<link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css"
    media="screen">
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Late Time</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Late Time</a></li>


    </ol>
</div>
@endsection

@section('button')
<a href="/attendance" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Attendance Table</a>


@endsection

@section('content')
@include('includes.flash')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                            <thead>
                                <tr>
                                    <th data-priority="1">Date</th>
                                    <th data-priority="2">Employee</th>
                                    <th data-priority="3">subject</th>
                                    <th data-priority="4">Status</th>
                                    <th data-priority="6">Leave-ID</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)

                                <tr>
                                    <td>{{ $result->created_at }}</td>
                                    <td>{{ $result->to }}</td>
                                    <td>{{ $result->subject }}</td>
                                    <td>{{ $result->status }}</td>
                                    <td>{{ $result->leave_id }} </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection


@section('script')
<!-- Responsive-table-->
<script src="{{ URL::asset('plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}"></script>
@endsection

@section('script')
<script>
    $(function () {
        $('.table-responsive').responsiveTable({
            addDisplayAllBtn: 'btn btn-secondary'
        });
    });
</script>
@endsection