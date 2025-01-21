@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ asset('backend/assets/js/page/import_csv.js') }}"></script>

    @php
        $stockBalance = 0;
    @endphp

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="d-print-none mt-2 align-items-center">
                <form action="{{ route('product.movement.search') }}" method="POST">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="start_date">Fecha inicio</label>
                            <input type="date" class="form-control" name="start_date" id="start_date"
                                value="{{ $start_date }}">
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">Fecha fin</label>
                            <input type="date" class="form-control" name="end_date" id="end_date"
                                value="{{ $end_date }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-2 text-center">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <div class="flex gap-2">
                                <button id="export-to-excel" class="btn btn-success waves-effect waves-light"><i
                                        class="mdi mdi-printer me-1">
                                    </i>Exportar xls</button>

                                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                        class="mdi mdi-printer me-1"></i>Imprimir</a>
                            </div>
                        </div>
                        <h4 class="page-title">
                            {{ __('Product Movements :product_name', ['product_name' => $product->product_name]) }}</h4>
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
                    <table id="report-datatable" class="display table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{ __('Id') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Origin') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Stock in moment') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($movements as $movement)
                                @php
                                    $stockBalance += $movement->quantity;
                                @endphp

                                <tr>
                                    <td>{{ $movement->id }}</td>
                                    <td>{{ $movement->detail }}</td>
                                    <td>{{ __($movement->doc_type) }}</td>
                                    <td>{{ $movement->date }}</td>

                                    @if ($movement->quantity > 0)
                                        <td class="text-success">{{ $movement->quantity }}</td>
                                    @else
                                        <td class="text-danger">{{ $movement->quantity }}</td>
                                    @endif

                                    @if ($stockBalance > 0)
                                        <td class="text-success">{{ $stockBalance }}</td>
                                    @elseif ($stockBalance == 0)
                                        <td class="text-warning">{{ $stockBalance }}</td>
                                    @else
                                        <td class="text-danger">{{ $stockBalance }}</td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection
