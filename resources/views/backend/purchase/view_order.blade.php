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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <table class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Codigo</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio</th>
                                                    <th>Total(+IVA)</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($items as $item)
                                                    <tr>
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
