@extends('app.dashboard')

@section('content')
<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content pr-5 pl-5">
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card"  style="border-top:4px solid blue">
                        <div class="card-body">
                            <h4> Organizations </h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            @if (Session::has("success"))
                                            <h4 class="text-center" style="color:#17a2b8">{{Session::get('success')}}
                                            </h4>
                                            @endif
                                            <form id="organization-form" action="{{route('organization_update')}}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @if(isset($fieldValues))
                                                @foreach ($fieldValues as $fieldValue)
                                                <input type="hidden" value="{{$fieldValue->id}}" name="id" id="id" />
                                                <h3 class="pt-0 mt-0"> Organization </h3>
                                                <div class="form-group row mb-3 pb-0">
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Name <span style="color:red;">&nbsp;*</span></label>
                                                        <input required type="text" name="org_name" id="org_name"
                                                            value="{{$fieldValue->org_name}}" class="form-control"
                                                            placeholder="Enter Organization Name">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Phone Number </label>
                                                        <input type="text" name="phone_no" id="phone_no"
                                                            value="{{$fieldValue->phone_no}}" class="form-control"
                                                            placeholder="Enter Phone Number">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Email Address </label>
                                                        <input type="email" name="email_id" id="email_id"
                                                            value="{{$fieldValue->email_id}}" class="form-control"
                                                            placeholder="Enter Email Address">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Logo </label>
                                                        <input type="file" name="org_logo" id="org_logo"
                                                            accept="image/png, image/jpg, image/jpeg"
                                                            class="form-control">
                                                            <img src="data:image;base64,{{$fieldValue->org_logo}}"
                                                            type="image" alt="logo-small" class="logo-sm"
                                                            style="height: 30px;">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3 pb-0 mt-1">
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Address </label>
                                                        <textarea name="address" id="address" rows="1"
                                                            class="form-control"
                                                            placeholder="Enter Address">{{$fieldValue->address}}</textarea>
                                                    </div>
                                                    @if ($fieldValue->is_active)
                                                    <div class="form-group col-lg-2 mt-4 mb-0 pb-0">
                                                        <input type="checkbox" name="is_active" id="is_active"
                                                            class="mt-3" checked value="1"
                                                            onchange="handleCheckboxChange()">
                                                        <label> Is Active </label>
                                                    </div>
                                                    @else
                                                    <div class="form-group col-lg-2 mt-4 mb-0 pb-0">
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
                                                <div class="form-group row mb-3 pb-0">
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Name <span style="color:red;">&nbsp;*</span></label>
                                                        <input required type="text" name="org_name" id="org_name"
                                                            value="" class="form-control"
                                                            placeholder="Enter Organization Name">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Phone Number </label>
                                                        <input type="text" name="phone_no" id="phone_no" value=""
                                                            class="form-control" placeholder="Enter Phone Number">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Email Address </label>
                                                        <input type="email" name="email_id" id="email_id" value=""
                                                            class="form-control" placeholder="Enter Email Address">
                                                    </div>
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Logo </label>
                                                        <input type="file" name="org_logo" id="org_logo"
                                                            accept="image/png, image/jpg, image/jpeg"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3 pb-0 mt-1">
                                                    <div class="form-group col-lg-3 mb-0 pb-0">
                                                        <label> Address </label>
                                                        <textarea name="address" id="address" rows="1"
                                                            class="form-control" placeholder="Enter Address"></textarea>
                                                    </div>
                                                    <div class="form-group col-lg-2 mt-4 mb-0 pb-0">
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
                                                        <th> Organization Name </th>
                                                        <th> Phone Number </th>
                                                        <th> Email Address </th>
                                                        <th> Address </th>
                                                        <th> Logo </th>
                                                        <th> Is Active </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Organizations as $Organization)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $Organization->org_name }}</td>
                                                        <td>{{ $Organization->phone_no }}</td>
                                                        <td>{{ $Organization->email_id }}</td>
                                                        <td>{{ $Organization->address }}</td>
                                                        <td><img src="data:image;base64,{{$Organization->org_logo}}"
                                                            type="image" alt="logo-small" class="logo-sm"
                                                            style="height: 30px;"></td>
                                                        @if ($Organization->is_active)
                                                        <td>Active</td>
                                                        @else
                                                        <td>Inactive</td>
                                                        @endif
                                                        <td>
                                                            <a href="{{url('organization/edit/'.$Organization->id)}}"
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
