@extends('app.dashboard')

@section('content')

<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content pr-5 pl-5">
        <style>
            .nav-tabs .nav-link.active,
            .nav-tabs .nav-item.show .nav-link {
                color: #fff;
                background-color: #f68c1e !important;
                border-color: #f68c1e !important;
            }

            label {
                font-weight: 500;
            }

            .even {
                background-color: #F5F5F5 !important;
            }

            .odd {
                background-color: #fff !important;
            }

            .dataTables_filter {
                margin-left: 10px;
                float: right;
            }

            .dataTables_length {
                margin-right: 20px;
                float: left;
            }

            .dtr-title, .dtr-data {
                width: 160px;
            }

            .dtr-data {
                width: 200px;
            }

        </style>
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form id="manualform_2" action="{{route('create_single_order')}}"
                                                method="POST">
                                                @csrf
                                                @if (isset($fieldValues))
                                                @foreach ($fieldValues as $fieldValue)
                                                <input type="hidden" value="{{$fieldValue->id}}" name="id" id="id" />
                                                <h4 class="pt-0 mt-0"> Manual Orders </h4>
                                                <div class="card">
                                                    <div class="card-body" style="border-top:3px solid #7680ff">
                                                        <div class="form-group row mb-0 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label> Project <span
                                                                        style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <input type="text" disabled name="batch_name0"
                                                                    id="batch_name0" class="form-control" value="{{$fieldValue->batch_name}}">
                                                                <input type="hidden" name="batch_name"
                                                                    id="batch_name" class="form-control" value="{{$fieldValue->batch_id}}">
                                                                @error('batch_name')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label> Customer Name <span
                                                                    style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <input type="text" disabled name="customer_name0"
                                                                    id="customer_name0" class="form-control" value="{{$fieldValue->customer_name}}">
                                                                <input type="hidden" disabled name="customer_name"
                                                                    id="customer_name" class="form-control" value="{{$fieldValue->customer_name}}">
                                                                 @error('customer_name')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label> Product Type <span
                                                                        style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <input type="text" disabled name="product_type0"
                                                                    id="product_type0" class="form-control" value="{{$fieldValue->product_type}}">
                                                                <input type="hidden" disabled name="product_type"
                                                                    id="product_type" class="form-control" value="{{$fieldValue->product_type}}">
                                                                @error('product_type')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-body" style="border-top:3px solid #7680ff">
                                                        <div class="form-group row mb-0 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label>JPM Number <span
                                                                        style="color:red;">&nbsp;*</span> </label>
                                                                <input type="text" name="jpm_number" id="jpm_number"
                                                                    class="form-control"
                                                                    value="{{$fieldValue->jpm_number}}"
                                                                    placeholder="Enter Order#">
                                                                @error('jpm_number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label>Seller Number <span
                                                                        style="color:red;">*</span></label>
                                                                <input type="text" name="seller_number"
                                                                    id="seller_number" class="form-control"
                                                                    value="{{ old('seller_number', $fieldValue->seller_number) }}"
                                                                    placeholder="Enter Seller#">
                                                                @error('seller_number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mt-3 mb-3 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Property Address <span
                                                                        style="color:red;">&nbsp;*</span></label>
                                                                <textarea required name="property_address"
                                                                    id="property_address" class="form-control" rows="1"
                                                                    placeholder="Enter Property Address">{{$fieldValue->property_address}}</textarea>
                                                                @error('property_address')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label>Property Types <span
                                                                        style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <input type="text" name="property_type"
                                                                    id="property_type" class="form-control" value="{{$fieldValue->property_type}}"
                                                                    placeholder="Enter Property Type">
                                                                @error('property_type')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Property City<span
                                                                        style="color:red;">&nbsp;*</span> </label>
                                                                <input type="text" name="property_city"
                                                                    id="property_city" class="form-control"
                                                                    value="{{$fieldValue->property_city}}"
                                                                    placeholder="Enter Property City">
                                                                @error('property_city')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-0 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label>Property State <span
                                                                        style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <select class="form-control" name="property_state" id="property_state">
                                                                    <option disabled> Select State</option>
                                                                    @foreach ($states as $state)
                                                                    @if ($fieldValue->property_state == $state->id)
                                                                    <option selected value="{{ $state->id }}">
                                                                        {{ $state->short_code    }}</option>
                                                                    @else
                                                                    <option value="{{ $state->id }}">
                                                                        {{ $state->short_code	 }}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('property_state')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label>Property County <span
                                                                        style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <select class="form-control" name="property_county" id="property_county">
                                                                    @foreach ($counties as $county)
                                                                    @if ($fieldValue->property_county == $county->id)
                                                                    <option selected value="{{ $county->id }}">
                                                                        {{ $county->county_name }}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('property_county')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label> Property ZIP <span
                                                                        style="color:red;">&nbsp;*</span></label>
                                                                <input required type="text" name="property_zip"
                                                                    id="property_zip" class="form-control"
                                                                    value="{{$fieldValue->property_zip}}"
                                                                    placeholder="Enter Property ZIP">
                                                                @error('property_zip')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-body" style="border-top:3px solid #7680ff">
                                                        <div class="form-group row mt-1 mb-3 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Orign Loan Prin Bal <span
                                                                        style="color:red;">&nbsp;*</span></label>
                                                                <input type="text" name="orign_loan_print_bal"
                                                                    id="orign_loan_print_bal" class="form-control"
                                                                    value="{{$fieldValue->orign_loan_print_bal}}"
                                                                    placeholder="Enter Orign Loan Prin Bal">
                                                                @error('orign_loan_print_bal')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Orign Date <span
                                                                        style="color:red;">&nbsp;*</span> </label>
                                                                <input type="date" name="orign_date" id="orign_date"
                                                                    class="form-control"
                                                                    value="{{$fieldValue->orign_date}}"
                                                                    placeholder="Enter Orign Date">
                                                                @error('orign_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Orign Maturity Date <span
                                                                        style="color:red;">&nbsp;*</span> </label>
                                                                <input type="date" name="orign_maturity_date"
                                                                    id="orign_maturity_date" class="form-control"
                                                                    value="{{$fieldValue->orign_maturity_date}}"
                                                                    placeholder="Enter Orign Maturity Date">
                                                                @error('orign_maturity_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mt-1 mb-3 pb-0">

                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Borrower Last Name <span
                                                                        style="color:red;">&nbsp;*</span></label>
                                                                <input required type="text" name="borrower_lastname"
                                                                    id="borrower_lastname" class="form-control"
                                                                    value="{{$fieldValue->borrower_lastname}}"
                                                                    placeholder="Enter Borrower Last Namer">
                                                                @error('borrower_lastname')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Borrower First Name <span
                                                                        style="color:red;">&nbsp;*</span></label>
                                                                <input required type="text" name="borrower_firstname"
                                                                    id="borrower_firstname" class="form-control"
                                                                    value="{{$fieldValue->borrower_firstname}}"
                                                                    placeholder="Enter Borrower First Name ">
                                                                @error('borrower_firstname')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                        <div class="form-group row mt-1 mb-3 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Borrower Co Last Name </label>
                                                                <input type="text" name="co_borrower_lastname"
                                                                    id="co_borrower_lastname" class="form-control"
                                                                    value="{{$fieldValue->co_borrower_lastname}}"
                                                                    placeholder="Enter Borrower Co Last Name">
                                                                @error('co_borrower_lastname')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Borrower Co First Name </label>
                                                                <input type="text" name="co_borrower_firstname"
                                                                    id="co_borrower_firstname" class="form-control"
                                                                    value="{{$fieldValue->co_borrower_firstname}}"
                                                                    placeholder="Enter Borrower Co First Name">
                                                                @error('co_borrower_firstname')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mt-1 mb-3 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> DQ Muni Order <span
                                                                        style="color:red;">&nbsp;*</span> </label>
                                                                <input type="text" name="dq_muni_order"
                                                                    id="dq_muni_order" class="form-control"
                                                                    value="{{$fieldValue->dq_muni_order}}"
                                                                    placeholder="Enter Version">
                                                                @error('dq_muni_order')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-2 mb-0 pb-0">
                                                                @if ($fieldValue->is_active)
                                                                <label style="margin-top:2.3rem !important"> Is Active
                                                                    <input type="checkbox" name="is_active"
                                                                        id="is_rush1" checked value="1"
                                                                        style="vertical-align:middle !important;"
                                                                        onchange="handleCheckboxChange()">
                                                                </label>
                                                                @else
                                                                <label style="margin-top:2.3rem !important"> Is Active
                                                                    <input type="checkbox" name="is_active"
                                                                        id="is_rush1" value="0"
                                                                        style="vertical-align:middle !important;"
                                                                        onchange="handleCheckboxChange()">
                                                                </label>
                                                                @endif
                                                                @error('property_type')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-lg-2 mb-0 pb-0 mt-4">
                                                            <input type="submit" name="update" value="Update" id="submit"
                                                                class="btn btn-md btn-success">
                                                            <a href="{{route('single_order')}}"
                                                                class="ml-2 btn btn-md btn-danger">
                                                                Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <input type="hidden" value="" name="id" id="id" />
                                                <h4 class="pt-0 mt-0"> Manual Orders </h4>
                                                <div class="card">
                                                    <div class="card-body" style="border-top:3px solid #7680ff">
                                                        <div class="form-group row mb-3 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label> Project <span
                                                                        style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <select required class="form-control"
                                                                    name="batch_name" id="batch_name">
                                                                    <option selected disabled value=""> Select Batch </option>
                                                                    <option   value="new"> Create New Batch </option>
                                                                    @foreach ($batches as $batche)
                                                                    <option value="{{ $batche->id }}">
                                                                        {{ $batche->batch_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('batch_name')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label> Customer Name <span
                                                                    style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <select required class="form-control"
                                                                    name="customer_name" id="customer_name">
                                                                </select>
                                                                @error('customer_name')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label> Product Type <span
                                                                        style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <select required class="form-control"
                                                                    name="product_type" id="product_type">
                                                                </select>
                                                                @error('product_type')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-body" style="border-top:3px solid #7680ff">
                                                        <div class="form-group row mb-3 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label>Order # <span
                                                                        style="color:red;">&nbsp;*</span> </label>
                                                                <input onclick="myFunction()" type="text" name="jpm_number" id="jpm_number"
                                                                    class="form-control" value=""
                                                                    placeholder="Enter JPM NO">
                                                                @error('jpm_number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Seller Number <span
                                                                        style="color:red;">&nbsp;*</span></label>
                                                                </label>
                                                                <input type="text" name="seller_number"
                                                                    id="seller_number" class="form-control" value=""
                                                                    placeholder="Enter Seller No">
                                                                @error('seller_number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                         <div class="form-group row mb-3 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Property Address <span
                                                                        style="color:red;">&nbsp;*</span></label>
                                                                <textarea required name="property_address"
                                                                    id="property_address" class="form-control" rows="1"
                                                                    placeholder="Enter Property Address"></textarea>
                                                                @error('property_address')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label>Property Type <span
                                                                        style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <input type="text" name="property_type"
                                                                    id="property_type" class="form-control" value=""
                                                                    placeholder="Enter Property Type">
                                                                @error('property_type')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Property City<span
                                                                        style="color:red;">&nbsp;*</span> </label>
                                                                <input type="text" name="property_city"
                                                                    id="property_city" class="form-control" value=""
                                                                    placeholder="Enter Property City">
                                                                @error('property_city')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb- pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label>Property State <span
                                                                        style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <select required class="form-control"
                                                                    name="property_state" id="property_state">
                                                                    <option selected disabled value=""> Select State </option>
                                                                    @foreach ($states as $state)
                                                                    <option value="{{ $state->id }}">
                                                                        {{ $state->short_code }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('property_state')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label>Property County <span
                                                                        style="color:red;">&nbsp;*</span>
                                                                </label>
                                                                <select class="form-control"
                                                                    name="property_county" id="property_county">
                                                                </select>
                                                                @error('property_county')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0 mt-1">
                                                                <label> Property ZIP <span
                                                                        style="color:red;">&nbsp;*</span></label>
                                                                <input required type="text" name="property_zip"
                                                                    id="property_zip" class="form-control" value=""
                                                                    placeholder="Enter Property ZIP">
                                                                @error('property_zip')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-body" style="border-top:3px solid #7680ff">
                                                        <div class="form-group row mt-1 mb-3 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Orign Loan Prin Bal <span
                                                                        style="color:red;">&nbsp;*</span></label>
                                                                <input type="text" name="orign_loan_print_bal"
                                                                    id="orign_loan_print_bal" class="form-control"
                                                                    value="" placeholder="Enter Orign Loan Prin Bal">
                                                                @error('orign_loan_print_bal')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Orign Date <span
                                                                        style="color:red;">&nbsp;*</span> </label>
                                                                <input type="date" name="orign_date" id="orign_date"
                                                                    class="form-control" value=""
                                                                    placeholder="Enter Orign Date">
                                                                @error('orign_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Orign Maturity Date <span
                                                                        style="color:red;">&nbsp;*</span> </label>
                                                                <input type="date" name="orign_maturity_date"
                                                                    id="orign_maturity_date" class="form-control"
                                                                    value="" placeholder="Enter Orign Maturity Date">
                                                                @error('orign_maturity_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mt-1 mb-3 pb-0">

                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Borrower Last Name <span
                                                                        style="color:red;">&nbsp;*</span></label>
                                                                <input required type="text" name="borrower_lastname"
                                                                    id="borrower_lastname" class="form-control" value=""
                                                                    placeholder="Enter Borrower Last Namer">
                                                                @error('borrower_lastname')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Borrower First Name <span
                                                                        style="color:red;">&nbsp;*</span></label>
                                                                <input required type="text" name="borrower_firstname"
                                                                    id="borrower_firstname" class="form-control"
                                                                    value="" placeholder="Enter Borrower First Name ">
                                                                @error('borrower_firstname')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                        <div class="form-group row mt-1 mb-3 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Borrower Co Last Name </label>
                                                                <input type="text" name="co_borrower_lastname"
                                                                    id="co_borrower_lastname" class="form-control"
                                                                    value="" placeholder="Enter Borrower Co Last Name">
                                                                @error('co_borrower_lastname')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> Borrower Co First Name </label>
                                                                <input type="text" name="co_borrower_firstname"
                                                                    id="co_borrower_firstname" class="form-control"
                                                                    value="" placeholder="Enter Borrower Co First Name">
                                                                @error('co_borrower_firstname')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mt-1 mb-3 pb-0">
                                                            <div class="form-group col-lg-4 mb-0 pb-0">
                                                                <label> DQ Muni Order <span
                                                                        style="color:red;">&nbsp;*</span> </label>
                                                                <input type="text" name="dq_muni_order"
                                                                    id="dq_muni_order" class="form-control" value=""
                                                                    placeholder="Enter Version">
                                                                @error('dq_muni_order')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-lg-2 mb-0 pb-0">
                                                                <label style="margin-top:2.3rem !important"> Is Active
                                                                    <input type="checkbox" name="is_active"
                                                                        id="is_rush1" value="1"
                                                                        style="vertical-align:middle !important;"
                                                                        onchange="handleCheckboxChange()">
                                                                </label>
                                                                @error('property_type')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-lg-2 mb-0 pb-0 mt-4">
                                                            <input type="submit" name="Create" value="Create" id="submit"
                                                                class="btn btn-md btn-success">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </form>
                                        </div>
                                        <div class="p-4 table-responsive">
                                            <table id="myTable" class="table table-bordered nowrap"
                                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Order #</th>
                                                        <th>Seller #</th>
                                                        <th>Property Address</th>
                                                        <th>Product Type</th>
                                                        <th>County </th>
                                                        <th>Borrower Name </th>
                                                        <!-- <th>Orign Loan Prin Bal</th> -->
                                                        <!-- <th>Orign Date</th> -->
                                                        <!-- <th>Orign Maturity Date</th> -->
                                                        <!-- <th>Borrower Co Last Name</th>
                                                        <th>Borrower Co First Name</th>
                                                        <th>DQ Muni Order</th> -->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($orders as $order)
                                                    <tr style="color:#36374c" r>
                                                        <td>{{ $order->jpm_number }}</td>
                                                        <td>{{ $order->seller_number }}</td>
                                                        <td>{{ $order->property_address }}, {{ $order->property_city }}, {{ $order->short_code }},
                                                            {!! (strlen($order->property_zip) == 4) ?  "0$order->property_zip" : $order->property_zip !!}</td>
                                                        <td>{{ $order->property_type }}</td>
                                                        <td>{{ $order->county_name }}</td>
                                                        <td>{!! ucfirst($order->borrower_firstname) !!} {!! ucfirst($order->borrower_lastname) !!}</td>
                                                        <td>
                                                            <a href="{{url('single_order/edit/'.$order->id)}}"
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





<script>
    $(document).ready(function () {
        $('#myTable').DataTable( {
            responsive: true
    } );
});



</script>
<!-- state & county dropdown  -->
<script type="text/javascript">
$(document).ready(function () {



    @if (isset($fieldValues))

        var state_id = $("#property_state").val();
        var county_id = $("#property_county").val();
            $("#property_county").html('');
            $.ajax({
                url: "{{url('get_county_by_state')}}",
                type: "POST",
                data: {
                    state_id: state_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#property_county').html('<option value="">Select County</option>');
                    $.each(result.county, function (key, value) {
                        if(county_id == value.id) {
                            $("#property_county").append('<option selected value="' + value
                                .id + '">' + value.county_name + '</option>');
                        } else {
                            $("#property_county").append('<option value="' + value
                                .id + '">' + value.county_name + '</option>');
                        }
                    });
                }
            });

            $("#property_county").select2();

    @else
    $('#property_state').on('change', function () {
        $("#property_county").select2();
        var state_id = $("#property_state").val();
        $("#property_county").html('');
        $.ajax({
            url: "{{url('get_county_by_state')}}",
            type: "POST",
            data: {
                state_id: state_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                $('#property_county').html('<option value="">Select County</option>');
                $.each(result.county, function (key, value) {
                    $("#property_county").append('<option value="' + value
                        .id + '">' + value.county_name + '</option>');
                });
            }
        });
    });

    @endif

    $('#batch_name').on('change', function () {
        var selectedOption = $(this).val();
        $("#customer_name").select2();
        if(selectedOption != 'new') {
            var batch_id = $("#batch_name").val();
            $("#customer_name").html('');
            $.ajax({
                url: "{{url('get_customer_by_batch')}}",
                type: "POST",
                data: {
                    batch_id: batch_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $("#customer_name").prop("disabled", true);
                    $.each(result.customer, function (key, value) {
                        $("#customer_name").append('<option selected value="' + value
                            .id + '">' + value.customer_name + '</option>');
                    });
                }
            });
        } else {
            var date_format = getCurrentDate();
            $("#batch_name").html('');
            $("#batch_name").append('<option selected value="JPM_'+ date_format + '"> JPM_' + date_format + '</option>');
            $("#customer_name").select2();
            $("#customer_name").html('');
            $.ajax({
                url: "{{url('get_customers')}}",
                type: "POST",
                data: {
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $("#customer_name").prop("disabled", false);
                    $('#customer_name').html('<option selected disabled value="">Select Customer</option>');
                    $.each(result.customers, function (key, value) {
                        $("#customer_name").append('<option value="' + value
                            .id + '">' + value.customer_name + '</option>');
                    });
                }
            });
        }
    });

    function getCurrentDate() {
        var today = new Date();
        var month = String(today.getMonth() + 1).padStart(2, '0');
        var day = String(today.getDate()).padStart(2, '0');
        var year = today.getFullYear();
        return month + day + year;
    }

    // product type

    $('#batch_name').on('change', function () {
        var selectedOption = $(this).val();
        $("#product_type").select2();
        var date_format = getCurrentDate();
        if(selectedOption != 'JPM_' + date_format) {
            var batch_id = $("#batch_name").val();
            $("#product_type").html('');
            $.ajax({
                url: "{{url('get_producttype_by_batch')}}",
                type: "POST",
                data: {
                    batch_id: batch_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $("#product_type").prop("disabled", true);
                    $.each(result.product_types, function (key, value) {
                        $("#product_type").append('<option selected value="' + value
                            .id + '">' + value.product_type + '</option>');
                    });
                }
            });
        } else {


            $("#product_type").select2();
            $("#product_type").html('');
            $.ajax({
                url: "{{url('get_product_type')}}",
                type: "POST",
                data: {
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $("#product_type").prop("disabled", false);
                    $('#product_type').html('<option selected disabled value="">Select Product Type</option>');
                    $.each(result.product_type, function (key, value) {
                        $("#product_type").append('<option value="' + value
                            .id + '">' + value.product_type + '</option>');
                    });
                }
            });
        }
    });


    // end product type

});
</script>
<script type="text/javascript">
    $(document).ready(function() {
      $("#property_state", "#batch_name", "#product_type").select2();
    });
</script>
@endsection
