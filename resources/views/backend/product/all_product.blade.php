@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ asset('backend/assets/js/page/all_product.js') }}"></script>

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('add.product') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Agregar producto </a>
                            </ol>
                        </div>
                        <h4 class="page-title">Todos los productos</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Categoria</th>
                                        <th>Codigo</th>
                                        <th>Precio</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($product as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> <img src="{{ asset($item->product_image) }}"
                                                    style="width:50px; height: 40px;"> </td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item['category']['category_name'] }}</td>
                                            <td>{{ $item->product_code }}</td>
                                            <td>{{ $item->selling_price }}</td>
                                            <td>
                                                <a href="{{ route('edit.product', $item->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light">Editar</a>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#barcode-modal" data-target-id="{{ $item->id }}"
                                                    class="btn btn-info rounded-pill waves-effect waves-light">Codigo</button>
                                                <a href="{{ route('delete.product', $item->id) }}"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light"
                                                    id="delete">Eliminar</a </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->
    </div> <!-- content -->


    <!-- Modal to ask the columns and barcodes quantity -->
    <div id="barcode-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center mt-2 mb-4 ">
                        <div class="auth-logo">
                            <h3>{{ __('barcode') }}</h3>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('barcode.product') }}">
                        @csrf

                        <input type="hidden" name="item_id" id="pass_id">

                        <div class="mb-3">
                            <label for="username" class="form-label">{{ __('quantity') }}</label>
                            <input class="form-control" type="number" decimal="0" name="qty">
                        </div>

                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">{{ __('view') }}</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
