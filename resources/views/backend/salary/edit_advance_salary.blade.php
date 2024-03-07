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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Editar adelanto de salario</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Editar adelanto de salario</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="{{ Session::get('text-color', 'text-white') }} alert alert-{{ Session::get('alert-type') }}">
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                            <!-- end timeline content-->

                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{ route('advance.salary.update') }}">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $salary->id }}">

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Editar</h5>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Nombre empleado</label>
                                                <select name="employee_id"
                                                    class="form-select @error('employee_id') is-invalid @enderror"
                                                    id="example-select">
                                                    <option selected disabled>Seleccione al empleado</option>
                                                    @foreach ($employee as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $salary->employee_id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
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
                                                    <option value="January" @selected($salary->month === 'January')>Enero</option>
                                                    <option value="February" @selected($salary->month === 'February')>Febrero</option>
                                                    <option value="March" @selected($salary->month === 'March')>Marzo</option>
                                                    <option value="April" @selected($salary->month === 'April')>Abril</option>
                                                    <option value="May" @selected($salary->month === 'May')>Mayo</option>
                                                    <option value="June" @selected($salary->month === 'June')>Junio</option>
                                                    <option value="July" @selected($salary->month === 'July')>Julio</option>
                                                    <option value="August" @selected($salary->month === 'August')>Agosto</option>
                                                    <option value="September" @selected($salary->month === 'September')>Septiembre
                                                    </option>
                                                    <option value="October" @selected($salary->month === 'October')>Octubre</option>
                                                    <option value="November" @selected($salary->month === 'November')>Noviembre
                                                    </option>
                                                    <option value="December" @selected($salary->month === 'December')>Diciembre
                                                    </option>
                                                </select>
                                                @error('month')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Salary Year </label>
                                                <select name="year"
                                                    class="form-select @error('year') is-invalid @enderror"
                                                    id="example-select">
                                                    <option selected disabled>Select Year </option>
                                                    <option value="2022" {{ $salary->year == '2022' ? 'selected' : '' }}>
                                                        2022</option>
                                                    <option value="2023" {{ $salary->year == '2023' ? 'selected' : '' }}>
                                                        2023</option>
                                                    <option value="2024" {{ $salary->year == '2024' ? 'selected' : '' }}>
                                                        2024</option>
                                                    <option value="2025" {{ $salary->year == '2025' ? 'selected' : '' }}>
                                                        2025</option>
                                                    <option value="2026" {{ $salary->year == '2026' ? 'selected' : '' }}>
                                                        2026</option>
                                                </select>
                                                @error('year')
                                                    <span class="text-danger"> {{ $message }} </span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Advance Salary </label>
                                                <input type="text" name="advance_salary"
                                                    class="form-control @error('advance_salary') is-invalid @enderror"
                                                    value="{{ $salary->advance_salary }}">
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
