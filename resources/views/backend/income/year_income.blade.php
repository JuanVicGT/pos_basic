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
                                <a href="{{ route('add.income') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Agregar Ingresos</a>
                            </ol>
                        </div>
                        <h4 class="page-title">Ingresos anuales</h4>
                    </div>
                </div>
            </div>

            <!-- end page title -->

            @php
                $incomeyear = App\Models\Income::where('year', $year)->sum('amount');
            @endphp

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
                            <form method="POST" action="{{ route('filter.year.income') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="year" class="form-label">{{ __('year') }}</label>
                                    <input class="only-year-date form-control" id="year" name="year" type="number"
                                        value="{{ $year }}">
                                </div>

                                <div class="text-end">
                                    <button type="submit"
                                        class="btn btn-success waves-effect waves-light mt-2">Filtrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"> Ingresos anuales </h4>
                            <h4 style="color:white; font-size: 30px;" align="center"> Total : Q {{ number_format($incomeyear, 2, '.', ',') }}</h4>
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Detalles</th>
                                        <th>Monto</th>
                                        <th>Año</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($yearincome as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->details }}</td>
                                            <td>Q {{ number_format($item->amount, 2, '.', ',') }}</td>
                                            <td>{{ $item->year }}</td>
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
