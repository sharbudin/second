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
                            <h4> Product Types </h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="p-4 table-responsive">
                                            <table id="datatable" class="table table-bordered nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 20%"> Sl. No. </th>
                                                        <th class="text-center"> User Type </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($ProductTypes as $ProductType)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $ProductType->product_type }}</td>
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
