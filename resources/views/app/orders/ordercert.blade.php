@extends('app.dashboard')

@section('content')

<style>
    .pdf-link {
        cursor: pointer;
    }

    #pdf-container {
        width: 100%;
        height: 700px;

    }

    .border-line {
        border: 1px solid #ccc;
    }

    .drag-container {
        display: flex;
        flex-direction: row;
        height: 300px;
        /* Set an initial height for the container */
        overflow: hidden;
    }

    .tooltip-inner {
        color: #fff;
        background: #44b3af;
    }

    .tooltip.top .tooltip-arrow {
        border-top-color: #44b3af;
    }

    .tooltip.right .tooltip-arrow {
        border-right-color: #44b3af;
    }

    .tooltip.bottom .tooltip-arrow {
        border-bottom-color: #44b3af;
    }

    .tooltip.left .tooltip-arrow {
        border-left-color: #44b3af;
    }

    label {
        display: inline-block;
        margin-bottom: 0.2rem;
        margin-top: 5px;
        font-size: 11px !important;
        font-weight: 500;
    }

    input.form-control {
        height: 25px !important;
        font-size: 11px !important;
    }

    .custom-accordion {
        background-color: #f1f5fa !important;
    }

    .bg-success {
        background-color: #41B680 !important;
    }

    .card {
        margin-bottom: 5px;
        background-color: #fff;
        border-radius: .25rem;
        border: 1px solid #eceff5;
    }

    .card-header {
        padding: 0.1rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, 0.03);
        border-bottom: 0 solid rgba(0, 0, 0, 0.125);
    }

    .main-card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, 0.03);
        border-bottom: 0 solid rgba(0, 0, 0, 0.125);
    }

    .card-body {
        -webkit-box-flex: 1 !important;
        -ms-flex: 1 1 auto !important;
        flex: 1 1 auto !important;
        min-height: 1px !important;
        padding: 0.75rem 0.75rem 0.75rem 0.75rem !important;
    }

    .flash {
        animation-name: flash;
        animation-duration: .5s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
        animation-direction: alternate;
        animation-play-state: running;
    }

    .flex {
        display: flex;
        flex-direction: row;
    }

    .btn-secondary {
        width: 100px !important;
        height: 35px !important;
        font-size: 10px !important;
        font-weight: bold;
    }

    .btn-outline-secondary {
        width: 100px !important;
        height: 35px !important;
        font-size: 10px !important;
        font-weight: bold;
    }

    @keyframes flash {
        from {
            color: white;
        }

        to {
            color: green;
        }
    }

    .other_status tbody tr td{
        font-size: 9px !important;
    }

    .other_status tbody .status_comments td{
        font-size: 11px !important;
    }


    table tr td {
        font-size: 11px !important;
        padding: 3px !important;

    }

    table tr th {
        font-size: 11px !important;
        padding: 3px !important;
        font-weight: bolder;
    }

    .f16 {
        font-size: 12px;
    }

    .appendbtn {
        height: 16px !important;
        width: 16px !important;
        border-radius: 50% !important;
        line-height: 1.25 !important;
    }

    .removebtn {
        height: 16px !important;
        width: 16px !important;
        border-radius: 50% !important;
        line-height: 1.25 !important;
    }


    .editbtn {
        height: 16px !important;
        width: 16px !important;
        border-radius: 50% !important;
        line-height: 1.25 !important;
    }

    .sortable {
        list-style-type: none !important;
        margin: 0;
        padding: 0;
        width: 100%;
        list-style: none !important;
    }

    .p-1 {
        padding: 0.25rem !important;
    }

    .card .card-header {
        background-color: #f1f5fa !important;
        ;
    }

    .card .card-header {
        background-color: #f1f5fa !important;
        ;
    }

    .card-header:first-child {
        border-radius: calc(.25rem - 0) calc(.25rem - 0) 0 0 !important;
        ;
    }

    .card-header {
        padding: 0.1rem !important;
        margin-bottom: 0 !important;
        ;
        background-color: rgba(0, 0, 0, 0.03) !important;
        border-bottom: 0 solid rgba(0, 0, 0, 0.125) !important;
    }

    .gutter-horizontal {
        cursor: col-resize;
    }

    .order_table_row {
        margin-top: 10px;
    }

    input::placeholder {
        font-size: 9px !important;
    }
    textarea::placeholder {
        font-size: 9px !important;
    }

</style>
<style>
    #container {
        width: 500px;
        margin: 20px auto;
    }

    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }

    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>
