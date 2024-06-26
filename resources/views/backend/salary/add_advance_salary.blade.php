@php
    // Get the dates to show in the form
    $currentMonth = date('F');
    $currentYear = date('Y');
    $nextFiveYears = [];
    for ($i = 1; $i <= 5; $i++) {
        $nextFiveYears[] = date('Y', strtotime('+' . $i . ' year'));
    }
@endphp

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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Agregar adelanto de salario</a>
                                </li>

                            </ol>
                        </div>
                        <h4 class="page-title">Agregar adelanto de salario</h4>
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
                                <form method="post" action="{{ route('advance.salary.store') }}">
                                    @csrf
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>Salario</h5>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Nombre</label>
                                                <select name="employee_id"
                                                    class="form-select @error('employee_id') is-invalid @enderror"
                                                    id="example-select">
                                                    <option selected disabled>Seleccione al empleado</option>
                                                    @foreach ($employee as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Mes del salario:</label>
                                                <select name="month"
                                                    class="form-select @error('month') is-invalid @enderror"
                                                    id="example-select">
                                                    <option selected disabled>Selecciona el mes</option>
                                                    <option value="January" @selected($currentMonth === 'December')>Enero</option>
                                                    <option value="February" @selected($currentMonth === 'January')>Febrero</option>
                                                    <option value="March" @selected($currentMonth === 'February')>Marzo</option>
                                                    <option value="April" @selected($currentMonth === 'March')>Abril</option>
                                                    <option value="May" @selected($currentMonth === 'April')>Mayo</option>
                                                    <option value="June" @selected($currentMonth === 'May')>Junio</option>
                                                    <option value="July" @selected($currentMonth === 'June')>Julio</option>
                                                    <option value="August" @selected($currentMonth === 'July')>Agosto</option>
                                                    <option value="September" @selected($currentMonth === 'August')>Septiembre
                                                    </option>
                                                    <option value="October" @selected($currentMonth === 'September')>Octubre</option>
                                                    <option value="November" @selected($currentMonth === 'October')>Noviembre
                                                    </option>
                                                    <option value="December" @selected($currentMonth === 'November')>Diciembre
                                                    </option>
                                                </select>
                                                @error('month')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Año del salario</label>
                                                <select name="year"
                                                    class="form-select @error('year') is-invalid @enderror"
                                                    id="example-select">
                                                    <option selected disabled>Selecciona el año del salario</option>
                                                    <option value="{{ $currentYear }}" selected>{{ $currentYear }}
                                                    </option>
                                                    @foreach ($nextFiveYears as $nextYear)
                                                        <option value="{{ $nextYear }}">{{ $nextYear }}</option>
                                                    @endforeach
                                                </select>
                                                @error('year')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="advance_salary" class="form-label">Adelanto de salario</label>
                                                <input type="number" step="0.01" name="advance_salary"
                                                    value="{{ old('advance_salary', 0) }}"
                                                    class="form-control @error('advance_salary') is-invalid @enderror">
                                                @error('advance_salary')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>
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
@endsection
