@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);"> {{ __('proof-of-purchase') }} </a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title"> {{ __('proof-of-purchase') }} </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- start page notifications -->
            @if (Session::has('message'))
                <div class="d-flex justify-content-between {{ Session::get('text-color', 'text-white') }} alert alert-{{ Session::get('alert-type', 'warning') }} fade show"
                    role="alert">
                    {{ Session::get('message') }}
                    <span id="close-alert" class="btn text-white border-0">x</span>
                </div>
            @endif
            <!-- end page notifications -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div
                                    class="{{ Session::get('text-color', 'text-white') }} alert alert-{{ Session::get('alert-type') }}">
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                            <!-- Logo & title -->
                            <div class="clearfix">
                                <div class="float-start">
                                    <h4 class="m-0 d-print-none">{{ __('customer') }}</h4>
                                </div>
                                <div class="float-end">
                                    <h4 class="m-0 d-print-none">{{ __('proof-of-purchase') }}</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-3 float-start">
                                        <p><strong>{{ __('name') }}: </strong> <span class="float-end">
                                                &nbsp;&nbsp;&nbsp;&nbsp; {{ $customer->name }}</span></p>
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-4 offset-md-2">
                                    <div class="mt-3 float-end">
                                        <p><strong>{{ __('date') }}: </strong> <span>
                                                &nbsp;&nbsp;&nbsp;&nbsp; {{ $order->order_date }}</span></p>
                                        <p><strong>{{ __('number') }}: </strong> <span>{{ $order->invoice_no }} </span>
                                        </p>
                                    </div>
                                </div><!-- end col -->
                            </div>

                            <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4 table-centered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Producto</th>
                                                    <th style="width: 10%">Cantidad</th>
                                                    <th style="width: 10%">Costo unitario</th>
                                                    <th style="width: 10%" class="text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $sl = 1;
                                                @endphp

                                                @foreach ($contents as $key => $item)
                                                    <tr>
                                                        <td>{{ $sl++ }}</td>
                                                        <td>
                                                            <b>{{ $item->name }}</b> <br />

                                                        </td>
                                                        <td>{{ $item->qty }}</td>
                                                        <td>{{ $item->price }}</td>
                                                        <td class="text-end">Q. {{ $item->price * $item->qty }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive -->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="float-end">
                                        <h3>Total: Q {{ Cart::total() }}</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="mt-4 mb-1">
                                <div class="text-end d-print-none">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#signup-modal">Crear factura </button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->

    <!-- Signup modal content -->
    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center mt-2 mb-4 ">
                        <div class="auth-logo">
                            <h3>{{ __('customer') }}: {{ $customer->name }}</h3>
                            <h3>{{ __('total-amount') }}: Q {{ Cart::total() }}</h3>
                        </div>
                    </div>

                    <form class="px-3" method="post" action="{{ url('/final-invoice') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label">{{ __('Payment') }}</label>
                            <select name="payment_status" class="form-select" id="example-select">
                                <option selected disabled>{{ __('Select Payment') }}</option>

                                <option value="HandCash">{{ __('handcash') }}</option>
                                <option value="Card">{{ __('card') }}</option>
                                <option value="Cheque">{{ __('cheque') }}</option>
                                <option value="Deposit">{{ __('deposit') }}</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">{{ __('amount') }}</label>
                            <input class="form-control" type="text" name="pay" placeholder="{{ __('amount') }}">
                        </div>

                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                        <input type="hidden" name="order_date" value="{{ $order->order_date }}">
                        <input type="hidden" name="invoice_no" value="{{ $order->invoice_no }}">

                        <input type="hidden" name="total_products" value="{{ (int) Cart::count() }}">
                        <input type="hidden" name="sub_total"
                            value="{{ number_format((float) Cart::subtotal(6, '.', ''), 6) }}">
                        <input type="hidden" name="tax" value="{{ number_format((float) Cart::tax(6, '.', ''), 6) }}">
                        <input type="hidden" name="total"
                            value="{{ number_format((float) Cart::total(6, '.', ''), 6) }}">

                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">{{ __('complete') }}</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