<div class="page-wrapper">
    {{-- show history modal --}}
    <div id="supdoc">
        <div class="modal fade" id="historymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" style="height:650px;">
                    <div class="modal-header">
                        <h4 class="modal-title" style="font-weight: 500;">Order History</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body" style="height:650px;overflow:auto">
                        <h4 class="text-center"> History</h4>
                        <table class="table table-bordered" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Status</th>
                                    <th>User</th>
                                    <th>Comments</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody id="assess_history" class="text-center">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end show history modal --}}
    <!-- Page Content-->
    <div class="page-content pr-5 pl-5">
        <div class="container-fluid mt-2">
            <div class="card" style="border-top: 4px solid blue">
                @if(in_array($orderData[0]->status_id, [4, 5, 6, 10, 12, 13]))
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <span style="white-space:nowrap">
                                <div class="font16" ><strong>Status: <span class="flash">{{$orderData[0]->status_type}}</span></strong></div>
                            </span>
                        </div>
                        <div class="col-lg-10">
                            <div class="font16" style="display: inline-flex;"><strong> Reason: </strong>&nbsp;<span onclick="showclr({!!  $statusHistory[count($statusHistory) - 1]->id !!})" class="elipclass font16" style="cursor:pointer;color:blue"> <u>{!!  $statusHistory[count($statusHistory) - 1]->comments !!}</u></span></div>
                        </div>
                    </div>
                </div>
                @endif
           </div>
            <div class="row no-gutters">
                <section class="flex col-lg-12">
                    <div class="col" id="docdisplaydiv" style="border:1px solid #ccc;display:block">
                        <div id="pdfs">
                            <table width="100%" id="ordersummary"
                                class="table table-striped table-centered table-bordered mb-0">
                                @foreach ($supportingdocs as $index => $linked_pdf)
                                @if(!str_starts_with($linked_pdf->pdf_file, "Certificate") && !str_starts_with($linked_pdf->pdf_file, "Merged"))
                                @if ($index % 4 === 0)
                                @if ($index > 0)
                                </tr>
                                @endif
                                <tr>
                                    @endif
                                    <td id="removesupportingfile{{$linked_pdf->id}}" width="25%"
                                        style="padding:5px 5px!important;cursor:pointer;border:none;white-space:nowrap"
                                        onclick="openSupportingDoc({{$linked_pdf->id}}, 'newWindow');">
                                        <i class="far fa-file-pdf" style="color:red"></i> <span
                                            id="setfilenamebold{{$linked_pdf->id}}">{{$linked_pdf->pdf_file}}</span>
                                    </td>
                                    @endif
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                        <div id="pdf-container" class="pt-2">
                            <iframe src="{{url("ordercertpdf/".$orderData[0]->order_id)}}" type="application/pdf"
                                width="100%" height="100%"></iframe>
                        </div>
                    </div>
                    <div class="col" id="detailsdisplaydiv">
                        <div class="card">
                            <div class="card-body" style="border-top: 4px solid #eb6d07">
                                <table style="width:75%">
                                    <tbody>
                                        <tr>
                                            <td><button style="width:100px" id="sectiontab_1"
                                                    class="btn btn-sm btn-success"
                                                    onclick="toggle_basic_info()"><strong> Basic </strong></button></td>
                                            <td><button style="width:100px" id="sectiontab_3"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    onclick="toggle_note_info()"><strong>Notes</strong></button></td>
                                            <td><button style="width:120px" id="sectiontab_4"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    onclick="toggle_docs_info()"><strong>Clarification/Docs</strong></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- Status indicater --}}
                        <div class="p-0 pb-0 mt-0 mb-2">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td width="35%" align="left"><a
                                                onclick="showhistory({{$orderData[0]->order_id}});"><i
                                                    style="font-size:12px" class="dripicons-preview"></i></a> <b
                                                class="flash">Product Type:
                                                {{$orderData[0]->product_type}}</b>
                                        </td>
                                        <td width="20%" style="font-size:12px;font-weight:600" align="right"><span
                                                id="current_order_status">Status: {{$orderData[0]->status_type}}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{--  --}}
                        <div class="card" id="sectiondiv_1">
                            <div class="card-body" style="border-top:4px solid #22b783">
                                <div id="accordion1">
                                    {{--
                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                             data-parent="#accordion1">
                             --}}
                                    <input type="hidden" name="info_id" id="infoid" value="450">
                                    <div class="row" id="editorderinfo">
                                        <div class="col-lg-11">
                                            <table id="order_infotable" width="100%">
                                                <tr class="order_table_row">
                                                    <th width="25%">App #:</th>
                                                    <td width="25%">{{$orderData[0]->app_number}}</td>
                                                    <th width="25%">Property Address:</th>
                                                    <td width="25%">{{$orderData[0]->address}}</td>
                                                </tr>
                                                <tr class="order_table_row">
                                                    <th width="25%">MC Order ID:</th>
                                                    <td width="25%"></td>
                                                    <th width="25%"># of Parcel(s):</th>
                                                    <td width="25%"><span
                                                        class="editable-field-parcel"
                                                        id="parcel_count"
                                                        name="parcel_count">{{$orderData[0]->parcel_count}}</span></td>
                                                </tr>
                                                <tr class="order_table_row">
                                                    <th width="25%">Loan Ref #1:</th>
                                                    <td width="25%">{{$orderData[0]->batch_name}}</td>
                                                    {{-- <th width="25%">Parcel List:</th>
                                                    <td width="25%"><span
                                                        class="editable-field-parcel"
                                                        id="parcel_list"
                                                        name="parcel_list">{{$orderData[0]->parcel_list}}</span>
                                                    </td> --}}
                                                    <th width="25%">State:</th>
                                                    <td width="25%">{{$orderData[0]->state}}</td>
                                                </tr>
                                                <tr class="order_table_row">
                                                    <th width="25%">Loan Ref #2:</th>
                                                    <td width="25%"></td>
                                                    <th width="25%">County:</th>
                                                    <td width="25%">{{$orderData[0]->county}}</td>
                                                </tr>
                                                <tr class="order_table_row">
                                                    <th width="25%">Applicants:</th>
                                                    <td width="25%">{{$orderData[0]->applicants}}</td>
                                                </tr>
                                                <tr class="order_table_row">
                                                    <th width="25%">Completion Date:</th>
                                                    @if(isset($orderData[0]->completion_date))
                                                    <td width="25%">{!! date("m/d/Y", strtotime($orderData[0]->completion_date)) !!}</td>
                                                    @else
                                                    <td width="25%"></td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </div>
                                        {{-- <div class="col-lg-1">
                                            <button type="button" id="parcelEditbtn"
                                                class="btn btn-sm editbtn  btn-info pr-1 pl-1 pt-0 pb-0"
                                                onclick="editOrderInfo('parcel')"><i
                                                    class="dripicons-pencil"
                                                    style="font-size:6px"></i></button>
                                            <button type="button" style="display: none;"
                                                id="cancelparcelContainer"
                                                class="btn btn-sm editbtn parcelEditbtn btn-info pr-1 pl-1 pt-0 pb-0"
                                                onclick="cancelOrder('parcel')"><i
                                                    class="dripicons-chevron-right"
                                                    style="font-size:6px"></i></button>
                                        </div> --}}
                                    </div>
                                    <div id="submitparcelContainer" class='row' style="display: none;">
                                        <button class="btn btn-xs btn-success mt-2 mx-2" type="submit"
                                            name="order_update" id="order_update1" value="1"
                                            onclick="submit('parcel')">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Parcel Info Div --}}

                        <div class="card">
                            <div class="card-body" style="border-top:4px solid #a83281">
                                {{-- Parcel Input --}}
                                <div id="parcel_info" class="parcelbody">
                                    <div class="card mb-0">
                                        <div class="card-header custom-accordion" id="utilitie_water">
                                            <div class="p-1 pointer" data-toggle="collapse"
                                                data-target="#Parcel_utilities_1" aria-expanded="true"
                                                aria-controls="Parcel_utilities_1">
                                                <b> Parcel Information </b>
                                                <img src="" alt="" class="float-right" height="15px"
                                                    id="parcel_statusImage" class="editable-field-parcel">
                                            </div>
                                        </div>
                                        <div id="Parcel_utilities_1" class="collapse show" aria-labelledby="heading_1"
                                            data-parent="#parcel_info" style="">
                                            <div class="card-body">
                                                <form id="parcel_form" action="" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="action" value="update">
                                                    <input type="hidden" id="orderid" name="orderid" value="{{$orderData[0]->order_id}}" />
                                                    <input type="hidden" name="temp1" value="{!! $tempid = 0 !!}" />
                                                    <div id="parceledit">
                                                        @forelse ($parcels as $parcel)
                                                            @if($tempid == 0)
                                                            <h6 style="margin-left:3px;">Parcel - {{ $parcel->parcel_number }}<span class="float-right"><button type="button"
                                                                        onclick="edit_parcelinfo({{ $parcel->order_id }},4);"
                                                                        class="btn btn-sm btn-info pr-1 pl-1 pt-0 pb-0 editbtn"><i class="dripicons-pencil"
                                                                            style="font-size:6px"></i></button></span></h6>
                                                            <input type="hidden" name="temp2" value="{!! $tempid = 1 !!}" />
                                                            @else
                                                            <h6 style="margin-left:3px;">Parcel - {{ $parcel->parcel_number }}</h6>
                                                            @endif
                                                            <div class="row mb-0 pb-0 addpropertyLegalDesc" id="addedprolegaldesc_1">
                                                                <div class="col-lg-10">
                                                                    <input type="hidden" id="parcel_order_id" name="parcel_order_id[]" value="{{$parcel->id}}" />
                                                                    <table id="parcel_infotable" width="100%">
                                                                        <tr>
                                                                            <th width="25%">Legal Description:</th>
                                                                            <td width="50%">{{ $parcel->legal_description }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <button type="button" id="addnewpropertyLegalDesc_1"
                                                                        class="btn btn-success btn-sm appendbtn text-white pb-0 pt-0 pr-1 pl-1 addnewpropertyLegalDesc"
                                                                        onclick="addpropLegalDesc(1)">+</button>
                                                                    <button type="button" id="removeprop_1"
                                                                        class="btn btn-danger btn-sm text-white removebtn pb-0 pt-0 pr-1 pl-1 removeprop"
                                                                        onclick="removeajaxparcelinfo(1,{{$parcel->id}})">-</button>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <div class="row mb-0 pb-0 addpropertyLegalDesc" id="addedprolegaldesc_1">
                                                                <div class="col-lg-10">
                                                                    <input type="hidden" id="parcel_order_id" name="parcel_order_id[]" value="" />
                                                                    <table id="parcel_infotable" width="100%">
                                                                        <tr>
                                                                            <th width="25%">Parcel Number:</th>
                                                                            <td width="25%"><input type="text" name="propertyLegalIdentifier[]"
                                                                                    id="propertyLegalIdentifier_1" class="form-control addpropertyLegalDesc parcelno"
                                                                                    placeholder="Parcel No" required></td>
                                                                            <th width="25%">Legal Description:</th>
                                                                            <td width="25%"><textarea name="legalDesc[]" id="legalDesc_1" rows="1"
                                                                                    class="form-control addpropertyLegalDesc" placeholder="Legal Description"></textarea>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <button type="button" id="addnewpropertyLegalDesc_1"
                                                                        class="btn btn-success btn-sm appendbtn text-white pb-0 pt-0 pr-1 pl-1 addnewpropertyLegalDesc"
                                                                        onclick="addpropLegalDesc(1)">+</button>
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12" id="new_legalDesc"></div>
                                                    </div>
                                                
                                                    @forelse ($parcels as $parcel)
                                                    @if ($loop->iteration == 1)
                                                    <div class="row" id="psubmitbutton1" style="display:none">
                                                        <div class="col-lg-12">
                                                            <button class="btn btn-xs btn-success p-1 ml-2 mb-2" type="submit" id="parcel_submit1" name="parcel_submit"
                                                                value="1">Submit</button>
                                                            <a href="{{url('ordercert/'.$orderData[0]->order_id)}}" class="btn btn-xs btn-danger p-1 ml-2 mb-2" id="cancel">Cancel</a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @empty
                                                    <div class="row" id="psubmitbutton1" style="display:block">
                                                        <div class="col-lg-12">
                                                            <button class="btn btn-xs btn-success p-1 ml-2 mb-2" type="submit" id="parcel_submit1" name="parcel_submit"
                                                                value="1">Submit</button>
                                                            <a href="{{url('ordercert/'.$orderData[0]->order_id)}}" class="btn btn-xs btn-danger p-1 ml-2 mb-2" id="cancel">Cancel</a>
                                                        </div>
                                                    </div>
                                                    @endforelse
                                                </form>
                                           </div>
                                        </div>
                                    </div>
                                    <hr class="pt-1 m-0" style="border-top:3px solid #3e3952">
                                </div>

                                @foreach($orderData as $data)
                                <div id="parcel_{{$data->parcel_id}}_info" class="parcelbody parcel_info">
                                    <div class="card mb-0">
                                        <div class="card-header custom-accordion" id="utilitie_parcel_{{$data->id}}">
                                            <div class="p-1 pointer" data-toggle="collapse"
                                                data-target="#Parcel_{{$data->parcel_id}}_utilities_1" aria-expanded="true"
                                                aria-controls="Parcel_{{$data->parcel_id}}_utilities_1">
                                                <b> Parcel# {{$data->parcel_number}}</b>
                                            </div>
                                        </div>

                                        <div id="Parcel_{{$data->parcel_id}}_utilities_1" class="collapse show" aria-labelledby="heading_1"
                                            data-parent="#parcel_{{$data->parcel_id}}_info" style="">
                                            {{-- water info --}}
                                            <div id="water_{{$data->parcel_id}}_info" class="parcelbody">
                                                <div class="card mb-0 mx-2 mt-2">
                                                    <div class="card-header custom-accordion" id="utilities_water_{{$data->parcel_id}}">
                                                        <div class="p-1 pointer" data-toggle="collapse"
                                                            data-target="#water_{{$data->parcel_id}}_utilities_1" aria-expanded="true"
                                                            aria-controls="water_{{$data->parcel_id}}_utilities_1">
                                                            <b>Water Information </b> <img src="" alt="" class="float-right"
                                                                height="15px" id="water_{{$data->parcel_id}}_statusImage" class="editable-field-water_{{$data->parcel_id}}">
                                                        </div>
                                                    </div>
                                                    <div id="water_{{$data->parcel_id}}_utilities_1" class="collapse show" aria-labelledby="heading_1"
                                                        data-parent="#water_{{$data->parcel_id}}_info">
                                                        <div class="card-body">
                                                            <div id="Utilitiesedit2">
                                                                <div class="row water_{{$data->parcel_id}}_utilities" id="water_{{$data->parcel_id}}_utilities">
                                                                    <div class="col-lg-11">
                                                                        <table id="water_{{$data->parcel_id}}_utilities_infotable" width="100%">
                                                                            <table id="water_infotable" width="100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th width="25%">Water Status:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-water_{{$data->parcel_id}}"
                                                                                                id="water_status"
                                                                                                name="water_status">{{$data->water_status}}</span>
                                                                                        </td>
                                                                                        <th width="25%">Water Due Date:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-water_{{$data->parcel_id}}"
                                                                                                id="water_due_date"
                                                                                                name="water_due_date">{{$data->water_due_date}}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th width="25%">Water Past Due:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-water_{{$data->parcel_id}}"
                                                                                                id="water_past_due"
                                                                                                name="water_past_due">${{$data->water_past_due}}</span>
                                                                                        </td>
                                                                                        <th width="25%">Water Amt Due:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-water_{{$data->parcel_id}}"
                                                                                                id="water_amt_due"
                                                                                                name="water_amt_due">${{$data->water_amt_due}}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table class="w-100">
                                                                                <tr
                                                                                    style="vertical-align:top;">
                                                                                    <th width="25%">Water Summary:</th>
                                                                                    <td width="75%">
                                                                                        <span class="editable-field-water_{{$data->parcel_id}}"
                                                                                            id="water_{{$data->parcel_id}}SummarySpan"
                                                                                            name="water_summary">{!! nl2br($data->water_summary)!!}</span>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-lg-1">
                                                                        <button type="button" id="water_{{$data->parcel_id}}Editbtn"
                                                                            class="btn btn-sm editbtn  btn-info pr-1 pl-1 pt-0 pb-0"
                                                                            onclick="editOrderInfo('water_{{$data->parcel_id}}')"><i
                                                                                class="dripicons-pencil"
                                                                                style="font-size:6px"></i></button>
                                                                        <button type="button" style="display: none;"
                                                                            id="cancelwater_{{$data->parcel_id}}Container"
                                                                            class="btn btn-sm editbtn water_{{$data->parcel_id}}Editbtn btn-info pr-1 pl-1 pt-0 pb-0"
                                                                            onclick="cancelOrder('water_{{$data->parcel_id}}')"><i
                                                                                class="dripicons-chevron-right"
                                                                                style="font-size:6px"></i></button>
                                                                    </div>
                                                                </div>
                                                                <div id="submitwater_{{$data->parcel_id}}Container" style="display: none;">
                                                                    <button class="btn btn-xs btn-success mt-2 mx-2" type="submit"
                                                                        name="order_update" id="order_update1" value="1"
                                                                        onclick="submit('water_{{$data->parcel_id}}')">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="pt-1 m-0 mx-2" style="border-top:3px solid #3e3952">
                                            </div>
                                            {{-- Sewer Info --}}
                                            <div id="sewer_{{$data->parcel_id}}_info" class="parcelbody">
                                                <div class="card mb-0 mx-2 mt-2">
                                                    <div class="card-header custom-accordion" id="utilities_sewer_{{$data->parcel_id}}">
                                                        <div class="p-1 pointer" data-toggle="collapse"
                                                            data-target="#sewer_{{$data->parcel_id}}_utilities_1" aria-expanded="true"
                                                            aria-controls="sewer_{{$data->parcel_id}}_utilities_1">
                                                            <b>Sewer Information </b> <img src="" alt="" class="float-right"
                                                                height="15px" id="sewer_{{$data->parcel_id}}_statusImage" class="editable-field-sewer_{{$data->parcel_id}}">
                                                        </div>
                                                    </div>
                                                    <div id="sewer_{{$data->parcel_id}}_utilities_1" class="collapse show" aria-labelledby="heading_1"
                                                        data-parent="#sewer_{{$data->parcel_id}}_info">
                                                        <div class="card-body">
                                                            <div id="Utilitiesedit2">
                                                                <div class="row sewer_{{$data->parcel_id}}_utilities" id="sewer_{{$data->parcel_id}}_utilities">
                                                                    <div class="col-lg-11">
                                                                        <table id="sewer_{{$data->parcel_id}}_utilities_infotable" width="100%">
                                                                            <table id="sewer_infotable" width="100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th width="25%">Sewer Status:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-sewer_{{$data->parcel_id}}"
                                                                                                id="sewer_status"
                                                                                                name="sewer_status">{{$data->sewer_status}}</span>
                                                                                        </td>
                                                                                        <th width="25%">Sewer Due Date:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-sewer_{{$data->parcel_id}}"
                                                                                                id="sewer_due_date"
                                                                                                name="sewer_due_date">{{$data->sewer_due_date}}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th width="25%">Sewer Past Due:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-sewer_{{$data->parcel_id}}"
                                                                                                id="sewer_past_due"
                                                                                                name="sewer_past_due">${{$data->sewer_past_due}}</span>
                                                                                        </td>
                                                                                        <th width="25%">Sewer Amt Due:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-sewer_{{$data->parcel_id}}"
                                                                                                id="sewer_amt_due"
                                                                                                name="sewer_amt_due">${{$data->sewer_amt_due}}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table class="w-100">
                                                                                <tr
                                                                                    style="vertical-align:top;">
                                                                                    <th width="25%">Sewer Summary:</th>
                                                                                    <td width="75%">
                                                                                        <span class="editable-field-sewer_{{$data->parcel_id}}"
                                                                                            id="sewer_{{$data->parcel_id}}SummarySpan"
                                                                                            name="sewer_summary">{!! nl2br($data->sewer_summary)!!}</span>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-lg-1">
                                                                        <button type="button" id="sewer_{{$data->parcel_id}}Editbtn"
                                                                            class="btn btn-sm editbtn  btn-info pr-1 pl-1 pt-0 pb-0"
                                                                            onclick="editOrderInfo('sewer_{{$data->parcel_id}}')"><i
                                                                                class="dripicons-pencil"
                                                                                style="font-size:6px"></i></button>
                                                                        <button type="button" style="display: none;"
                                                                            id="cancelsewer_{{$data->parcel_id}}Container"
                                                                            class="btn btn-sm editbtn sewer_{{$data->parcel_id}}Editbtn btn-info pr-1 pl-1 pt-0 pb-0"
                                                                            onclick="cancelOrder('sewer_{{$data->parcel_id}}')"><i
                                                                                class="dripicons-chevron-right"
                                                                                style="font-size:6px"></i></button>
                                                                    </div>
                                                                </div>
                                                                <div id="submitsewer_{{$data->parcel_id}}Container" style="display: none;">
                                                                    <button class="btn btn-xs btn-success mt-2 mx-2" type="submit"
                                                                        name="order_update" id="order_update1" value="1"
                                                                        onclick="submit('sewer_{{$data->parcel_id}}')">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="pt-1 m-0 mx-2" style="border-top:3px solid #3e3952">
                                            </div>
                                            {{-- Garbage Info --}}
                                            <div id="garbage_{{$data->parcel_id}}_info" class="parcelbody">
                                                <div class="card mb-0 mx-2 mt-2">
                                                    <div class="card-header custom-accordion" id="utilities_garbage_{{$data->parcel_id}}">
                                                        <div class="p-1 pointer" data-toggle="collapse"
                                                            data-target="#garbage_{{$data->parcel_id}}_utilities_1" aria-expanded="true"
                                                            aria-controls="garbage_{{$data->parcel_id}}_utilities_1">
                                                            <b>Garbage Information </b> <img src="" alt="" class="float-right"
                                                                height="15px" id="garbage_{{$data->parcel_id}}_statusImage" class="editable-field-garbage_{{$data->parcel_id}}">
                                                        </div>
                                                    </div>
                                                    <div id="garbage_{{$data->parcel_id}}_utilities_1" class="collapse show" aria-labelledby="heading_1"
                                                        data-parent="#garbage_{{$data->parcel_id}}_info">
                                                        <div class="card-body">
                                                            <div id="Utilitiesedit2">
                                                                <div class="row garbage_{{$data->parcel_id}}_utilities" id="garbage_{{$data->parcel_id}}_utilities">
                                                                    <div class="col-lg-11">
                                                                        <table id="garbage_{{$data->parcel_id}}_utilities_infotable" width="100%">
                                                                            <table id="garbage_infotable" width="100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th width="25%">Garbage Status:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-garbage_{{$data->parcel_id}}"
                                                                                                id="garbage_status"
                                                                                                name="garbage_status">{{$data->garbage_status}}</span>
                                                                                        </td>
                                                                                        <th width="25%">Garbage Due Date:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-garbage_{{$data->parcel_id}}"
                                                                                                id="garbage_due_date"
                                                                                                name="garbage_due_date">{{$data->garbage_due_date}}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th width="25%">Garbage Past Due:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-garbage_{{$data->parcel_id}}"
                                                                                                id="garbage_past_due_{{$data->parcel_id}}"
                                                                                                name="garbage_past_due">${{$data->garbage_past_due}}</span>
                                                                                        </td>
                                                                                        <th width="25%">Garbage Amt Due:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-garbage_{{$data->parcel_id}}"
                                                                                                id="garbage_amt_due"
                                                                                                name="garbage_amt_due">${{$data->garbage_amt_due}}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table class="w-100">
                                                                                <tr
                                                                                    style="vertical-align:top;">
                                                                                    <th width="25%">Garbage Summary:</th>
                                                                                    <td width="75%">
                                                                                        <span class="editable-field-garbage_{{$data->parcel_id}}"
                                                                                            id="garbage_{{$data->parcel_id}}SummarySpan"
                                                                                            name="garbage_summary">{!! nl2br($data->garbage_summary)!!}</span>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-lg-1">
                                                                        <button type="button" id="garbage_{{$data->parcel_id}}Editbtn"
                                                                            class="btn btn-sm editbtn  btn-info pr-1 pl-1 pt-0 pb-0"
                                                                            onclick="editOrderInfo('garbage_{{$data->parcel_id}}')"><i
                                                                                class="dripicons-pencil"
                                                                                style="font-size:6px"></i></button>
                                                                        <button type="button" style="display: none;"
                                                                            id="cancelgarbage_{{$data->parcel_id}}Container"
                                                                            class="btn btn-sm editbtn garbage_{{$data->parcel_id}}Editbtn btn-info pr-1 pl-1 pt-0 pb-0"
                                                                            onclick="cancelOrder('garbage_{{$data->parcel_id}}')"><i
                                                                                class="dripicons-chevron-right"
                                                                                style="font-size:6px"></i></button>
                                                                    </div>
                                                                </div>
                                                                <div id="submitgarbage_{{$data->parcel_id}}Container" style="display: none;">
                                                                    <button class="btn btn-xs btn-success mt-2 mx-2" type="submit"
                                                                        name="order_update" id="order_update1" value="1"
                                                                        onclick="submit('garbage_{{$data->parcel_id}}')">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="pt-1 m-0 mx-2" style="border-top:3px solid #3e3952">
                                            </div>
                                            {{-- Utility Info --}}
                                            <div id="utility_{{$data->parcel_id}}_info" class="parcelbody">
                                                <div class="card mb-0 mx-2 mt-2">
                                                    <div class="card-header custom-accordion" id="utilities_utility_{{$data->parcel_id}}">
                                                        <div class="p-1 pointer" data-toggle="collapse"
                                                            data-target="#utility_{{$data->parcel_id}}_utilities_1" aria-expanded="true"
                                                            aria-controls="utility_{{$data->parcel_id}}_utilities_1">
                                                            <b>Utility Information </b> <img src="" alt="" class="float-right"
                                                                height="15px" id="utility_{{$data->parcel_id}}_statusImage" class="editable-field-utility_{{$data->parcel_id}}">
                                                        </div>
                                                    </div>
                                                    <div id="utility_{{$data->parcel_id}}_utilities_1" class="collapse show" aria-labelledby="heading_1"
                                                        data-parent="#utility_{{$data->parcel_id}}_info">
                                                        <div class="card-body">
                                                            <div id="Utilitiesedit2">
                                                                <div class="row utility_{{$data->parcel_id}}_utilities" id="utility_{{$data->parcel_id}}_utilities">
                                                                    <div class="col-lg-11">
                                                                        <table id="utility_{{$data->parcel_id}}_utilities_infotable" width="100%">
                                                                            <table id="utility_infotable" width="100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th width="25%">Utility Status:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-utility_{{$data->parcel_id}}"
                                                                                                id="utility_status"
                                                                                                name="utility_status">{{$data->utility_status}}</span>
                                                                                        </td>
                                                                                        <th width="25%">Utility Due Date:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-utility_{{$data->parcel_id}}"
                                                                                                id="utility_due_date"
                                                                                                name="utility_due_date">{{$data->utility_due_date}}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th width="25%">Utility Past Due:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-utility_{{$data->parcel_id}}"
                                                                                                id="utility_past_due"
                                                                                                name="utility_past_due">${{$data->utility_past_due}}</span>
                                                                                        </td>
                                                                                        <th width="25%">Utility Amt Due:</th>
                                                                                        <td width="25%"><span
                                                                                                class="editable-field-utility_{{$data->parcel_id}}"
                                                                                                id="utility_amt_due"
                                                                                                name="utility_amt_due">${{$data->utility_amt_due}}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table class="w-100">
                                                                                <tr
                                                                                    style="vertical-align:top;">
                                                                                    <th width="25%">Utility Summary:</th>
                                                                                    <td width="75%">
                                                                                        <span class="editable-field-utility_{{$data->parcel_id}}"
                                                                                            id="utility_{{$data->parcel_id}}SummarySpan"
                                                                                            name="other_utility_summary">{!! nl2br($data->other_utility_summary)!!}</span>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-lg-1">
                                                                        <button type="button" id="utility_{{$data->parcel_id}}Editbtn"
                                                                            class="btn btn-sm editbtn  btn-info pr-1 pl-1 pt-0 pb-0"
                                                                            onclick="editOrderInfo('utility_{{$data->parcel_id}}')"><i
                                                                                class="dripicons-pencil"
                                                                                style="font-size:6px"></i></button>
                                                                        <button type="button" style="display: none;"
                                                                            id="cancelutility_{{$data->parcel_id}}Container"
                                                                            class="btn btn-sm editbtn utility_{{$data->parcel_id}}Editbtn btn-info pr-1 pl-1 pt-0 pb-0"
                                                                            onclick="cancelOrder('utility_{{$data->parcel_id}}')"><i
                                                                                class="dripicons-chevron-right"
                                                                                style="font-size:6px"></i></button>
                                                                    </div>
                                                                </div>
                                                                <div id="submitutility_{{$data->parcel_id}}Container" style="display: none;">
                                                                    <button class="btn btn-xs btn-success mt-2 mx-2" type="submit"
                                                                        name="order_update" id="order_update1" value="1"
                                                                        onclick="submit('utility_{{$data->parcel_id}}')">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="pt-1 m-0 mx-2" style="border-top:3px solid #3e3952">
                                            </div>
                                            {{-- other Info --}}
                                            <div id="other_{{$data->parcel_id}}_info" class="parcelbody">
                                                <div class="card mb-2 mx-2 mt-2">
                                                    <div class="card-header custom-accordion" id="utilities_other_{{$data->parcel_id}}">
                                                        <div class="p-1 pointer" data-toggle="collapse"
                                                            data-target="#other_{{$data->parcel_id}}_utilities_1" aria-expanded="true"
                                                            aria-controls="other_{{$data->parcel_id}}_utilities_1">
                                                            <b>Other Information </b> <img src="" alt="" class="float-right"
                                                                height="15px" id="other_{{$data->parcel_id}}_statusImage" class="editable-field-other_{{$data->parcel_id}}">
                                                        </div>
                                                    </div>
                                                    <div id="other_{{$data->parcel_id}}_utilities_1" class="collapse show" aria-labelledby="heading_1"
                                                        data-parent="#other_{{$data->parcel_id}}_info">
                                                        <div class="card-body">
                                                            <div id="Utilitiesedit2">
                                                                <div class="row other_{{$data->parcel_id}}_utilities" id="other_{{$data->parcel_id}}_utilities">
                                                                    <div class="col-lg-11">
                                                                        <table id="other_{{$data->parcel_id}}_utilities_infotable" width="100%">
                                                                            <table id="other_infotable" width="100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th width="22%">Code Amt Due:</th>
                                                                                        <td width="15%"><span
                                                                                                class="editable-field-other_{{$data->parcel_id}}"
                                                                                                id="code_amt_due"
                                                                                                name="code_amt_due">${{$data->code_amt_due}}</span>
                                                                                        </td>
                                                                                        <th width="22%">Special Amt Due:</th>
                                                                                        <td width="15%"><span
                                                                                                class="editable-field-other_{{$data->parcel_id}}"
                                                                                                id="special_amt_due"
                                                                                                name="special_amt_due">${{$data->special_amt_due}}</span>
                                                                                        </td>
                                                                                        <th width="15%">Demolition:</th>
                                                                                        <td width="10%"><span
                                                                                                class="editable-field-other_{{$data->parcel_id}}"
                                                                                                id="demolition"
                                                                                                name="demolition">{{$data->demolition}}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="vertical-align:top;">
                                                                                        <th width="22%">Code Summary:</th>
                                                                                        <td colspan="5" width="75%"><span
                                                                                                class="editable-field-other_{{$data->parcel_id}}"
                                                                                                id="codeSummarySpan"
                                                                                                name="code_summary">{!!
                                                                                                nl2br($data->code_summary)
                                                                                                !!}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="vertical-align:top;">
                                                                                        <th width="22%">Special Summary:</th>
                                                                                        <td colspan="5" width="75%"><span
                                                                                                class="editable-field-other_{{$data->parcel_id}}"
                                                                                                id="specialSummarySpan"
                                                                                                name="special_summary">{!! nl2br($data->special_summary) !!}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="vertical-align:top;">
                                                                                        <th width="22%">Demolition Summary:</th>
                                                                                        <td colspan="5" width="75%"><span
                                                                                                class="editable-field-other_{{$data->parcel_id}}"
                                                                                                id="demolitionSummarySpan"
                                                                                                name="demolition_summary">{!!
                                                                                                nl2br($data->demolition_summary)
                                                                                                !!}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="vertical-align:top;">
                                                                                        <th width="22%">Permit Summary:</th>
                                                                                        <td colspan="5" width="75%"><span
                                                                                                class="editable-field-other_{{$data->parcel_id}}"
                                                                                                id="permitSummarySpan"
                                                                                                name="permit_summary">{!! nl2br($data->permit_summary) !!}</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </table>
                                                                        </div>
                                                                        <div class="col-lg-1">
                                                                            <button type="button" id="other_{{$data->parcel_id}}Editbtn"
                                                                                class="btn btn-sm editbtn  btn-info pr-1 pl-1 pt-0 pb-0"
                                                                                onclick="editOrderInfo('other_{{$data->parcel_id}}')"><i
                                                                                    class="dripicons-pencil"
                                                                                    style="font-size:6px"></i></button>
                                                                            <button type="button" style="display: none;"
                                                                                id="cancelother_{{$data->parcel_id}}Container"
                                                                                class="btn btn-sm editbtn other_{{$data->parcel_id}}Editbtn btn-info pr-1 pl-1 pt-0 pb-0"
                                                                                onclick="cancelOrder('other_{{$data->parcel_id}}')"><i
                                                                                    class="dripicons-chevron-right"
                                                                                    style="font-size:6px"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <div id="submitother_{{$data->parcel_id}}Container" style="display: none;">
                                                                        <button class="btn btn-xs btn-success mt-2 mx-2" type="submit"
                                                                            name="order_update" id="order_update1" value="1"
                                                                            onclick="submit('other_{{$data->parcel_id}}')">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <hr class="pt-1 m-0" style="border-top:3px solid #3e3952">
                                </div>
                                @endforeach
                                {{-- Notes Info --}}
                                <input type="hidden" name="ckeditStart" id="ckeditStart" value="{!! $cke = 1 !!}">
                                <div class="row mb-2 note_form_edit">
                                    <div class="col-lg-11">
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" id="editorToggleBtn"
                                                    class="btn btn-sm editbtn btn-info pr-1 pl-1 pt-0 pb-0"><i
                                                        class="dripicons-pencil"
                                                        style="font-size:6px"></i></button>
                                    </div>
                                </div>
                                @foreach($orderData as $data)
                                <div id="note_{{$data->parcel_id}}_info" class="parcelbody">
                                    <div class="card mb-2">
                                        <div class="card-header custom-accordion" id="utilities_{{$data->parcel_id}}_note">
                                            <div class="p-1 pointer" data-toggle="collapse"
                                                data-target="#note_{{$data->parcel_id}}_utilities_1" aria-expanded="true"
                                                aria-controls="note_{{$data->parcel_id}}_utilities_1">
                                                <b>Notes# {{ $data->parcel_number }}</b><img src="" alt="" class="float-right" height="15px"
                                                    id="note_{{$data->parcel_id}}_statusImage" class="editable-field-note_{{$data->parcel_id}}">
                                            </div>
                                        </div>
                                        <div id="note_{{$data->parcel_id}}_utilities_1" class="card-body collapse show" aria-labelledby="heading_1"
                                            data-parent="#note_{{$data->parcel_id}}_info" style="">
                                            <div id="container-fluid">
                                            <div class="row" >
                                                <div class="col-lg-12 ckedit-container" data-container-id="{{ $loop->iteration }}">
                                                    {{-- <button id="editorToggleBtn">Toggle Editor</button> --}}
                                                    <input type="hidden" id="parcel_id" name="parcel_id" value="{{$data->parcel_id}}" />
                                                    <table>
                                                    <tr class="mt-2">
                                                        <td style="vertical-align:top"><b>Code Violation</b></td>
                                                        <td><div class="mt-1" class="ckedit" id="editorContainer{!! $cke++ !!}">{!! $data->code_violation !!}</div></td>
                                                    </tr>
                                                    <tr class="mt-2">
                                                        <td style="vertical-align:top"><b>Permits</b></td>
                                                        <td><div class="mt-1" class="ckedit" id="editorContainer{!! $cke++ !!}">{!! $data->permits !!}</div></td>
                                                    </tr>
                                                    <tr class="mt-2">
                                                        <td style="vertical-align:top"><b>Special Assessment</b></td>
                                                        <td><div class="mt-1" class="ckedit" id="editorContainer{!! $cke++ !!}">{!! $data->special_assessment !!}</div></td>
                                                    </tr>
                                                    <tr class="mt-2">
                                                        <td style="vertical-align:top"><b>Demolition</b></td>
                                                        <td><div class="mt-1" class="ckedit" id="editorContainer{!! $cke++ !!}">{!! $data->demolition_permit !!}</div></td>
                                                    </tr>
                                                    <tr class="mt-2">
                                                        <td style="vertical-align:top"><b>Utilities</b></td>
                                                        <td><div class="mt-1" class="ckedit" id="editorContainer{!! $cke++ !!}">{!! $data->utility !!}</div></td>
                                                    </tr>
                                                    </table>
                                               </div>

                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <hr class="pt-1 m-0" style="border-top:3px solid #3e3952">
                                </div>
                                @endforeach
                                <div class="row text-center note_form_edit">
                                    <div class="col-lg-12" id="submitNotesContainer" style="display: none;">
                                        <input type="button" name="submit" class="btn btn-xs btn-success mt-3 mr-1"
                                            id="submitNotes" value="Submit"/>
                                    </div>
                                </div>
                                <input type="hidden" name="ckeditEnd" id="ckeditEnd" value="{!! $cke = $cke - 1 !!}">
                                {{-- Additonal Fee info --}}
                                <div id="feeinfoaccordion">
                                    <div class="card mb-0">
                                        <div class="card-header mainfee custom-accordion" id="headingfeeinfo">
                                            <div class="p-1 pointer" data-toggle="collapse" data-target="#collapsefee"
                                                aria-expanded="true" aria-controls="headingfeeinfo">
                                                <b> Additional Fee Information</b>
                                            </div>
                                        </div>
                                        <div id="collapsefee" class="collapse show" aria-labelledby="headingetainfo" data-parent="#etainfoaccordion">
                                            <div class="card-body" id="fee_card">
                                                <div class="row mb-0 pb-0 mt-1 addeta" id="etadiv_1">
                                                    <div class="col-lg-10">
                                                        <table id="fee_infotable" width="100%">
                                                            <thead id="fee_header1">
                                                                <tr id="fee_rowheader1">
                                                                    <th width="25%">Fee Description</th>
                                                                    <th width="25%">Fees Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id=fee_body1>
                                                                @if(isset($additional_fee[0]->id))
                                                                    @for ($i = 0; $i < count($additional_fee); $i++)
                                                                        <tr id="row_{{$additional_fee[$i]->id}}">
                                                                            <td width="60%"><textarea disabled required class="form-control form-control-sm editable-field-fee" col="3" name="fees_description[]" id="fees_description_{{$additional_fee[$i]->id}}" rows="1">{{$additional_fee[$i]->fee_description}}</textarea></td>
                                                                            <td width="20%"><input disabled required class="form-control editable-field-fee" type="number" name="fees_amount[]" id="fees_amount_{{$additional_fee[$i]->id}}" rows="1" value="{{$additional_fee[$i]->fee_amount}}"></td>
                                                                            <td width="20%">
                                                                                <button style="display: none;" type="button" id="remove_fee_{{$additional_fee[$i]->id}}" class="btn btn-danger remove-fee-btn btn-sm text-white removebtn pb-0 pt-0 pr-1 pl-1" onclick="delete_fee_data({{$additional_fee[$i]->id}})">-</a>
                                                                            </td>
                                                                        </tr>
                                                                    @endfor
                                                                @else
                                                                <tr id="row_a1">
                                                                    <td width="60%"><textarea disabled required class="form-control form-control-sm editable-field-fee" col="3" name="fees_description[]" id="fees_description_a1" rows="1"></textarea></td>
                                                                    <td width="20%"><input disabled required class="form-control editable-field-fee" type="number" name="fees_amount[]" id="fees_amount_a1" rows="1" value=""></td>
                                                                    <td width="20%">
                                                                        <button style="display: none;" type="button" id="remove_fee_a1" class="btn btn-danger remove-fee-btn btn-sm text-white removebtn pb-0 pt-0 pr-1 pl-1" onclick="delete_fee_data_a(1)">-</a>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-lg-2 d-flex">
                                                        <button type="button" id="feeEditbtn" class="btn btn-sm mr-1 editbtn btn-info pr-1 pl-1 pt-0 pb-0" onclick="editAdditionalFee('fee')"><i class="dripicons-pencil" style="font-size:6px"></i></button>
                                                        <button style="display: none;" type="button" id="addnew_fee" class="btn btn-success btn-sm text-white appendbtn pb-0 pt-0 pr-1 pl-1" onclick="addfee();">+</button>
                                                    </div>
                                                </div>
                                                <div class="mt-1"></div>
                                                <div class="row mt-1">
                                                    <div class="col-lg-12">
                                                        <div id="submitfeeContainer" class='row' style="display: none;">
                                                            <button class="btn btn-xs btn-success ml-4 mt-2 mx-2" type="submit"
                                                                name="order_update" id="order_update1" value="1"
                                                                onclick="submitfee({{$orderData[0]->order_id}})">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="pt-1 m-0" style="border-top:3px solid #3e3952">
                                </div>

                                {{--ETA info --}}
                                <div id="etainfoaccordion">
                                    <div class="card mb-0" id="eta_info">
                                        <div class="card-header maineta custom-accordion" id="headingetainfo">
                                            <div class="p-1 pointer" data-toggle="collapse" data-target="#collapseeta"
                                                aria-expanded="true" aria-controls="headingetainfo">
                                                <b> Other Info </b>
                                            </div>
                                        </div>
                                        <div id="collapseeta" class="collapse show" aria-labelledby="headingetainfo" data-parent="#etainfoaccordion">
                                            <div class="card-body" id="eta_card">
                                                <form id="order_form" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="orderid" value="{{$orderData[0]->order_id}}">
                                                    <input type="hidden" name="uid" value="{{Session::get('uid')}}">
                                                    <div class="row">
                                                        <div class="col-lg-1 mr-2 mt-2">
                                                            <label> Status:</label>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <select style="width: 130px" name="other_status" id="other_status" class="form-control" required onchange="get_etafields(this.id);">
                                                            <option disabled selected value="">Select</option>
                                                            <option value="4"> Follow Up </option>
                                                            <option value="5"> Clarification Req </option>
                                                            <option value="6"> Clarification Rec </option>
                                                            <option value="10"> Cancelled </option>
                                                            <option value="12"> Mail Away </option>
                                                            <option value="13"> On Hold </option>
                                                        </select>
                                                        </div>
                                                        <div class="col-lg-1 mr-3 mt-2">
                                                            <label>Comments:</label>
                                                        </div>
                                                        <div class="col-lg-6 mb-0 pb-0">
                                                            <textarea required id="other_status_comments" class="form-control" rows="2" name="other_status_comments" placeholder="Comments"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2" id="etadiv">
                                                    </div>
                                                    <div class="row">
                                                        <button class="btn btn-xs btn-success p-1 mt-3 ml-3" type="submit" name="other_status_submit" id="other_status_submit" value="submit" style="cursor: pointer;">Submit</button>
                                                    </div>
                                                    <div class="col-lg-12 m-0 p-0 mt-3">
                                                        @foreach ($statusHistory as $history)
                                                        <table class="other_status" width="100%" class="p-0 m-0" >
                                                            <tr>
                                                                <td width="15%">
                                                                    <b style="color:#f08411">User:</b>{!! ucfirst($history->first_name) !!} {!! ucfirst($history->last_name) !!}</td>
                                                                <td width="15%" align="left">
                                                                    <b style="color:#f08411">Status:</b> {{$history->status_type}} </td>
                                                                @if($history->status_id == 4 || $history->status_id == 12)
                                                                <td width="20%" align="right">
                                                                    <b style="color:#f08411">Follow Up:</b> {!! isset($history->followup_date) ? date("m/d/Y", strtotime($history->followup_date)) : "" !!} </td>
                                                                <td width="20%" align="right">
                                                                    <b style="color:#f08411">ETA:</b> {!! isset($history->eta_date) ? date("m/d/Y", strtotime($history->eta_date)) : "" !!} </td>
                                                                @endif
                                                                <td width="30%" align="right">
                                                                    <b style="color:#f08411">Date:</b> {!! isset($history->updated_at) ? date("m/d/Y h:i:s A", strtotime($history->updated_at)) : "" !!} </td>
                                                            </tr>
                                                            <tr class="status_comments">
                                                                <td class="comm" id="comm_{{$history->id}}" colspan="5">{{$history->comments}}</td>
                                                            </tr>
                                                        </table>
                                                        <hr class="p-1 m-0">
                                                        @endforeach
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="pt-1 m-0" style="border-top:3px solid #3e3952">
                                </div>


                                {{-- supporting_docs --}}
                                <div id="supportingdocaccordion">
                                    <div class="card">
                                        <div class="card-header mainsupdocs" id="headingsupportingdocinfo">
                                            <div class="p-1 pointer" data-toggle="collapse"
                                                data-target="#collapsesupportingdoc" aria-expanded="true"
                                                aria-controls="headingsupportingdocinfo">
                                                <b> Supporting Docs</b>
                                            </div>
                                        </div>
                                        <div id="collapsesupportingdoc" class="collapse show"
                                            aria-labelledby="headingsupportingdocinfo"
                                            data-parent="#supportingdocaccordion">
                                            <div class="card-body" id="supportingdoc_card">
                                                <em style="cursor:pointer"
                                                    class="mdi mdi-drag-variant text-white"></em><input
                                                    onchange="selectallullis()" type="checkbox" name="selectallulli"
                                                    id="selectallulli" value="" /><u> Select All PDF's</u>
                                                <div class="row mb-0 pb-0 mt-2" id="dispsup">
                                                    <ul class="sortable m-1 p-1" id="sortabletable">
                                                        @foreach ($supportingdocs as $linked_pdf)
                                                        @if(!str_starts_with($linked_pdf->pdf_file, "Certificate") && !str_starts_with($linked_pdf->pdf_file, "Merged"))
                                                        <li id="{{$linked_pdf->id}}">
                                                            <i style="cursor:pointer" class="mdi mdi-drag-variant"></i>
                                                            <input type="checkbox"
                                                                onchange="display_merge_link({{$linked_pdf->id}})"
                                                                value="{{$linked_pdf->id}}"
                                                                id="selectpdf{{$linked_pdf->id}}" name="selectpdf[]" />
                                                            <a style="cursor:pointer;color:blue"
                                                                onclick="openSupportingDoc({{$linked_pdf->id}}, 'newWindow')">
                                                                <u><i
                                                                        class="dripicons-paperclip">{{$linked_pdf->pdf_file}}</i></u>
                                                            </a>
                                                            &nbsp;
                                                            <a style="cursor:pointer;" class="text-danger"
                                                                onclick="delete_supporting_doc({{$linked_pdf->id}})">
                                                                <u><i class="dripicons-trash"></i></u>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <button style="display:none;cursor:pointer"
                                                    class="btn btn-xs p-0 m-0 btn-primary pl-1 pr-1 mt-2 display_merge_pdf"
                                                    onclick="generate_singlepdf()" type="button" id="mergepdfs"
                                                    name="mergepdfs"> Merge Pdf's
                                                    With Cert <em class="mdi mdi-source-merge"></em>
                                                </button>
                                                @foreach ($supportingdocs as $linked_pdf)
                                                @if (str_starts_with($linked_pdf->pdf_file, "Merged"))
                                                <button hidden class="btn btn-xs p-0 m-0 btn-warning pl-1 pr-1 mt-2"
                                                    onclick="openSupportingDoc({{$linked_pdf->id}}, 'download', {{$orderData[0]->app_number}}.'_merged_docs' )"
                                                    type="button" id="mergepdfsdownload" name="mergepdfsdownload">
                                                    Download <em class="mdi mdi-cloud-download"></em></button>
                                                @endif
                                                @endforeach
                                                <span id="processingpdf"></span>
                                                <form id="supportingdoc_infoform" class="supportingdoc_upload"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" id="order_id" name="order_id" />
                                                    <div class="row mt-1">
                                                        <div class="col-lg-3 mb-0 pb-0">
                                                            <label> Supporting Docs </label>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-0 pb-0 mt-1 addsupdocs" id="supportingdocsdiv_1">
                                                        <div class="col-lg-12 mb-0 pb-0">
                                                            <input type="hidden" id="docscount1" name="docscount[]"
                                                                class="form-control" value="1">
                                                            <input required type="file" id="refdocs_1" name="refdocs[]"
                                                                multiple data-height="75" height="100px"
                                                                class="form-controlfile suppdoc dropify"
                                                                accept="application/pdf">
                                                        </div>
                                                    </div>
                                                    <div class="mt-1" id="addsupportingvalues"></div>
                                                    <div class="row mt-1">
                                                        <div class="col-lg-12">
                                                            <button class="btn btn-xs btn-primary p-1" type="submit"
                                                                id="supdocssubmit" name="supdocssubmit"
                                                                value="1">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row text-center">
                                        <div class="col-lg-12">
                                            <input type="button" name="viewpdf" class="btn btn-gradient-secondary mt-3"
                                                id="viewpdf" value="View Certificate" onclick="view_pdf();" />
                                        </div>
                                    </div>
                                    <div class="row text-center mt-2">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-4">
                                            <select style="height:27px !important;" align="center" required
                                                name="orderstatus" id="order_status" class="form-control">
                                                @foreach ($status_change as $status_select)
                                                @if ($status_select->id == $orderData[0]->status_id)
                                                <option selected value="{{ $status_select->id }}">
                                                    {{ $status_select->status_type }}</option>
                                                @else
                                                <option value="{{ $status_select->id }}">
                                                    {{ $status_select->status_type }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-4"></div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-lg-12">
                                            <input type="button" name="submit" class="btn btn-gradient-danger mt-3 mr-1"
                                                id="infosubmit" value="Submit"
                                                onclick="ordersubmit({{$orderData[0]->order_id}});" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/jquery-3.6.0.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/js/split.min.js')}}"></script>
    <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/js/split.min.js')}}"></script>
    <script>
        $(function () {
            $(".sortable").sortable();
        });

        $(document).ready(function () {
            statusUpdate('water');
            statusUpdate('sewer');
            statusUpdate('garbage');
            statusUpdate('utility');
            statusUpdate('other');
            statusUpdate('note');
            toggle_basic_info();
        });

        function get_etafields(clid)
        {

            var statusid = $("#"+clid).val();
            if(statusid == 4 || statusid == 12)
            {
                $('#etadiv').html("");
                $('#etadiv').append("<div class='col-lg-1 mr-2'><label>FollowUp:</label></div><div class='col-lg-3 mb-0 pb-0'><input type='date' required id='followup_date' class='form-control' name='followup_date' onchange='cal();'></div><div class='col-lg-1 mr-3'><label>ETA(Days): </label></div><div class='col-lg-2 mb-0 pb-0'><input type='text' required id='eta' class='form-control' name='eta' placeholder='ETA' pattern='[0-9]{1,2}' onkeyup='cal();'/></div><div class='col-lg-1 mr-3'><label>Estimated: </label></div><div class='col-lg-3 mb-0 pb-0'><input type='date' readonly required id='estimated_date' class='form-control' name='estimated_date' placeholder=''></textarea></div>");
            }
            else
            {
                $('#etadiv').html("");
            }
        }

        function GetDays()
        {
            var dateobj = new Date($("#followup_date").val());
            var eta = parseInt($("#eta").val());
            dateobj.setDate(dateobj.getDate() + eta);
            var etadate = new Date(dateobj).toISOString().slice(0, 10);
            return etadate;
        }

        function cal(){
            if(document.getElementById("followup_date"))
            {
                document.getElementById("estimated_date").value=GetDays();
            }
        }

        function editOrderInfo(category) {
            var fields = document.querySelectorAll('.editable-field-' + category);
            var editButton = document.getElementById(category + 'Editbtn');
            var submitContainer = document.getElementById('submit' + category + 'Container');
            var cancelButtonContainer = document.getElementById('cancel' + category + 'Container');
            for (var i = 0; i < fields.length; i++) {
                var field = fields[i];
                var fieldValue = field.textContent;
                var inputElement;
                field.setAttribute('data-original-value', fieldValue);
                if (!field.id.endsWith('SummarySpan')) {
                    inputElement = document.createElement('input');
                    inputElement.className = 'form-control';
                    inputElement.setAttribute('id', field.getAttribute('id'));
                    if (field.id.endsWith('_due_date') || field.id.endsWith('_date')  ) {
                        inputElement.type = 'date';
                        inputElement.valueAsDate = new Date(fieldValue);
                    } else {
                        if (field.id.endsWith('_due') || field.id.endsWith('_count')  ) {
                            if (fieldValue == '$0.00') {
                                inputElement.value = '';
                                inputElement.type = 'number';
                            } else {
                                inputElement.value = fieldValue.replace('$', '');
                                inputElement.type = 'number';

                            }
                        } else {
                            inputElement.value = fieldValue;
                            inputElement.type = 'text';
                        }
                    }
                } else {
                    inputElement = document.createElement('textarea');
                    inputElement.className = 'form-control notedescription';
                    inputElement.value = fieldValue;
                    inputElement.setAttribute('id', field.getAttribute('id'));
                }

                field.innerHTML = '';
                field.appendChild(inputElement);
            }

            editButton.style.visibility = 'hidden';
            cancelButtonContainer.style.display = 'block';
            submitContainer.style.display = 'block';

        }


        function cancelOrder(category) {
            var fields = document.querySelectorAll('.editable-field-' + category);
            var editButton = document.getElementById(category + 'Editbtn');
            var submitContainer = document.getElementById('submit' + category + 'Container');
            var cancelButton = document.getElementById('cancel' + category + 'Container');

            for (var i = 0; i < fields.length; i++) {
                var field = fields[i];
                var inputElement = field.querySelector('input, textarea');
                var fieldValuedata = field.getAttribute('data-original-value');
                if(field.id.endsWith('SummarySpan')) {
                    field.innerHTML = (inputElement.value).replace(/\n/g, "<br>");
                } else {
                    field.innerHTML = fieldValuedata;
                }
            }

            submitContainer.style.display = 'none';
            editButton.style.visibility = 'visible';
            cancelButton.style.display = 'none';

            document.getElementById(category + 'Editbtn').style.display = 'block';
        }

        function updateOrder(category) {

            var fields = document.querySelectorAll('.editable-field-' + category);
            var editButton = document.getElementById(category + 'Editbtn');
            var submitContainer = document.getElementById('submit' + category + 'Container');
            var cancelButton = document.getElementById('cancel' + category + 'Container');

            for (var i = 0; i < fields.length; i++) {
                var field = fields[i];
                var inputElement = field.querySelector('input, textarea');
                var fieldValue = document.createElement(field.tagName);
                fieldValue.setAttribute('id', field.getAttribute('id'));
                fieldValue.setAttribute('name', field.getAttribute('name'));
                fieldValue.setAttribute('class', field.getAttribute('class'));
                if (field.id.endsWith('_due')) {
                    if (inputElement.value == '') {
                        fieldValue.innerHTML = '$0.00';
                    } else {
                        fieldValue.innerHTML = '$' + parseFloat(inputElement.value).toFixed(2);
                    }
                } else if(field.id.endsWith('SummarySpan')) {
                    fieldValue.innerHTML = (inputElement.value).replace(/\n/g, "<br>");
                } else {
                    fieldValue.innerHTML = inputElement.value;
                }
                field.innerHTML = '';
                field.appendChild(fieldValue);
            }
            submitContainer.style.display = 'none';
            editButton.style.visibility = 'visible';
            cancelButton.style.display = 'none';
            document.getElementById(category + 'Editbtn').style.display = 'block';

            statusUpdate(category);
        }


        function view_pdf() {
            var iframe = $('iframe');
            var src = iframe.attr('src');
            iframe.attr('src', src);
        }

        function complete(category) {
            if (category.startsWith('water')) {
                updateOrder(category);
                editOrderInfo(category.replace('water', 'sewer'));
            } else if (category.startsWith('sewer')) {
                updateOrder(category);
                editOrderInfo(category.replace('sewer', 'garbage'));
            } else if (category.startsWith('garbage')) {
                updateOrder(category);
                editOrderInfo(category.replace('garbage', 'utility'));
            } else if (category.startsWith('utility')) {
                updateOrder(category);
                editOrderInfo(category.replace('utility', 'other'));
            } else if (category.startsWith('other')) {
                updateOrder(category);
            } else if (category.startsWith('note')) {
                updateOrder(category);
            } else if (category.startsWith('eta')) {
                updateOrder(category);
            }else if (category == 'parcel') {
                updateOrder('parcel');
            }
        }

        function submit(category) {
            var data = {
                _token: '{{csrf_token()}}'
            };
            var fields = document.querySelectorAll('.editable-field-' + category);
            for (var i = 0; i < fields.length; i++) {
                var field = fields[i];
                var inputElement = field.querySelector('input, textarea');
                var fieldValue = document.createElement(field.tagName);

                if (field.id.endsWith('_due')) {
                    if (inputElement.value == '') {
                        data[field.getAttribute('name')] = 0.00;
                    } else {
                        data[field.getAttribute('name')] = inputElement.value;
                    }
                } else {
                    if (field.id.endsWith('_summary')) {
                        data[field.getAttribute('name')] = (inputElement.value).replace(/\n/g, "<br>");
                    } else {
                        data[field.getAttribute('name')] = inputElement.value;
                    }
                }
            }
            $.ajax({
                url: 'send_data/' + category + "/{{$orderData[0]->order_id}}",
                method: 'POST',
                data: data,
                success: function (response) {
                    complete(category)
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }


        function statusUpdate(category) {
            var fields = document.querySelectorAll('.editable-field-' + category);
            for (var i = 0; i < fields.length; i++) {
                var field = fields[i];
                if (field.id.endsWith('_status') || field.id.endsWith('SummarySpan')) {
                    var status = field.innerText;
                    var statusImage = document.getElementById(category + '_statusImage');
                    if (status === null || status.trim() === '') {
                        statusImage.src = '{{asset("assets/images/cross.png")}}';
                    } else {
                        statusImage.src = '{{asset("assets/images/tick.png")}}';
                    }
                }
            }
        }




        $(document).ready(function () {
            const GUTTER_SIZE = 50;
            const gutterStyle = dimension => ({
                'flex-basis': `${GUTTER_SIZE}px`,
            });

            const elementStyle = (dimension, size) => ({
                'flex-basis': `calc(${size}% - ${GUTTER_SIZE}px)`,
            })

            Split(['#docdisplaydiv', '#detailsdisplaydiv'], {
                sizes: [500, 500],
                minSize: 100,
                elementStyle,
                gutterStyle
            });
        });


        function toggle_basic_info() {
            var parcel_count = {!! count($parcels) !!};
            if(parcel_count == 0) {
                $(".parcel_info").hide();
            } else {
                $(".parcel_info").show();
            }
            $("#parcel_info").show();
            $(".note_form_edit").hide();
            $('[id*="note"][id*="info"]').hide();
            $("#supportingdocaccordion").hide();
            $("#sectiontab_2").removeClass("btn-success").addClass('btn-warning');
            $("#sectiontab_1").removeClass("btn-warning").addClass('btn-success');
            $("#sectiontab_3").removeClass("btn-success").addClass("btn-outline-secondary");
            $("#sectiontab_3").addClass("btn-outline-secondary").removeClass("btn-success");
            $("#feeinfoaccordion").hide();
            $("#etainfoaccordion").hide();

        }

        function toggle_note_info() {
            var parcel_count = {!! count($parcels) !!};
            if(parcel_count == 0) {
                $(".note_form_edit").show();
            } else {
                $(".note_form_edit").hide();
            }
            $("#parcel_info").show();
            $(".parcel_info").hide();
            $("#parcel_info").hide();
            $(".note_form_edit").show();
            $('[id*="note"][id*="info"]').show();
            $("#supportingdocaccordion").hide();
            $("#sectiontab_2").removeClass("btn-success").addClass('btn-warning');
            $("#sectiontab_1").removeClass("btn-success").addClass('btn-warning');
            $("#sectiontab_3").addClass("btn-success").removeClass("btn-outline-secondary");
            $("#sectiontab_4").addClass("btn-outline-secondary").removeClass("btn-success");
            $("#feeinfoaccordion").hide();
            $("#etainfoaccordion").hide();
        }

        function toggle_docs_info() {
            $(".parcel_info").hide();
            $("#parcel_info").hide();
            $(".note_form_edit").hide();
            $('[id*="note"][id*="info"]').hide();
            $("#supportingdocaccordion").show();
            $("#sectiontab_2").removeClass("btn-success").addClass('btn-warning');
            $("#sectiontab_1").removeClass("btn-success").addClass('btn-warning');
            $("#sectiontab_4").addClass("btn-success").removeClass("btn-outline-secondary");
            $("#sectiontab_3").addClass("btn-outline-secondary").removeClass("btn-success");
            $("#feeinfoaccordion").show();
            $("#feeinfoaccordion").show();
            $("#etainfoaccordion").show();

        }

        function showclr(clid)
        {
            $(".parcel_info").hide();
            $("#parcel_info").hide();
            $(".note_form_edit").hide();
            $("#supportingdocaccordion").show();
            $("#sectiontab_2").removeClass("btn-success").addClass('btn-warning');
            $("#sectiontab_1").removeClass("btn-success").addClass('btn-warning');
            $("#sectiontab_4").addClass("btn-success").removeClass("btn-outline-secondary");
            $("#sectiontab_3").addClass("btn-outline-secondary").removeClass("btn-success");
            $("#note_info").hide();
            $("#feeinfoaccordion").show();
            $("#feeinfoaccordion").show();
            $("#etainfoaccordion").show();
            $("#comm_"+clid).css("background-color","#8389c9");
            $("#comm_"+clid).css("color","#fff");
        }


        // fee script start

        function editAdditionalFee(fee) {
            var chk = 0;
            var fields = document.querySelectorAll('.editable-field-' + fee);
                if(fields[0].disabled == false) {
                    chk = chk + 1;
                    $.ajax({
                        url: "{{url('cancel_fee_update')}}",
                        type: 'POST',
                        data: {_token: "{{csrf_token()}}", orderid:'{{$orderData[0]->order_id}}'},
                    success: function (response) {
                        var feeData = $('#fee_body1');
                        $(".fee_body1").remove();
                        feeData.empty();

                    $.each(response, function(index, item) {
                        var row = `
                            <tr id="row_${item.id}">
                                <td width="60%"><textarea disabled required class="form-control form-control-sm editable-field-fee" col="3" name="fees_description[]" id="fees_description_${item.id}" rows="1">${item.fee_description}</textarea></td>
                                <td width="20%"><input disabled required class="form-control editable-field-fee" type="number" name="fees_amount[]" id="fees_amount_${item.id}" rows="1" value="${item.fee_amount}"></td>
                                <td width="20%">
                                <button style="display: none;" type="button" id="remove_fee_${item.id}" class="btn btn-danger remove-fee-btn btn-sm text-white removebtn pb-0 pt-0 pr-1 pl-1" onclick="delete_fee_data(${item.id})">-</a>
                                </td>
                            </tr>
                            `;
                        feeData.append(row);
                    });

                    var tbody = document.getElementById("fee_body1");
                    var rowCount = tbody.querySelectorAll("tr").length;
                    var id = rowCount + 1;
                    if(rowCount == 0) {
                        var row = `
                        <tr id="row_a${id}">
                            <td width="60%"><textarea disabled required class="form-control form-control-sm editable-field-fee" col="3" name="fees_description[]" id="fees_description_a${id}" rows="1"></textarea></td>
                            <td width="20%"><input disabled required class="form-control editable-field-fee" type="number" name="fees_amount[]" id="fees_amount_a${id}" rows="1" value=""></td>
                            <td width="20%">
                            <button style="display: none;" type="button" id="remove_fee_a${id}" class="btn btn-danger remove-fee-btn btn-sm text-white removebtn pb-0 pt-0 pr-1 pl-1" onclick="delete_fee_data_a(${id})">-</a>
                            </td>
                        </tr>
                        `;
                        feeData.append(row);
                    }

                    $('#submitfeeContainer').css('display', 'none');
                    $('#addnew_fee').css('display', 'none');
                    $('.remove-fee-btn').css('display', 'none');
                    },
                        error: function (xhr, status, error) {
                        //
                        }
                    });
                }

            for (var i = 0; i < fields.length; i++) {
                var field = fields[i];
                if(field.disabled == true) {
                    if(i == 0) {
                        $('#submitfeeContainer').css('display', 'block');
                        $('#addnew_fee').css('display', 'block');
                        $('.remove-fee-btn').css('display', 'block');
                    }
                    field.disabled = false;
                } else {
                    if(i == 0) {
                        $('#submitfeeContainer').css('display', 'none');
                        $('#addnew_fee').css('display', 'none');
                        $('.remove-fee-btn').css('display', 'none');
                    }
                    // field.disabled = true;
                }
            }

        }

        function delete_fee_data(feeid) {
            $.ajax({
                url: '{{url("delete_fee_data")}}',
                method: 'POST',
                data:{
                    feeId: feeid,
                    _token: "{{csrf_token()}}"
                },
                success: function (response) {
                    $('#row_' +feeid).remove();
                    $('#remove_fee_' +feeid).remove();
                },
                error: function (xhr, status, error) {
                   //
                }
            });
        }

        function delete_fee_data_a(feeid) {
            $('#row_a' +feeid).remove();
            $('#remove_fee_a' +feeid).remove();
        }

        function addfee() {
            var tbody = document.getElementById("fee_body1");
            var rowCount = tbody.querySelectorAll("tr").length;
            var id = rowCount+1
            var feeData = $('#fee_body1');
            var row = `
                    <tr id="row_a${id}">
                        <td width="60%"><textarea required class="form-control form-control-sm editable-field-fee" col="3" name="fees_description[]" id="fees_description_a${id}" rows="1"></textarea></td>
                        <td width="20%"><input required class="form-control editable-field-fee" type="number" name="fees_amount[]" id="fees_amount_a${id}" rows="1" value=""></td>
                        <td width="20%">
                        <button style="display: block;" type="button" id="remove_fee_a${id}" class="btn btn-danger remove-fee-btn btn-sm text-white removebtn pb-0 pt-0 pr-1 pl-1" onclick="delete_fee_data_a(${id})">-</a>
                        </td>
                    </tr>
                    `;
            feeData.append(row);
        }

        function submitfee(orderid)
        {
            var feesAmount = [];
                var feesDescription = [];

                $('textarea[name="fees_description[]"]').each(function () {
                    feesDescription.push($(this).val());
                });

                $('input[name="fees_amount[]"]').each(function () {
                    feesAmount.push($(this).val());
                });

                var data = 'fees_description=' + feesDescription + '&fees_amount=' + feesAmount + '&orderid=' +
                "{{$orderData[0]->order_id}}" + '&_token=' + "{{csrf_token()}}";

                $.ajax({
                    url: "{{url('additional_fee_update')}}",
                    type: 'POST',
                    data: data,
                success: function (response) {
                    var feeData = $('#fee_body1');
                    $(".fee_body1").remove();
                    feeData.empty();

                    $.each(response, function(index, item) {
                        var row = `
                            <tr id="row_${item.id}">
                                <td width="60%"><textarea disabled required class="form-control form-control-sm editable-field-fee" col="3" name="fees_description[]" id="fees_description_${item.id}" rows="1">${item.fee_description}</textarea></td>
                                <td width="20%"><input disabled required class="form-control editable-field-fee" type="number" name="fees_amount[]" id="fees_amount_${item.id}" rows="1" value="${item.fee_amount}"></td>
                                <td width="20%">
                                <button style="display: none;" type="button" id="remove_fee_${item.id}" class="btn btn-danger remove-fee-btn btn-sm text-white removebtn pb-0 pt-0 pr-1 pl-1" onclick="delete_fee_data(${item.id})">-</a>
                                </td>
                            </tr>
                            `;
                        feeData.append(row);
                    });

                    $('#submitfeeContainer').css('display', 'none');
                    $('#addnew_fee').css('display', 'none');
                    $('.remove-fee-btn').css('display', 'none');
                },
                error: function (xhr, status, error) {
                   //
                }
            });
        }

        // fee script end

        $(document).ready(function () {
            // Handle form submission
            $('#supportingdoc_infoform').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission
                // Get the form data
                var formData = new FormData(this);

                formData.append('orderid', "{{$orderData[0]->order_id}}");
                formData.append('_token', "{{csrf_token()}}");
                $.ajax({
                    url: "{{url('supporting_pdf_upload')}}",
                    type: 'POST',
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from automatically setting the content type
                    success: function (response) {
                        var id = response[0].id;
                        var pdf_file = response[0].pdf_file;
                        var listItem = '<li id="' + id + '">' +
                            '<i style="cursor:pointer" class="mdi mdi-drag-variant"></i>' +
                            '<input type="checkbox" onchange="display_merge_link(' + id +
                            ')" value="' + id + '" id="selectpdf' + id +
                            '" name="selectpdf[]" />' +
                            '<a style="cursor:pointer;color:blue" onclick="openSupportingDoc(' +
                            id + ', \'newWindow\')"><u> <i class="dripicons-paperclip">' + pdf_file +
                            '</i></u></a>' +
                            '&nbsp;' +
                            '<a style="cursor:pointer;" class="text-danger" onclick="delete_supporting_doc(' +
                            id + ')"><u><i class="dripicons-trash"></i></u></a>' +
                            '</li>';

                        $('#sortabletable').append(listItem);
                        $('.dropify-clear').click();
                    },
                    error: function (xhr, status, error) {
                        console.error('File upload failed.');
                        // Handle error response here
                    }
                });
            });
        });


        function ordersubmit(orderid) {
            var status = $("#order_status").val();
            var title = "";
            var title_heading = "";
            var date = "";
            var comments = "";
            var chk = 0;

            if (status == "4") {
                title = "follow_up";
                title_heading = "Follow Up";
            } else if (status == "5") {
                title = "clarification_Requested";
                title_heading = "Clarification Req";
            } else if (status == "6") {
                title = "clarification_Received";
                title_heading = "Clarification Rec";
            } else {
                submitOrder(status, orderid, date, comments);
                chk = 1;
            }
            if(chk == 0) {
                Swal.fire({
                    title: title_heading,
                    html: `
                <div class="swal-input-container">
                    ${status == "4" ?
                    `<div class="row justify-content-center">
                        <div class="col-md-3">
                            <label for="${title}_date" class="label-date">${title_heading} Date</label>
                        </div>
                        <div class="col-md-6">
                            <input type="date" id="date" name="${title}_date" class="form-control" placeholder="Date" required>
                        </div>
                    </div>` : ''}
                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-10 ">
                            <textarea id="comments" name="${title}_comments" class="form-control" placeholder="Type your comments here..." aria-label="Type your comments here..."></textarea>
                        </div>
                    </div>`,
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Cancel',
                    preConfirm: function () {
                        date = $("#date").val();
                        comments = $("#comments").val();
                        if ((status == "4" && (date.trim() == '' || comments.trim() == '')) ||
                            ((status == "5" || status == "6") && comments.trim() == '')) {
                            Swal.fire({
                                text: "Please fill all fields",
                                icon: 'warning',
                            }).then((result) => {
                                ordersubmit(orderid);
                            });
                            return false;
                        }
                        submitOrder(status, orderid, date, comments);
                    },
                    onOpen: function () {
                        // $(".swal-input-container").css("display", "flex");
                        $(".swal-input-container .label-date").css("margin-right", "15px");
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        date = result.value.date;
                        comments = result.value.comments;
                    }
                });
            }
        }

        function submitOrder(status, orderid, date, comments) {
            var data = {
                status: status,
                date: date,
                comments: comments,
                orderid: "{{$orderData[0]->order_id}}",
                _token: "{{csrf_token()}}"
            };
            var serializedData = $.param(data);

            $.ajax({
                url: "{{url('order_submit')}}",
                method: 'POST',
                data: serializedData,
                success: function (response) {
                    if (response.message == 'Order Status Updated') {
                        Swal.fire({
                            text: "Order Status Updated Successfully",
                            icon: 'success',
                        }).then((result) => {
                            //  window.location.href = "{{route('orderlist')}}";
                             window.location.href = "{{ url('ordercert/' . $orderData[0]->order_id) }}";
                        });
                    } else {
                        Swal.fire(
                            'Something went wrong!'
                        );
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function delete_supporting_doc(supportid) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this supporting file...",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Go ahead!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "{{url('delete_supporting_doc')}}",
                        data: 'supportid=' + supportid + '&action=deletesupporting_docs&_token=' +
                            "{{csrf_token()}}",
                        success: function (html) {
                            $("#" + supportid).hide(2000);
                            $("#removesupportingfile" + supportid).hide(2000);
                        }
                    });
                }
            });
        }


        function generate_singlepdf() {
            selected_pdf = [];
            if ($("[name='selectpdf[]']:checked").length > 0) {
                $("[name='selectpdf[]']:checked").each(function () {
                    selected_pdf.push($(this).val());
                });

                $.ajax({
                    method: "POST",
                    url: "{{url('cert_pdfmerge')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        action: 'pdfmerge',
                        ids: selected_pdf,
                        orderid: "{{$orderData[0]->order_id}}"
                    },
                    beforeSend: function () {
                        $("#loading-overlay").show();
                        $("#mergepdfs").css('display', 'none');
                        $("#processingpdf").html(
                            '<span class="text-warning"> Processing </span><span class="spinner-border text-warning"></span>'
                        );
                    },
                    success: function (response) {
                        var id = response[0].id;
                        var pdf_file = response[0].pdf_file;
                        var listItem = '<li id="' + id + '">' +
                            '<i style="cursor:pointer" class="mdi mdi-drag-variant"></i>' +
                            '<input type="checkbox" onchange="display_merge_link(' + id + ')" value="' +
                            id + '" id="selectpdf' + id + '" name="selectpdf[]" />' +
                            '<a style="cursor:pointer;color:blue" onclick="openSupportingDoc(' + id +
                            ', \'newWindow\')"><u> <i class="dripicons-paperclip">' + pdf_file + '</i></u></a>' +
                            '&nbsp;' +
                            '<a style="cursor:pointer;" class="text-danger" onclick="delete_supporting_doc(' +
                            id + ')"><u><i class="dripicons-trash"></i></u></a>' +
                            '</li>';

                        $('#sortabletable').append(listItem);
                        $("#loading-overlay").hide();
                        $("#mergepdfs").css('display', '');
                        $("#mergepdfsdownload").css('display', 'none');
                        $("#processingpdf").html(
                            '<button class="btn btn-xs p-0 m-0 btn-warning pl-1 pr-1 mt-2" onclick="openSupportingDoc(' +
                            "'" + id + "', 'download', '" + '{{$orderData[0]->app_number}}' + "_merged_docs" + "')" +
                            '" type="button" id="mergepdfs" name="mergepdfs"> Download <em class="mdi mdi-cloud-download"></em></button>'
                        );
                        selectallullis();
                    }
                });
            } else {
                Swal.fire({
                    title: 'Alert!!!',
                    text: "You need to check atleast one supporting file checkbox",
                    icon: 'warning'
                });
            }
        }

        // function download_singlepdf(pdflocation) {
        //     window.open(pdflocation);
        // }

        function showhistory(orderid)
        {
        $.ajax({
                type:'POST',
                url:'{{url("order_status_history")}}',
                data:'orderid='+orderid+'&action=viewhistory&_token=' + '{{csrf_token()}}',
                success:function(response){
                    var assessHistory = $('#assess_history');
                    assessHistory.empty();
                    var rowcount = 1;
                    $.each(response, function(index, item) {
                        if(item.user_name == null || item.user_name == undefined) {
                            item.user_name = '';
                        }
                        if(item.comments == undefined) {
                            if(item.status_type == "Completed") {
                                item.comments = "Order is Completed";
                            } else if(item.status_type == "Qc Queue") {
                                item.comments = "Order Completed on QC";
                            } else if(item.status_type == "Open") {
                                item.comments = "Order is Open";
                            } else if(item.status_type == "Open") {
                                item.comments = "Order is Closed";
                            } else {
                                item.comments = "";
                            }
                        }
                    var row = '<tr>' +
                        '<td>'+ rowcount +'</td>' +
                        '<td>' + item.status_type + '</td>' +
                        '<td>'+ item.user_name  +'</td>' +
                        '<td>' + item.comments + '</td>' +
                        '<td>' + item.updated_at + '</td>' +
                        '</tr>';
                        rowcount = rowcount+1;
                        assessHistory.append(row);
                    });
                    $('#historymodal').modal('show');
                }
            });
        }

        function removesupportingdocs(supindex) {
            $("#supportingdocsdiv_" + supindex).remove();
        }

        function selectallullis() {
            if ($("#selectallulli").is(":checked") == true) {
                $("ul#sortabletable li").each(function (index, element) {

                    $("#selectpdf" + $(this).attr('id')).prop('checked', true);
                });
                $(".display_merge_pdf").css('display', '');
            } else if ($("#selectallulli").is(":checked") == false) {
                $("ul#sortabletable li").each(function (index) {
                    $("#selectpdf" + $(this).attr('id')).prop('checked', false);
                });
                $(".display_merge_pdf").css('display', 'none');
            }
        }

        function display_merge_link(supportid) {
            total_lis = $("ul#sortabletable li").length;
            if ($("ul#sortabletable li input:checkbox:checked").length) {
                $("#mergepdfs").css('display', '');
                $("#selectpdf" + supportid).removeAttr('checked');
            } else {
                $("#mergepdfs").css('display', 'none');
            }

            if ($("ul#sortabletable li input:checkbox:checked").length < total_lis) {
                $("#selectallulli").prop('checked', false);
            } else if ($("ul#sortabletable li input:checkbox:checked").length == total_lis) {
                $("#selectallulli").prop('checked', true);
            }

        }

        function openSupportingDoc(docId, option, customFilename = '') {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', "{{ url('open_supporting_doc') }}", true);
            xhr.responseType = 'blob';

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var blob = xhr.response;

                    var url = URL.createObjectURL(blob);

                    if (option === 'newWindow') {
                        var windowFeatures = 'height=' + screen.height + ',width=550,scrollbars=yes,status=yes';
                        window.open(url, '_blank', windowFeatures);
                    } else if (option === 'newTab') {
                        window.open(url, '_blank');
                    } else if (option === 'download') {
                        var a = document.createElement('a');
                        a.href = url;
                        a.target = '_blank';
                        a.download = customFilename !== '' ? customFilename : 'custom_filename.pdf';
                        a.click();
                    }

                    // Clean up the object URL after opening or downloading
                    URL.revokeObjectURL(url);
                }
            };

            var formData = new FormData();
            formData.append('docid', docId);
            formData.append('orderid', "{{ $orderData[0]->order_id }}");
            formData.append('_token', "{{ csrf_token() }}");

            xhr.send(formData);
        }

        $(document).ready(function() {
            $('#order_form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ url('other_status_update') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        window.location.href = "{{ url('ordercert/' . $orderData[0]->order_id) }}";
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });


            $('#parcel_form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ url('parcel') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        window.location.href = "{{ url('ordercert/' . $orderData[0]->order_id) }}";
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });


        function addpropLegalDesc(pcount)
        {
            var prolegaldescid = $(".addpropertyLegalDesc:last").attr("id");
            var prolegaldescsplit_id = prolegaldescid.split("_");
            var prolegaldescindex = Number(prolegaldescsplit_id[1]) + 1;
            var max = 500;
                $('#new_legalDesc').append('<div class="row mb-0 pb-0 addpropertyLegalDesc" id="addedprolegaldesc_'+prolegaldescindex+'">\
                <div class="col-lg-10">\
                        <table id="parcel_infotable" width="100%">\
                            <tr>\
                                <th width="25%">Parcel Number:</th>\
                                <td width="25%"><input type="text" name="propertyLegalIdentifier[]" id="propertyLegalIdentifier_'+prolegaldescindex+'" class="form-control addpropertyLegalDesc parcelno" placeholder="Parcel No" required></td>\
                                <th width="25%">Legal Description:</th>\
                                <td width="25%"><textarea name="legalDesc[]" id="legalDesc_'+prolegaldescindex+'" rows="1" class="form-control addpropertyLegalDesc" placeholder="Legal Description"></textarea></td>\
                            </tr>\
                        </table>\
                    </div>\
                    <div class="col-lg-2">\
                        <button type="button" id="addnewpropertyLegalDesc_1" class="btn btn-success appendbtn btn-sm text-white pb-0 pt-0 pr-1 pl-1 addnewpropertyLegalDesc" onclick="addpropLegalDesc('+pcount+')">+</button>\
                        <button type="button" onclick="removepropLegalDesc('+prolegaldescindex+','+pcount+')" class="btn removebtn btn-danger btn-sm pb-0 pt-0 pr-1 pl-1 addpropertyLegalDesc" id="delpropLegalDesc_'+prolegaldescindex+'">-</button>\
                    </div>\
            </div>');
            $("#psubmitbutton1").show();
        }
        function edit_parcelinfo(orderid)
        {
            $.ajax({
                type: 'POST',
                url: "{{ url('parcel') }}",
                data: {
                    _token: "{{csrf_token()}}",
                    orderid: "{{$orderData[0]->order_id}}",
                    action: "edit"
                },
                success: function(htmlOutput) {
                    $('#psubmitbutton1').show();
                    $('#parceledit').html(htmlOutput);

                }
            });
        }
        function removeajaxparcelinfo(parcelcount,parcelid)
        {
            Swal.fire({
                    title: 'Are you sure?',
                    text: "All the information related to this Parcel will be Deleted",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Go ahead!'
                }).then((result) => {
                if (result.value) {
                    $.ajax({
                    type:'POST',
                    url: "{{ url('parcel') }}",
                    data: {
                        _token: "{{csrf_token()}}",
                        parcelId: parcelid,
                        orderid: "{{$orderData[0]->order_id}}",
                        action: "delete"
                    },
                    success:function(response){
                        window.location.href = "{{ url('ordercert/' . $orderData[0]->order_id) }}";
                    }
                });

                }
                });
        }
        function removepropLegalDesc(proplegaldesc, pcount) {
            var prolegaldesclastindex = proplegaldesc;
            if(prolegaldesclastindex >= 1)
            {
                $("#addedprolegaldesc_"+prolegaldesclastindex).remove();
            }
            var totparcel = prolegaldesclastindex - 1;
            if(totparcel == pcount)
            {
                $("#psubmitbutton1").hide();
            }
            if(prolegaldesclastindex == 2)
            {
                $("#psubmitbutton1").show();
            }
        }

    </script>

