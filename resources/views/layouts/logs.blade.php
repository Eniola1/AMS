@extends('layouts.eMaster')

@include('layouts.clock')

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
                                        <th data-priority="2">Employee ID</th>
                                        <th data-priority="3">Name</th>
                                        <th data-priority="4">Attendance</th>

                                        <th data-priority="6">Time In</th>
                                        <th data-priority="7">Time Out</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($attendances as $attendance)

                                        <tr>
                                            <td>{{ $attendance->time_in }}</td>
                                            <td>{{ $attendance->emp_id }}</td>
                                            <td>{{ $attendance->username }}</td>
                                            <td></td>
                                            <td>{{ $attendance->time_in }} </td>
                                            <td>{{ $attendance->time_out }}</td>
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
        $(function() {
            $('.table-responsive').responsiveTable({
                addDisplayAllBtn: 'btn btn-secondary'
            });
        });
    </script>
@endsection
