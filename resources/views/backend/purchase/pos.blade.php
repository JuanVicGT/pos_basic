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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ingreso de compra</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Ingreso de compra</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- start page notifications -->
            @if (Session::has('message'))
                <div class="d-flex justify-content-between fade show alert alert-{{ Session::get('alert-type', 'warning') }} {{ Session::get('text-color', 'text-white') }}"
                    role="alert">
                    <span class="h-full align-middle">{{ Session::get('message') }}</span>
                    <a href="#" id="close-alert" class="text-white border-0">x</a>
                </div>
            @endif
            <!-- end page notifications -->

            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>SubTotal</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $allcart = Cart::instance('purchase')->content();
                                    @endphp
                                    <tbody>
                                        @foreach ($allcart as $cart)
                                            <tr>
                                                <td>{{ $cart->name }}</td>
                                                <td>
                                                    <form method="post"
                                                        action="{{ route('purchase.cart.update', $cart->rowId) }}">
                                                        @csrf
                                                        <input type="number" name="qty" value="{{ $cart->qty }}"
                                                            style="width:40px;" min="1">
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            style="margin-top:-2px ;"> <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>{{ $cart->price }}</td>
                                                <td>{{ $cart->price * $cart->qty }}</td>

                                                <td> <a href="{{ route('purchase.cart.remove', $cart->rowId) }}"><i
                                                            class="fas fa-trash-alt" style="color:#ffffff"></i></a> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="bg-primary">
                                <br>
                                <p style="font-size:18px; color:#fff"> Cantidad : {{ Cart::instance('purchase')->count() }}
                                </p>
                                <p style="font-size:18px; color:#fff"> SubTotal :
                                    {{ Cart::instance('purchase')->subtotal() }} </p>
                                <p style="font-size:18px; color:#fff"> Impuestos : {{ Cart::instance('purchase')->tax() }}
                                </p>
                                <p>
                                <h2 class="text-white"> Total </h2>
                                <h1 class="text-white"> {{ Cart::instance('purchase')->total() }}</h1>
                                </p>
                                <br>
                            </div>
                            <br>
                            <form id="myForm" method="post" action="{{ route('purchase.create.invoice') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="firstname" class="form-label">Proveedores</label>
                                    <a href="{{ route('add.supplier') }}"
                                        class="btn btn-primary rounded-pill waves-effect waves-light mb-2">Agregar
                                        proveedor</a>
                                    <select name="supplier_id" class="form-select" id="example-select">
                                        <option selected disabled>Selecciona al proveedor</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ $supplier->id === old('supplier_id') ? 'checked' : '' }}>
                                                {{ $supplier->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <button class="btn btn-blue waves-effect waves-light">Crear Factura</button>
                            </form>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col-->
                <div class="col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">

                            <!-- end timeline content-->
                            <div class="tab-pane" id="settings">
                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>{{ __('No') }}</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Description') }}</th>
                                            <th>{{ __('Stock') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($product as $key => $item)
                                            <tr>
                                                <form method="post" action="{{ route('purchase.add.cart') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="name" value="{{ $item->product_name }}">
                                                    <input type="hidden" name="qty" value="1">
                                                    <input type="hidden" name="cost" value="{{ $item->buying_price }}">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td> <img src="{{ asset($item->product_image) }}"
                                                            style="width:50px; height: 40px;"> </td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>{{ $item->product_store }}</td>
                                                    <td><button type="submit" style="font-size: 20px; color: #000;"> <i
                                                                class="fas fa-plus-square"></i> </button> </td>

                                                </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end settings content-->
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row-->
        </div> <!-- container -->
    </div> <!-- content -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    supplier_id: {
                        required: true,
                    },

                },
                messages: {
                    supplier_id: {
                        required: 'Debe seleccionar a un proveedor',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
