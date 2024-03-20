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
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Agregar adelanto de salario
                                </a>
                            </ol>
                        </div>
                        <h4 class="page-title">Adelantos de salario</h4>
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
                                        <th>Salario</th>
                                        <th>Adelanto</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($salary as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> <img src="{{ asset($item->employee->image) }}"
                                                    style="width:50px; height: 40px;"> </td>
                                            <td>{{ $item['employee']['name'] }}</td>
                                            <td>{{ __($item->month) }}</td>
                                            <td>Q {{ number_format($item['employee']['salary'], 2, '.', ',') }}</td>
                                            <td>
                                                @if ($item->advance_salary == null)
                                                    <p>{{ __('No Advance') }}</p>
                                                @else
                                                    Q {{ number_format($item->advance_salary, 2, '.', ',') }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.advance.salary', $item->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light">Editar</a>
                                                <a href="{{ route('delete.advance.salary', $item->id) }}"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light"
                                                    id="delete">Eliminar</a>

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
