@extends('app.dashboard')

@section('content')
<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content pr-5 pl-5">
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-white text-dark mt-0" style="border-top:4px solid blue">

                        <div class="card-body">
                            <h4> Order Upload  </h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            @if (Session::has("success"))
                                            <h5 class="text ml-4" style="color:#17a2b8">{{Session::get('success')}}
                                            </h5>
                                            @elseif(Session::has("warning"))
                                            <h5 class="text" style="color:#eea23e">{{Session::get('warning')}}
                                            </h5>
                                            @endif
                                            <form method="POST" action="{{route('orders_upload')}}" id="order_upload_form" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row mb-0 pb-0">
                                                    <div class="form-group ml-2 row col-lg-3 col-md-4 col-sm-6">
                                                        <label> Customer Name </label>
                                                        <select class="form-control" name="customer_id" id="customer_id">
                                                            <option selected disabled> Select Customer</option>
                                                            @foreach($Customers as $Customer)
                                                            <option value="{{ $Customer->id }}">
                                                                {{ $Customer->customer_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group ml-2 row col-lg-3 col-md-4 col-sm-6">
                                                        <label> Product Type </label>
                                                        <select class="form-control" name="product_id" id="product_id">
                                                            <option selected disabled> Select Product</option>
                                                            @foreach($ProductTypes as $ProductType)
                                                            <option value="{{ $ProductType->id }}">
                                                                {{ $ProductType->product_type }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group ml-2 row col-lg-3 col-md-4 col-sm-6">
                                                        <label> Upload File </label>
                                                        <input type="file"  class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  name="file" required>
                                                    </div>
                                                </div>
                                                <div class="form-group ml-2 row col-lg-4 col-md-6 col-sm-3">
                                                    <input type="submit" name="Upload" value="Upload" id="submit" class="btn btn-sm btn-success">
                                                    <a href="{{route('orders_upload')}}"
                                                        class="ml-2 btn btn-sm btn-danger">
                                                        Cancel</a>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="p-4 table-responsive">
                                            <table id="datatable" class="table table-bordered nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th> Sl. No. </th>
                                                        <th> Customer Name </th>
                                                        <th> Project Name </th>
                                                        <th> Product </th>
                                                        <th> Count </th>
                                                        <th> Created at </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($Batches as $Batch)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $Batch->customer_name }}</td>
                                                        <td>{{ $Batch->batch_name }}</td>
                                                        <td>{{ $Batch->product_type }}</td>
                                                        <td>{{ $Batch->count }}</td>
                                                        <td>{{ $Batch->created_at }}</td>
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
