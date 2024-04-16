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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pagar salario</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Pagar salario</h4>
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
                                <form method="post" action="{{ route('employe.salary.store') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $employee->id }}">
                                    <input type="hidden" name="year" value="{{ $year }}">

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Pagar</h5>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Nombre empleado: </label>
                                                <strong style="color: #fff;">{{ $employee->name }}</strong>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Mes:</label>
                                                <strong style="color: #fff;">{{ __($month) }}</strong>
                                                <input type="hidden" name="month" value="{{ $month }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Salario:</label>
                                                <strong style="color: #fff;">Q
                                                    {{ number_format($employee->salary, 2, '.', ',') }}</strong>
                                                <input type="hidden" name="paid_amount" value="{{ $employee->salary }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Adelanto de salario:</label>
                                                <strong style="color: #fff;">Q
                                                    {{ number_format($employee['advance']['advance_salary'], 2, '.', ',') }}</strong>
                                                <input type="hidden" name="advance_salary"
                                                    value="{{ $employee['advance']['advance_salary'] }}">
                                            </div>
                                        </div>

                                        @php
                                            $due_amount =
                                                $employee->salary -
                                                (($employee['advance']['advance_salary'] ?? 0) +
                                                    ($employee['payment']['paid_amount'] ?? 0));
                                        @endphp

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Total a pagar:</label>
                                                <strong style="color: #fff;">
                                                    @if ($employee->advance->advance_salary == null)
                                                        <span>No Salary</span>
                                                    @else
                                                        Q {{ number_format($due_amount, 2, '.', ',') }}
                                                    @endif
                                                </strong>
                                                <input type="hidden" name="due_salary" value="{{ round($due_amount) }}">
                                            </div>
                                        </div>
                                    </div> <!-- end row -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i>Pagar salario</button>
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
