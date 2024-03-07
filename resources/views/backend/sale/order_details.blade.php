@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <a href="{{ route('ticket.order', $order->id) }}"
                                class="btn btn-primary waves-effect waves-light my-2">
                                <i class="mdi mdi-printer me-1"></i>{{ __('print-ticket') }}
                            </a>

                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light my-2">
                                <i class="mdi mdi-printer me-1"></i>{{ __('print-pdf') }}
                            </a>
                        </div>
                        <h4 class="page-title">{{ __('proof-of-purchase') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="{{ Session::get('text-color', 'text-white') }} alert alert-{{ Session::get('alert-type') }}">
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                            <!-- end timeline content-->

                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{ route('order.status.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        {{ __('proof-of-purchase') }}</h5>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">{{ __('customer') }}</label>
                                                <p class="text-danger"> {{ $order->customer->name }} </p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">{{ __('date') }}</label>
                                                <p class="text-danger"> {{ date('d-m-Y', strtotime($order->order_date)) }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">{{ __('number') }}</label>
                                                <p class="text-danger"> {{ $order->invoice_no }} </p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">{{ __('amount') }}</label>
                                                <p class="text-success">Q {{ number_format($order->pay, 2, '.', ',') }} </p>
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                </form>
                            </div>
                            <!-- end settings content-->

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                        <table class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Nombre</th>
                                                    <th>Codigo</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio</th>
                                                    <th>Total(+IVA)</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($orderItem as $item)
                                                    <tr>

                                                        <td> <img src="{{ asset($item->product->product_image) }}"
                                                                style="width:50px; height: 40px;"> </td>
                                                        <td>{{ $item->product->product_name }}</td>
                                                        <td>{{ $item->product->product_code }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->product->selling_price }}</td>
                                                        <td>{{ $item->total }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->

                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row-->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection
