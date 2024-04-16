@php
    $advanceSalary = 0.0;
    $pendingSalary = 0.0;
@endphp

@extends('admin_dashboard')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('add.advance.salary') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Agregar adelanto de
                                    salario</a>
                            </ol>
                        </div>
                        <h4 class="page-title">Todos los pagos de salario</h4>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{ __($month) . ' ' . $year }}</h4>

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Mes</th>
                                        <th>Salario</th>
                                        <th>Adelanto</th>
                                        <th>Pendiente</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($employees as $key => $employee)
                                        @php
                                            $due_amount =
                                                $employee->salary -
                                                (($employee['advance']['advance_salary'] ?? 0) +
                                                    ($employee['payment']['paid_amount'] ?? 0));

                                            if ($due_amount < 0) {
                                                $due_amount = 0;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> <img src="{{ asset($employee->image) }}" style="width:50px; height: 40px;">
                                            </td>
                                            <td>{{ $employee->name }}</td>
                                            <td><span class="badge bg-primary"> {{ __(date('F', strtotime('+1 month'))) }}
                                                </span> </td>
                                            <td>Q {{ number_format($employee->salary, 2, '.', ',') }} </td>
                                            <td>
                                                Q
                                                {{ number_format($employee['advance']['advance_salary'] ?? 0, 2, '.', ',') }}
                                            </td>
                                            <td>
                                                <strong style="color: #fff;"> Q
                                                    {{ number_format($due_amount, 2, '.', ',') }}
                                                </strong>
                                            </td>
                                            <td>
                                                @if ($due_amount === 0)
                                                    <button class="btn btn-blue rounded-pill waves-effect waves-light" disabled>Ya
                                                        está pagado</button>
                                                @else
                                                    <a href="{{ route('pay.now.salary', $employee->id) }}"
                                                        class="btn btn-blue rounded-pill waves-effect waves-light">Pagar
                                                        ahora</a>
                                                @endif
                                            </td>
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
@endsection
