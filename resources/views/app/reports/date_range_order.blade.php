@extends('app.dashboard')

@section('content')
<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content pr-5 pl-5">
        <div class="container-fluid mt-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="border-top:4px solid blue">
                            <div class="card-body">
                                <h4> Data Range Order Filter </h4>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                        <div class="card-body">
                                            <form method="POST" action="{{route('date_range_order_filter_report')}}" id="order_form">
                                                @csrf
                                                <div class="row mb-2">
                                                    <div class="col-lg-3">
                                                        <label><b>Select Date Range</b><span
                                                                style="color:red;">&nbsp;*</span>
                                                        </label><br>
                                                        <input type="text" class="form-control datepick"
                                                            name="date_range" id="daterange1">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input class="btn btn-success mt-4" type="submit" name="filter"
                                                            id="filter" value="Export to Excel" />
                                                    </div>
                                                </div>
                                            </form>
                                            {{-- <div class="p-4 table-responsive">
                                                <table id="datatable" class="table table-bordered nowrap"
                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>App #</th>
                                                            <th>Received Date</th>
                                                            <th>State</th>
                                                            <th>County</th>
                                                            <th>Product Type</th>
                                                            <th>Status</th>
                                                            <th>Completed Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (isset($demo_report))
                                                        @foreach($demo_report as $order_demo)
                                                        <tr>
                                                            <td>{{ $order_demo->file_number }}</td>
                                                            <td>{!! substr($order_demo->received_date,0,10) !!}</td>
                                                            <td>{{ $order_demo->state_name }}</td>
                                                            <td>{{ $order_demo->county_name }}</td>
                                                            <td>{{ $order_demo->product_type }}</td>
                                                            <td>{{ $order_demo->status_type }}</td>
                                                            <td>{!! substr($order_demo->completed_date,0,10) !!}</td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page-wrapper -->
@endsection
