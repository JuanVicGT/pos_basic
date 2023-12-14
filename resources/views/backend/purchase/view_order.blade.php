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
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Compra</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Compra</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane" id="settings">

                                <!-- ORDER HEADER -->
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <x-input-label :value="__('supplier')" class="form-label" />
                                        <x-text-input class="form-control" type="text" :value="$order->supplier->name" readonly />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <x-input-label :value="__('code')" class="form-label" />
                                        <x-text-input class="form-control" type="text" :value="$order->invoice_no" readonly />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <x-input-label :value="__('created-at')" class="form-label" />
                                        <x-text-input class="form-control" type="text" :value="$order->created_at" readonly />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <x-input-label :value="__('date')" class="form-label" />
                                        <x-text-input class="form-control" type="text" :value="$order->order_date" readonly />
                                    </div>

                                    <div class="col-md-12 mb-6">
                                        <x-input-label :value="__('total')" class="form-label" />
                                        <x-text-input class="form-control" type="text" :value="'Q ' . $order->total" readonly />
                                    </div>

                                </div> <!-- end row -->
                            </div>
                            <!-- end settings content-->

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <table class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Codigo</th>
                                                    <th>Cantidad</th>
                                                    <th>Costo</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($items as $item)
                                                    <tr>
                                                        <td>{{ $item->product->product_name }}</td>
                                                        <td>{{ $item->product->product_code }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->product->buying_price }}</td>
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
