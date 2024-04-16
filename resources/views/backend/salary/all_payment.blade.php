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
                        <h4 class="page-title">Pagos realizados</h4>
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

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Mes</th>
                                        <th>Adelanto</th>
                                        <th>Salario</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($payments as $key => $pay)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> <img src="{{ asset($pay->employee->image) }}"
                                                    style="width:50px; height: 40px;"> </td>
                                            <td>{{ $pay['employee']['name'] }}</td>
                                            <td>{{ __($pay->month) }}</td>
                                            <td>{{ $pay['employee']['advance']['advance_salary'] ?? 0 }}</td>
                                            <td>{{ $pay['employee']['salary'] }}</td>
                                            <td><span class="badge bg-success fs-5 lh-base"> PAGADO </span> </td>
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
