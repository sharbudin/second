@extends('app.dashboard')

@section('content')
<style>
    .card {
        border-radius: 20px !important;
    }

    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        color: #fff;
        background-color: #fda354 !important;
        border-color: #fda354 !important;
    }
</style>
<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content pr-5 pl-5">
        <div class="container-fluid mt-2">
            <div class="card placeorders_top_border">
                <div class="card-body">
                    <h4 class="text-center">Received Orders Status</h4>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:9px">
                            <thead>
                                <tr style="font-size: 9.5px">
                                    <th>Batch</th>
                                    <th>Total#</th>
                                    <th>Open</th>
                                    <th>In Progress </th>
                                    <th>Follow Up </th>
                                    <th>Clarification Req</th>
                                    <th>Clarification Rec</th>
                                    <th>Qc Queue</th>
                                    <th>Completed</th>
                                    <th>Closed</th>
                                    <th>Cancelled</th>
                                    {{-- <th>Pending</th> --}}
                                    <th>Mail Away</th>
                                    <th>On Hold</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr class="font-weight-bold text-center" style="color:#36374c">
                                    <td>{{ $order->batch_name }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->open }}</td>
                                    <td>{{ $order->in_progress }}</td>
                                    <td>{{ $order->follow_up }}</td>
                                    <td>{{ $order->clarification_req }}</td>
                                    <td>{{ $order->clarification_rec }}</td>
                                    <td>{{ $order->qc_queue }}</td>
                                    <td>{{ $order->completed }}</td>
                                    <td>{{ $order->closed }}</td>
                                    <td>{{ $order->cancelled }}</td>
                                    {{-- <td>{{ $order->pending }}</td> --}}
                                    <td>{{ $order->mail_away }}</td>
                                    <td>{{ $order->on_hold }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-2">
            <div class="card placeorders_top_border">
                <div class="card-body">
                    <h4 class="text-center">Orders Follow Up</h4>
                    <ul class="nav nav-tabs font-weight-bold" role="tablist">
                        @for($i = 0; $i < count($dates); $i++)
                        <li class="nav-item"><input type="button" onclick="followUpTable('{!! substr($dates[$i], 0, 10) !!}')" class="nav-link btn btn-white @if($i == 0) active @endif" value="{{ $dates[$i]->format('m/d/y') }}"></li>
                        @endfor
                    </ul>
                    <div class="table-responsive mt-2">
                        <table id="datatable1" class="table table-bordered nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:11px">
                            <thead>
                                <tr class="text-center">
                                    <th>Order #</th>
                                    <th>Property Address</th>
                                    <th>City </th>
                                    <th>County </th>
                                    <th>State </th>
                                    <th>Assigned to </th>
                                    <th>Order </th>
                                    <th style="width: 40%;">Follow up Comments </th>
                                    <th>date</th>
                                </tr>
                            </thead>
                            <tbody id="follow_up_table">
                                {{-- Data from ajax server side --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/jquery-3.6.0.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script>
 $(document).ready(function() {
    var table = $('#datatable1').DataTable({
        columns: [
            { data: 'jpm_number' },
            { data: 'property_address' },
            { data: 'property_city' },
            { data: 'county_name' },
            { data: 'short_code' },
            { data: 'user_name',
              render: function(data) {
                  return capitalizeFirstLetter(data);
              }
            },
            {
              data: null,
              render: function(data) {
                return '<a href="{{url("ordercert")}}/' + data.id + '" title="Edit"><i class="dripicons-arrow-thin-right" aria-hidden="true"></i></a>';
              }
            },
            {
              data: 'comments',
              render: function(data) {
                  return data ? '<td style="width:40%">' + nl2br(data) + '</td>' : '';
              }
            },
            {
              data: 'followup_date',
              visible: false
            }
        ],
        ajax: {
            url: '{{ url("follow_up_data") }}',
            type: 'GET',
            dataSrc: ''
        }
    });

    @if(isset($dates[0]))
    table.column(8).search('{!! substr($dates[0], 0, 10) !!}').draw();
    @endif
});

function capitalizeFirstLetter(str) {
    return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
}

function nl2br(str) {
    return str ? str.replace(/\n/g, '<br>') : '';
}

function followUpTable(date) {
    var table = $('#datatable1').DataTable();
    table.column(8).search(date).draw();

    var buttons = document.querySelectorAll('.nav-item input[type="button"]');
    buttons.forEach(function(button) {
        button.classList.remove('active');
    });
    // Add the 'active' class to the clicked button
    event.target.classList.add('active');
}

</script>
@endsection
