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
                            <h4> Users </h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            @if (Session::has("success"))
                                            <h5 class="text-center" style="color:#17a2b8">{{Session::get('success')}}
                                            </h5>
                                            @elseif(Session::has("fail"))
                                            <p class="text-center" style="color:#dc3545">{{Session::get('fail')}}
                                            </p>
                                            @endif
                                            <form id="user-form" method="POST"
                                                action="{{ route('user_update') }}">
                                                @csrf
                                                @if(isset($fieldValues))
                                                @foreach ($fieldValues as $fieldValue)
                                                <input type="hidden" value="{{$fieldValue->id}}" name="id" id="id" />
                                                <h3 class="pt-0 mt-0"> User Creation </h3>
                                                <div class="form-group row mb-0 pb-0">
                                                    @if (Session::get('user_type') == 'Super Admin')
                                                        <div class="form-group col-lg-2 mb-3 pb-0">
                                                            <label> Organization <span
                                                                    style="color:red;">&nbsp;*</span></label>
                                                            <select class="form-control" name="org_id" id="org_id">
                                                                <option disabled> Select Organization</option>
                                                                @foreach ($Organizations as $Organization)
                                                                @if ($fieldValue->org_id == $Organization->id)
                                                                <option selected value="{{ $Organization->id }}">
                                                                    {{ $Organization->org_name }}</option>
                                                                @else
                                                                <option value="{{ $Organization->id }}">
                                                                    {{ $Organization->org_name }}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @else
                                                        <input required type="hidden" name="org_id" id="org_id"
                                                            value="{{Session::get('org_id')}}" class="form-control">
                                                    @endif
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> User Name <span
                                                                style="color:red;">&nbsp;*</span></label>
                                                        <input required type="text" name="user_name" id="user_name"
                                                            value="{{$fieldValue->user_name}}" class="form-control"
                                                            placeholder="Enter User Name">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> Password <span style="color:red;">&nbsp;*</span></label>
                                                        <input required type="password" name="password" id="password"
                                                            value="{{$fieldValue->password}}" class="form-control"
                                                            placeholder="Enter Password">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> First Name <span
                                                                style="color:red;">&nbsp;*</span></label>
                                                        <input required type="text" name="first_name" id="first_name"
                                                            value="{{$fieldValue->first_name}}" class="form-control"
                                                            placeholder="Enter First Name">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> Last Name </label>
                                                        <input type="text" name="last_name" id="last_name"
                                                            value="{{$fieldValue->last_name}}" class="form-control"
                                                            placeholder="Enter Last Name">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> Email </label>
                                                        <input required type="email" name="email" id="email"
                                                            value="{{$fieldValue->email}}" class="form-control"
                                                            placeholder="Enter Email Address">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> Mobile </label>
                                                        <input type="text" name="mobile" id="mobile"
                                                            value="{{$fieldValue->mobile}}" class="form-control"
                                                            placeholder="Enter Mobile Number">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0 mt-1">
                                                        <label> User Type </label>
                                                        <select required class="form-control" name="user_type_id"
                                                            id="user_type_id">
                                                            <option disabled> Select User Type</option>
                                                            @foreach ($UserTypes as $UserType)
                                                            @if ($fieldValue->user_type_id == $UserType->id)
                                                            <option selected value="{{ $UserType->id }}">
                                                                {{ $UserType->user_type }}</option>
                                                            @else
                                                            <option value="{{ $UserType->id }}">
                                                                {{ $UserType->user_type }}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    @if ($fieldValue->is_active)
                                                    <div class="form-group col-lg-2 mt-4 mb-3 pb-0">
                                                        <input type="checkbox" name="is_active" id="is_active"
                                                            class="mt-3" checked value="1"
                                                            onchange="handleCheckboxChange()">
                                                        <label> Is Active </label>
                                                    </div>
                                                    @else
                                                    <div class="form-group col-lg-2 mt-4 mb-3 pb-0">
                                                        <input type="checkbox" name="is_active" id="is_active"
                                                            class="mt-3" value="0" onchange="handleCheckboxChange()">
                                                        <label> Is Active </label>
                                                    </div>
                                                    @endif

                                                </div>
                                                <div class="form-group row col-lg-2 mb-0 pb-0 mt-2">
                                                    <input type="submit" name="update" value="Update" id="submit"
                                                        class="btn btn-sm btn-success">
                                                    <a href="{{route('user')}}" class="ml-2 btn btn-sm btn-danger">
                                                        Cancel</a>
                                                </div>

                                                @endforeach
                                                @else
                                                <input type="hidden" value="" name="id" id="id" />
                                                <div class="form-group row mb-0 pb-0">
                                                    @if (Session::get('user_type') == 'Super Admin')
                                                        <div class="form-group col-lg-2 mb-3 pb-0">
                                                            <label> Organization <span
                                                                    style="color:red;">&nbsp;*</span></label>
                                                            <select class="form-control" name="org_id" id="org_id">
                                                                <option selected disabled> Select Organization</option>
                                                                @foreach ($Organizations as $Organization)
                                                                <option value="{{ $Organization->id }}">
                                                                    {{ $Organization->org_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @else
                                                        <input required type="hidden" name="org_id" id="org_id"
                                                            value="{{Session::get('org_id')}}" class="form-control">
                                                    @endif
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> User Name <span
                                                                style="color:red;">&nbsp;*</span></label>
                                                        <input required type="text" name="user_name" id="user_name"
                                                            value="" class="form-control" placeholder="Enter User Name">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> Password <span style="color:red;">&nbsp;*</span></label>
                                                        <input required type="password" name="password" id="password"
                                                            value="" class="form-control" placeholder="Enter Password">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> First Name <span
                                                                style="color:red;">&nbsp;*</span></label>
                                                        <input required type="text" name="first_name" id="first_name"
                                                            value="" class="form-control"
                                                            placeholder="Enter First Name">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> Last Name </label>
                                                        <input type="text" name="last_name" id="last_name" value=""
                                                            class="form-control" placeholder="Enter Last Name">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> Email </label>
                                                        <input required type="email" name="email" id="email" value=""
                                                            class="form-control" placeholder="Enter Email Address">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0">
                                                        <label> Mobile </label>
                                                        <input type="text" name="mobile" id="mobile" value=""
                                                            class="form-control" placeholder="Enter Mobile Number">
                                                    </div>
                                                    <div class="form-group col-lg-2 mb-3 pb-0 mt-1">
                                                        <label> User Type </label>
                                                        <select required class="form-control" name="user_type_id"
                                                            id="user_type_id">
                                                            <option selected disabled> Select User Type</option>
                                                            @foreach ($UserTypes as $UserType)
                                                            <option value="{{ $UserType->id }}">
                                                                {{ $UserType->user_type }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="form-group col-lg-2 mt-4 mb-3 pb-0">
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
                                                        <th> Sl.No.</th>
                                                        @if (Session::get('user_type') == 'Super Admin')
                                                            <th> Organization </th>
                                                        @endif
                                                        <th> User Type</th>
                                                        <th> User Name </th>
                                                        <th> First Name </th>
                                                        <th> Last Name </th>
                                                        <th> Email </th>
                                                        <th> Mobile </th>
                                                        <th> Is Active </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Users as $user)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        @if (Session::get('user_type') == 'Super Admin')
                                                            <td>{{ $user->org_name }}</td>
                                                        @endif
                                                        <td>{{ $user->user_type }}</td>
                                                        <td>{{ $user->user_name }}</td>
                                                        <td>{{ $user->first_name }}</td>
                                                        <td>{{ $user->last_name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->mobile }}</td>
                                                        @if ($user->is_active)
                                                            <td>Active</td>
                                                        @else
                                                            <td>Inactive</td>
                                                        @endif
                                                        <td>
                                                            <a href="{{url('user/edit/'.$user->id)}}"
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
