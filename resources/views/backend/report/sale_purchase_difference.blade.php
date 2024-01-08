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
                        <h4 class="page-title">{{ __('general-balance') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

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
                                    <td class="text-success">Q {{ number_format($sale->total, 4) }}</td>
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
                                    <td class="text-danger">Q {{ number_format($purchase->total, 4) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @php
                        $total = $saleAmount - $purchaseAmount;
                    @endphp
                    <hr>

                    <div class="row text-center">
                        <table id="report-datatable" class="display table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>{{ __('purchases') }}</th>
                                    <th>{{ __('sales') }}</th>
                                    <th>{{ __('general-balance') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="text-danger">Q {{ number_format($purchaseAmount, 4) }}</td>
                                    <td class="text-success">Q {{ number_format($saleAmount, 4) }}</td>
                                    @if ($total > 0)
                                        <td class="text-success">Q {{ number_format($total, 4) }}</td>
                                    @else
                                        <td class="text-danger">Q {{ number_format($total, 4) }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection
