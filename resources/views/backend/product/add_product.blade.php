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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Agregar producto</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Agregar producto</h4>
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
                <div class="card">
                    <div class="card-body">

                        <!-- end timeline content-->
                        <div class="tab-pane" id="settings">
                            <form id="myForm" method="post" action="{{ route('product.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="col-lg-8 col-xl-12">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>Agregar</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="product_name" class="form-label">Nombre*</label>
                                                <input type="text" name="product_name" class="form-control" autofocus
                                                    value="{{ old('product_name') }}">
                                                @error('product_name')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group mb-3">
                                                <label for="barcode" class="form-label">Código de barras</label>
                                                <input type="text" name="barcode" class="form-control"
                                                    value="{{ old('barcode') }}">
                                                @error('barcode')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Categoria*</label>
                                                <select name="category_id" class="form-select" id="example-select">
                                                    <option selected disabled>Seleccione la categoria</option>
                                                    @foreach ($category as $cat)
                                                        <option value="{{ $cat->id }}" @selected($cat->id == old('category_id'))>
                                                            {{ $cat->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">{{ __('Min Stock') }}*</label>
                                                <input type="number" step="any" name="product_garage"
                                                    class="form-control" value="{{ old('product_garage') }}">
                                                @error('product_garage')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="product_store" class="form-label">{{ __('Stock') }}*</label>
                                                <input type="number" step="any" name="product_store"
                                                    class="form-control" value="{{ old('product_store') }}">
                                                @error('product_store')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="buying_price" class="form-label">Precio Compra*</label>
                                                <input type="number" step="any" name="buying_price"
                                                    class="form-control" value="{{ old('buying_price') }}">
                                                @error('buying_price')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="selling_price" class="form-label">Precio venta*</label>
                                                <input type="number" step="any" name="selling_price"
                                                    class="form-control" value="{{ old('selling_price') }}">
                                                @error('image')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="product_image" class="form-label">Imagen del producto*</label>
                                                <input type="file" name="product_image" id="image"
                                                    class="form-control">
                                                @error('image')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="product_image" class="form-label"> </label>
                                                <img id="showImage" src="{{ url('upload/no_image.jpg') }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Guardar</button>
                                    </div>
                                </div>
                            </form>
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
                    product_name: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    product_garage: {
                        required: true,
                    },
                    product_store: {
                        required: true,
                    },
                    buying_price: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    product_image: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Por favor ingrese el nombre del producto',
                    },
                    category_id: {
                        required: 'Por favor seleccione una categoria',
                    },
                    product_garage: {
                        required: 'Ingrese el almacenamiento',
                    },
                    product_store: {
                        required: 'Ingrese la tienda del producto',
                    },
                    buying_price: {
                        required: 'Ingrese el precio de compra',
                    },
                    selling_price: {
                        required: 'Ingrese el procio de venta',
                    },
                    product_image: {
                        required: 'Seleccione la imagen del producto',
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
