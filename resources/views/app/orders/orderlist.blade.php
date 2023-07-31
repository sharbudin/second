@extends('app.dashboard')

@section('content')

<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content pr-5 pl-5">
        <div class="container-fluid mt-2">
            <div id="pdfview"></div>
            <div class="row">
                <div class="col-lg">
                    <div class="card placeorders_top_border">
                        <div class="card-body">
                            <div class=" mb-3 table-responsive">
                                <table style="border-collapse: collapse; border-spacing: 0;">
                                    <tr style="border-top: transparent;">
                                        <td style="padding: 0px;">
                                            <a href="{{url('orderlist_by/All')}}"  style="vertical-align: middle;">
                                                <button name="statusid" class="btn btn-sm @if($type == 'All') btn-warning @else btn-success @endif mr-2">
                                                    <span style="font-size: 11px;font-weight:bold">
                                                        All ({{$total_order_count}})
                                                    </span>
                                                </button>
                                            </a>
                                        </td>
                                        @foreach ($status_types as $status_type)
                                        @if($status_type->id != 11)
                                        <td style="padding: 0px;">
                                            @if($status_type->order_count == 0)
                                                <button disabled name="statusid" class="btn btn-sm btn-success mr-2">
                                                    <span style="font-size: 11px;font-weight:bold">
                                                        {{$status_type->status_type}}({{$status_type->order_count}})
                                                    </span>
                                                </button>
                                            @else
                                                <a href="{{url('orderlist_by/'.$status_type->id)}}"  style="vertical-align: middle;">
                                                    <button @if($status_type->order_count == 0) disabled @endif name="statusid" class="btn btn-sm @if($type == $status_type->id) btn-warning @else btn-success @endif mr-2">
                                                        <span style="font-size: 11px;font-weight:bold">
                                                            {{$status_type->status_type}}({{$status_type->order_count}})
                                                        </span>
                                                    </button>
                                                </a>
                                            @endif
                                        </td>
                                        @endif
                                        @endforeach
                                    </tr>
                                </table>
                            </div>
                            <div class="p-4 table-responsive">
                                <table id="datatable" class="table table-bordered nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Property Address</th>
                                            <th>City</th>
                                            <th>County</th>
                                            <th>State</th>
                                            <th>Assigned to</th>
                                            <th>Status</th>
                                            <th>Order</th>
                                            @if($type == 8)
                                            <th>JSON</th>
                                            @endif
                                            @if($type == 4)
                                                <th>Follow up Date</th>
                                                <th>Follow up Comments</th>
                                            @elseif($type == 5 || $type == 6)
                                                <th>Clarification Comments</th>
                                            @else
                                                <th>Borrower Name</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr style="color:#36374c" >
                                            <td>{{ $order->jpm_number }}</td>
                                            <td>{{ $order->property_address }}</td>
                                            <td>{{ $order->property_city }}</td>
                                            <td>{{ $order->county_name }}</td>
                                            <td>{{ $order->short_code }}</td>
                                            <td>{!! ucfirst($order->user_name) !!}</td>
                                            <td>{{ $order->status_type }}</td>
                                            <td class="text-center">
                                                <a href="{{url('ordercert/'.$order->id)}}" title="Edit"><i class="dripicons-arrow-thin-right"
                                                            aria-hidden="true"></i></a>
                                            </td>
                                            @if($type == 8)
                                            <td class="text-center">
                                                <a style="cursor:pointer" onclick="viewjson({{$order->id}})"><i class="dripicons-arrow-thin-right"
                                                            aria-hidden="true"></i></a>
                                            </td>
                                            @endif
                                            @if($type == 4)
                                                <td>{!! isset($order->followup_date) ? date("m/d/Y", strtotime($order->followup_date)) : NULL !!}</td>
                                                <td>{{ $order->comments }}</td>
                                            @elseif($type == 5 || $type == 6)
                                                <td>{{ $order->comments }}</td>
                                            @else
                                                <td>{!! ucfirst($order->borrower_firstname) !!} {!! ucfirst($order->borrower_lastname) !!}</td>
                                            @endif
                                        </tr>
                                        @endforeach
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
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            responsive: true
        });
    });

    function viewjson(id)
	{
		$("#loading-overlay").show();

		$.ajax({
			type: 'POST',
			url: "{{ url('viewjson') }}",
			data:{
                    orderId: id,
                    _token: "{{csrf_token()}}"
                },
			success: function(response) {
				$("#loading-overlay").hide();
				$('#pdfview').html(response);
				$('#mymodal').modal('show');
			}
		});
	}

</script>
@endsection
