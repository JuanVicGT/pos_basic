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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Agregar Proveedor</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Agregar Proveedor</h4>
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

                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- end timeline content-->

                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{ route('supplier.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Agregar
                                        Proveedor</h5>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Nombre*</label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    :value="old('firstname')">
                                                @error('name')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Email*</label>
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    :value="old('email')">
                                                @error('email')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Teléfono*</label>
                                                <input type="text" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    :value="old('phone')">
                                                @error('phone')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Dirección*</label>
                                                <input type="text" name="address"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    :value="old('address')">
                                                @error('address')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Tienda del proveedor*</label>
                                                <input type="text" name="shopname"
                                                    class="form-control @error('shopname') is-invalid @enderror"
                                                    :value="old('shopname')">
                                                @error('shopname')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Tipo de proveedor*</label>
                                                <select name="type"
                                                    class="form-select @error('type') is-invalid @enderror"
                                                    id="example-select">
                                                    <option selected disabled>Selecciona el tipo</option>
                                                    <option value="Distribuidor">Distribuidor</option>
                                                    <option value="Vendedor Independiente<">Vendedor Independiente</option>
                                                </select>
                                                @error('type')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Titular de cuenta*</label>
                                                <input type="text" name="account_holder"
                                                    class="form-control @error('account_holder') is-invalid @enderror"
                                                    :value="old('account_holder')">
                                                @error('account_holder')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Número de cuenta*</label>
                                                <input type="text" name="account_number"
                                                    class="form-control @error('account_number') is-invalid @enderror"
                                                    :value="old('account_number')">
                                                @error('account_number')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Banco</label>
                                                <input type="text" name="bank_name"
                                                    class="form-control @error('bank_name') is-invalid @enderror"
                                                    :value="old('bank_name')">
                                                @error('bank_name')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Banco opcional</label>
                                                <input type="text" name="bank_branch"
                                                    class="form-control @error('bank_branch') is-invalid @enderror"
                                                    :value="old('bank_branch')">
                                                @error('bank_branch')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Ciudad*</label>
                                                <input type="text" name="city"
                                                    class="form-control @error('city') is-invalid @enderror"
                                                    :value="old('city')">
                                                @error('city')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Imagen*</label>
                                                <input type="file" name="image" id="image"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    :value="old('image')">
                                                @error('image')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label"> </label>
                                                <img id="showImage" src="{{ url('upload/no_image.jpg') }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </div>
                                        </div> <!-- end col -->

                                    </div> <!-- end row -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Guardar</button>
                                    </div>
                                </form>
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