<script>

document.addEventListener('DOMContentLoaded', () => {
  const editorInstances = {}; // Object to store CKEditor instances
  const editorContainers = {};
  const ckeditCount = document.getElementById('ckeditEnd').value;

  for (let i = 1; i <= ckeditCount; i++) {
    const containerId = `editorContainer${i}`;
    editorContainers[containerId] = document.getElementById(containerId);
  }

  const editorToggleBtn = document.getElementById('editorToggleBtn');
  const submitNotesBtn = document.getElementById('submitNotes');

  function toggleEditor(containerId) {
    if (editorInstances[containerId]) {
      editorInstances[containerId].destroy();
      editorInstances[containerId] = null;
      editorContainers[containerId].style.display = 'block';
      editorToggleBtn.innerHTML = '<i class="dripicons-pencil" style="font-size:6px"></i>';
      $('#submitNotesContainer').hide();
    } else {
      editorInstances[containerId] = CKEDITOR.replace(editorContainers[containerId], {
        // Configuration options for the CKEditor instance
      });

      editorInstances[containerId].on('instanceReady', () => {
        editorContainers[containerId].style.display = 'none';
        editorToggleBtn.innerHTML = '<i class="dripicons-chevron-right" style="font-size:6px"></i>';
        $('#submitNotesContainer').show();
      });
    }
  }

  editorToggleBtn.addEventListener('click', () => {
    for (let i = 1; i <= ckeditCount; i++) {
      toggleEditor(`editorContainer${i}`);
    }
  });

  submitNotesBtn.addEventListener('click', () => {
    const editorDataArray = Object.keys(editorInstances).map(containerId => {
      if (editorInstances[containerId]) {
        return editorInstances[containerId].getData();
      }
      return null;
    });

    const csrfToken = "{{ csrf_token() }}";
    const orderId = "{{ $orderData[0]->order_id }}";
    const url = "{{url('cert_data_update')}}";

    $.ajax({
      url: url,
      method: 'POST',
      data: {
        data: editorDataArray,
        orderid: orderId,
        count: ckeditCount,
        _token: csrfToken
      },
      success: function (response) {
        // window.location.href = "{{ url('ordercert/' . $orderData[0]->order_id) }}";
        editorToggleBtn.click();
      },
      error: function (error) {
        console.error(error);
      }
    });
  });

});

