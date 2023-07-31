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
                                <h4> ETA Report </h4>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                        <div class="card-body">
                                            <form method="POST" action="{{route('eta_report')}}" id="order_form">
                                                @csrf
                                                <div class="row mb-2 ml-3">
                                                    <div class="col-lg-6">
                                                        <label><b>Select Batches</b></span>
                                                        </label><br>
                                                        <select required class="batches-multiple form-control" name="batch_list[]" multiple="multiple">
                                                            @foreach ($batches as $batch)
                                                                <option value="{{$batch->id}}">{{$batch->batch_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <input class="btn btn-success" style="margin-top:28px" type="submit" name="filter"
                                                            id="filter" value="Get Data" />
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <input class="btn btn-success" style="margin-top:28px" type="submit" name="download"
                                                            id="download" value="Export to Excel" />
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="p-4 table-responsive">
                                                <table id="datatable" class="table table-bordered nowrap"
                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>APP #</th>
                                                            <th>Batch Name</th>
                                                            <th>Seller #</th>
                                                            <th>Property Address</th>
                                                            <th>Property City</th>
                                                            <th>Status</th>
                                                            <th>ETA</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (isset($orders))
                                                        @foreach($orders as $order)
                                                        <tr>
                                                            <td>{{ $order->jpm_number }}</td>
                                                            <td>{{ $order->batch_name }}</td>
                                                            <td>{{ $order->seller_number }}</td>
                                                            <td>{{ $order->property_address }}</td>
                                                            <td>{{ $order->property_city }}</td>
                                                            <td>{{ $order->property_address }}</td>
                                                            <td>{!! isset($order->eta_date) ? date("m/d/Y", strtotime($order->eta_date)) : NULL !!}</td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
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
</div>
<script>
    $(document).ready(function() {
        $(".batches-multiple").select2({
            maximumSelectionLength: 10
        });
    });
</script>
<!-- end page-wrapper -->
@endsection
