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
                            <h4 class="header-title">{{ date('F Y') }}</h4>

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
                                    @foreach ($employee as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> <img src="{{ asset($item->image) }}" style="width:50px; height: 40px;">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td><span class="badge bg-primary"> {{ __(date('F', strtotime('+1 month'))) }}
                                                </span> </td>
                                            <td> {{ $item->salary }} </td>
                                            {{ $item->month = date('F', strtotime('+1 month')) }}
                                            @foreach ($item->advanceByMonth as $advance)
                                                {{ $advanceSalary += $advance->advance_salary }};
                                            @endforeach
                                            <td>
                                                Q {{ $advanceSalary }}
                                            </td>
                                            <td>
                                                @php
                                                    $amount = $item->salary - $advanceSalary;
                                                @endphp
                                                <strong style="color: #fff;"> Q {{ round($amount, 4) }} </strong>
                                            </td>
                                            <td>
                                                <a href="{{ route('pay.now.salary', $item->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light">Pagar
                                                    ahora</a>
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
