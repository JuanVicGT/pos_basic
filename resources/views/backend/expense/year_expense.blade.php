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
                                <a href="{{ route('add.expense') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Agregar gastos</a>
                            </ol>
                        </div>
                        <h4 class="page-title">Gastos anuales</h4>
                    </div>
                </div>
            </div>

            <!-- end page title -->

            @php
                $expenseyear = App\Models\Expense::where('year', $year)->sum('amount');
            @endphp

            <!-- start page notifications -->
            @if (Session::has('message'))
                <div class="d-flex justify-content-between {{ Session::get('text-color', 'text-white') }} alert alert-{{ Session::get('alert-type', 'warning') }} fade show"
                    role="alert">
                    {{ Session::get('message') }}
                    <span id="close-alert" class="btn text-white border-0">x</span>
                </div>
            @endif
            <!-- end page notifications -->

            <div class="row mb-2">
                <div class="col-12">
                    <form action="{{ route('year.expense', 2020) }}" method="get">
                        <input class="only-year-date form-control" id="year" name="year" type="number" value="{{ $year }}">
                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2">Filtrar</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"> Gastos anuales </h4>
                            <h4 style="color:white; font-size: 30px;" align="center"> Total : Q.{{ $expenseyear }}</h4>
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
                                    @foreach ($yearexpense as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->details }}</td>
                                            <td>{{ $item->amount }}</td>
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
