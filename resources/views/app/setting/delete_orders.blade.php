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
                                <form action="{{route('delete_orders')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="p-4 table-responsive">
                                        <table id="datatable" class="table table-bordered nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        All <input type="checkbox" value="" id="selectall"
                                                            name="selectall" class="pb-0 pt-3" />
                                                    </th>
                                                    <th>Order #</th>
                                                    <th>Property Address</th>
                                                    <th>City </th>
                                                    <th>County </th>
                                                    <th>State </th>
                                                    <th>Status </th>
                                                    <th>Is Active </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                <tr style="color:#36374c">
                                                    <td align="center">
                                                        <input type="checkbox" value="{{$order->id}}"
                                                            id="logs{{$order->id}}" name="orders[]" />
                                                    </td>
                                                    <td>{{ $order->jpm_number }}</td>
                                                    <td>{{ $order->property_address }}</td>
                                                    <td>{{ $order->property_city }}</td>
                                                    <td>{{ $order->county_name }}</td>
                                                    <td>{{ $order->short_code }}</td>
                                                    <td>{{ $order->status_type }}</td>
                                                    @if ($order->is_active == 1)
                                                    <td> Active </td>
                                                    @elseif ($order->is_active == 0)
                                                    <td> Inactive </td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12 text-center">
                                            <input type="submit" class="btn btn-danger" value="Delete" name="delete">
                                            <input type="submit" class="btn btn-warning ml-4" value="Undelete" name="delete">
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
        $(document).ready(function () {
            $("#selectall").on('change', function () {
                if ($("input[type=checkbox]").hasClass("checkclass"))
                    $("input[type=checkbox]").removeAttr("checked").removeClass('checkclass');
                else
                    $("input[type=checkbox]").attr("checked", "checked").addClass('checkclass');
            });

        });
        $(function () {
            var requiredCheckboxes = $('.checkclass :checkbox[required]');
            requiredCheckboxes.change(function () {
                if (requiredCheckboxes.is(':checked')) {
                    requiredCheckboxes.removeAttr('required');
                } else {
                    requiredCheckboxes.attr('required', 'required');
                }
            });
        });

    </Script>
    @endsection
