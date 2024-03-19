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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Editar Empleado</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Editar Empleado</h4>
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
                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- end timeline content-->

                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{ route('employee.update') }}" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $employee->id }}">

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>Editar
                                        Empleado</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Nombre</label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ $employee->name }}">
                                                @error('name')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Correo</label>
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ $employee->email }}">
                                                @error('email')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Teléfono</label>
                                                <input type="text" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ $employee->phone }}">
                                                @error('phone')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Dirección</label>
                                                <input type="text" name="address"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    value="{{ $employee->address }}">
                                                @error('address')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Experience </label>
                                                <select name="experience"
                                                    class="form-select @error('experience') is-invalid @enderror"
                                                    id="example-select">
                                                    <option selected disabled>Indique el tiempo</option>
                                                    <option value="1 Year"
                                                        {{ $employee->experience == '1 Year' ? 'selected' : '' }}>1 Año
                                                    </option>
                                                    <option value="2 Year"
                                                        {{ $employee->experience == '2 Year' ? 'selected' : '' }}>2 Años
                                                    </option>
                                                    <option value="3 Year"
                                                        {{ $employee->experience == '3 Year' ? 'selected' : '' }}>3 Años
                                                    </option>
                                                    <option value="4 Year"
                                                        {{ $employee->experience == '4 Year' ? 'selected' : '' }}>4 Años
                                                    </option>
                                                    <option value="5 Year"
                                                        {{ $employee->experience == '5 Year' ? 'selected' : '' }}>5 Años
                                                    </option>
                                                    <option value="+5 Year"
                                                        {{ $employee->experience == '+5 Year' ? 'selected' : '' }}>+5 Años
                                                    </option>
                                                </select>
                                                @error('experience')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Salario</label>
                                                <input type="text" name="salary"
                                                    class="form-control @error('salary') is-invalid @enderror"
                                                    value="{{ $employee->salary }}">
                                                @error('salary')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Vacaciones</label>
                                                <input type="text" name="vacation"
                                                    class="form-control @error('vacation') is-invalid @enderror"
                                                    value="{{ $employee->vacation }}">
                                                @error('vacation')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Ciudad</label>
                                                <input type="text" name="city"
                                                    class="form-control @error('city') is-invalid @enderror"
                                                    value="{{ $employee->city }}">
                                                @error('city')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>




                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Imagen</label>
                                                <input type="file" name="image" id="image"
                                                    class="form-control @error('image') is-invalid @enderror">
                                                @error('image')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label"> </label>
                                                <img id="showImage" src="{{ asset($employee->image) }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </div>
                                        </div> <!-- end col -->



                                    </div> <!-- end row -->



                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Save</button>
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
