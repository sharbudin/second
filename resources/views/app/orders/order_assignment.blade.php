@extends('app.dashboard')

@section('content')

<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content pr-5 pl-5">
        <style>
            .nav-tabs .nav-link.active,
            .nav-tabs .nav-item.show .nav-link {
                color: #fff;
                background-color: #fda354 !important;
                border-color: #fda354 !important;
            }
        </style>
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card placeorders_top_border">
                        <div class="card-body">
                            <div class="col-12 mb-3">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link @if ($type == 1) active @endif" href="{{route('assignorders')}}">
                                            Assign Orders </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if ($type == 2) active @endif" href="{{route('assignedorders')}}">
                                            Assigned Orders </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if ($type == 3) active @endif" href="{{route('unassignedorders')}}">
                                            Unassigned Orders </a>
                                    </li>
                                </ul>
                                <form action="{{route('assignment_update')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if ($type == 1)
                                        <input type="hidden" name="type" value='1'>
                                    @elseif ($type == 2)
                                        <input type="hidden" name="type" value='2'>
                                    @elseif ($type == 3)
                                        <input type="hidden" name="type" value='3'>
                                    @endif
                                <div class="p-4 table-responsive">
                                    <table id="datatable" class="table table-bordered nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Property Address</th>
                                                <th>City </th>
                                                <th>County </th>
                                                <th>State </th>
                                                <th>Status </th>
                                                <th class="text-center">
													All <input type="checkbox" value="" id="selectall" name="selectall" class="pb-0 pt-3"/>
												</th>
                                                @if ($type == 1 || $type == 3)
                                                <td align="center" style="vertical-align: middle;">
													<select style="width: 150px;" required class="form-control form-control-sm" id="user_id" name="user_id">
														<option selected disabled value=""> Select User</option>
                                                        @foreach ($Users as $User)
                                                        <option value="{{ $User->id }}">
                                                            {!! ucfirst($User->user_name) !!}</option>
                                                        @endforeach
													</select>
												</td>
                                                @elseif($type == 2)
                                                <th> User </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                            <tr style="color:#36374c" r>
                                                <td>{{ $order->jpm_number }}</td>
                                                <td>{{ $order->property_address }}</td>
                                                <td>{{ $order->property_city }}</td>
                                                <td>{{ $order->county_name }}</td>
                                                <td>{{ $order->short_code }}</td>
                                                <td>{{ $order->status_type }}</td>
                                                <td align="center">
                                                    <input  type="checkbox" value="{{$order->id}}" id="logs{{$order->id}}" name="orders[]" />
                                                </td>
                                                @if ($type == 1 || $type == 3)
                                                <td> </td>
                                                @elseif($type == 2)
                                                <td>{!! ucfirst($order->user_name) !!}</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
									<div class="col-sm-12 text-center">
                                        @if ($type == 1)
										<input type="submit" class="btn btn-success" value="Assign" name="assign">
                                        @elseif($type == 2)
                                        <input type="submit" class="btn btn-success" value="Unassign" name="unassign">
                                        @elseif($type == 3)
                                        <input type="submit" class="btn btn-success" value="Re-Assign" name="re-assign">
                                        @endif
									</div>
								</div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                responsive: true
            });

            $("#user_id").select2();
        });

    </script>

<Script>
	$(document).ready(function(){
		$("#selectall").on('change', function(){
			if($("input[type=checkbox]").hasClass("checkclass"))
				$("input[type=checkbox]").removeAttr("checked").removeClass('checkclass');
			else
				$("input[type=checkbox]").attr("checked", "checked").addClass('checkclass');
		});

	});
	$(function(){
    var requiredCheckboxes = $('.checkclass :checkbox[required]');
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
});

</Script>
    @endsection
