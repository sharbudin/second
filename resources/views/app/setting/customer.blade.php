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
                            <h4> Customers </h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            @if (Session::has("success"))
                                            <h4 class="text-center" style="color:#17a2b8">{{Session::get('success')}}
                                            </h4>
                                            @endif
                                            <form id="customer-form" action="{{route('customer_update')}}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @if(isset($fieldValues))
                                                @foreach ($fieldValues as $fieldValue)
                                                <input type="hidden" value="{{$fieldValue->id}}" name="id" id="id" />
                                                <input type="hidden" value="{{Session::get('uid')}}" name="added_by"
                                                    id="added_by" />
                                                <h3 class="pt-0 mt-0"> Organization </h3>
                                                <div class="form-group row mb-0 pb-0">
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Name <span style="color:red;">&nbsp;*</span></label>
                                                        <input required type="text" name="customer_name"
                                                            id="customer_name" value="{{$fieldValue->customer_name}}"
                                                            class="form-control" placeholder="Enter Customer Name">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Address </label>
                                                        <input required type="text" name="customer_address"
                                                            id="customer_address"
                                                            value="{{$fieldValue->customer_address}}"
                                                            class="form-control" placeholder="Enter Address">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Logo </label>
                                                        <input type="file" name="customer_logo" id="customer_logo"
                                                            accept="image/png, image/jpg, image/jpeg"
                                                            class="form-control">
                                                        <img src="data:image;base64,{{$fieldValue->customer_logo}}"
                                                            type="image" alt="logo-small" class="logo-sm"
                                                            style="height: 30px;">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Color Code </label>
                                                        <input type="color" name="customer_color_code"
                                                            id="customer_color_code"
                                                            value="{{$fieldValue->customer_color_code}}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-0 pb-0 mt-1">
                                                    @if ($fieldValue->is_active)
                                                    <div class="form-group col-lg-2 mt-1 mb-2 pb-0">
                                                        <input type="checkbox" name="is_active" id="is_active"
                                                            class="mt-3" checked value="1"
                                                            onchange="handleCheckboxChange()">
                                                        <label> Is Active </label>
                                                    </div>
                                                    @else
                                                    <div class="form-group col-lg-2 mt-1 mb-2 pb-0">
                                                        <input type="checkbox" name="is_active" id="is_active"
                                                            class="mt-3" value="0" onchange="handleCheckboxChange()">
                                                        <label> Is Active </label>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="form-group row col-lg-2 mb-0 pb-0 mt-2">
                                                    <input type="submit" name="update" value="Update" id="submit"
                                                        class="btn btn-sm btn-success">
                                                    <a href="{{route('organization')}}"
                                                        class="ml-2 btn btn-sm btn-danger">
                                                        Cancel</a>
                                                </div>
                                                @endforeach
                                                @else
                                                <input type="hidden" value="" name="id" id="id" />
                                                <input type="hidden" value="{{Session::get('uid')}}" name="added_by"
                                                    id="added_by" />
                                                <div class="form-group row mb-0 pb-0">
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Name <span style="color:red;">&nbsp;*</span></label>
                                                        <input required type="text" name="customer_name"
                                                            id="customer_name" value="" class="form-control"
                                                            placeholder="Enter Customer Name">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Address </label>
                                                        <input required type="text" name="customer_address"
                                                            id="customer_address" value="" class="form-control"
                                                            placeholder="Enter Address">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Logo </label>
                                                        <input type="file" name="customer_logo" id="customer_logo"
                                                            accept="image/png, image/jpg, image/jpeg"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Color Code </label>
                                                        <input type="color" name="customer_color_code"
                                                            id="customer_color_code" value="#4cb97f"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-0 pb-0 mt-1">
                                                    <div class="form-group col-lg-2 mt-1 mb-2 pb-0">
                                                        <input type="checkbox" name="is_active" id="is_active"
                                                            class="mt-3" checked value="1"
                                                            onchange="handleCheckboxChange()">
                                                        <label> Is Active </label>
                                                    </div>
                                                </div>
                                                <div class="form-group row col-lg-2 mb-0 pb-0 mt-2">
                                                    <input type="submit" name="submit" value="Submit" id="submit"
                                                        class="btn btn-sm btn-success">
                                                </div>
                                                @endif
                                            </form>
                                        </div>
                                        <div class="p-4 table-responsive">
                                            <table id="datatable" class="table table-bordered nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th> Sl. No. </th>
                                                        <th> Customer Name </th>
                                                        <th> Address </th>
                                                        <th> Logo </th>
                                                        <th> Color Code </th>
                                                        <th> Is Active </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Customers as $Customer)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $Customer->customer_name }}</td>
                                                        <td>{{ $Customer->customer_address }}</td>
                                                        <td><img src="data:image;base64,{{$Customer->customer_logo}}"
                                                            type="image" alt="logo-small" class="logo-sm"
                                                            style="height: 30px;"></td>
                                                        <td><div class="text-center" style="background-color:{{ $Customer->customer_color_code }}; width:80px;height:20px;">&nbsp;</div></td>
                                                        @if ($Customer->is_active)
                                                        <td>Active</td>
                                                        @else
                                                        <td>Inactive</td>
                                                        @endif
                                                        <td>
                                                            <a href="{{url('customer/edit/'.$Customer->id)}}"
                                                                title="Edit"><button class="btn btn-primary btn-sm"><i
                                                                        class="fa fa-pencil-square-o"
                                                                        aria-hidden="true"></i> Edit</button></a>
                                                        </td>
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
        </div>
    </div>
</div>
<!-- end page-wrapper -->
@endsection