</script>

{{-- Test Shortcut submit --}}
<script>
    function getNearestSubmitElement(cursorX, cursorY) {
      var nearestElement = null;
      var nearestDistance = Number.MAX_SAFE_INTEGER;
      var elements = $('form, button, input[type="button"]');
      var viewportCenterX = window.innerWidth / 2;
      var viewportCenterY = window.innerHeight / 2;

      elements.each(function() {
        var $this = $(this);
        var elementX = $this.offset().left + $this.outerWidth() / 2;
        var elementY = $this.offset().top + $this.outerHeight() / 2;
        var distance = Math.sqrt(Math.pow(elementX - viewportCenterX, 2) + Math.pow(elementY - viewportCenterY, 2));

        if (distance < nearestDistance) {
          nearestElement = $this;
          nearestDistance = distance;
        }
      });

      return nearestElement;
    }

    function handleKeyCombination(event) {
      if (event.altKey && event.key === 's') {
        var nearestSubmitElement = getNearestSubmitElement();

        if (nearestSubmitElement !== null) {
          if (nearestSubmitElement.is('form')) {
            nearestSubmitElement.submit();
            console.log('Form found');
          } else {
            nearestSubmitElement.click();
            console.log('Submit button found');
          }
        } else {
          console.log('Not found');
        }

        event.preventDefault();
      }
    }

    $(document).on('keydown', handleKeyCombination);
  </script>
    @endsection
