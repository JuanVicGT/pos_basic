@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ asset('backend/assets/js/page/sale_purchase_difference.js') }}"></script>

    @php
        $total = 0.0;
        $saleAmount = 0.0;
        $purchaseAmount = 0.0;
    @endphp

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                        class="mdi mdi-printer me-1"></i> Imprimir</a>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ __('difference') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <h3>{{ __('difference') }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="report-datatable" class="display table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{ __('number') }}</th>
                                <th>{{ __('type') }}</th>
                                <th>{{ __('date') }}</th>
                                <th>{{ __('customer') }} / {{ __('supplier') }}</th>
                                <th>{{ __('amount') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($sales as $sale)
                                @php
                                    $saleAmount = $saleAmount + $sale->total;
                                @endphp

                                <tr>
                                    <td>{{ $sale->invoice_no }}</td>
                                    <td>{{ __('sale') }}</td>
                                    <td>{{ $sale->order_date }}</td>
                                    <td>{{ $sale->customer->name }}</td>
                                    <td class="text-success">{{ $sale->total }}</td>
                                </tr>
                            @endforeach

                            @foreach ($purchases as $purchase)
                                @php
                                    $purchaseAmount = $purchaseAmount + $purchase->total;
                                @endphp

                                <tr>
                                    <td>{{ $purchase->invoice_no }}</td>
                                    <td>{{ __('purchase') }}</td>
                                    <td>{{ $purchase->order_date }}</td>
                                    <td>{{ $purchase->supplier->name }}</td>
                                    <td class="text-danger">{{ $purchase->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <p>{{ $saleAmount }}</p>
                        <p>{{ $purchaseAmount }}</p>
                        <p>{{ $total }}</p>
                    </div>
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection
