@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="{{ asset('backend/assets/js/page/general_balance.js') }}"></script>

    @php
        $total = 0.0;
        $saleAmount = 0.0;
        $purchaseAmount = 0.0;
        $expenseAmount = 0.0;
        $incomeAmount = 0.0;
        $balanceGeneral = 0.0;
    @endphp

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="d-print-none mt-2 align-items-center">
                <form action="{{ route('report.difference.search') }}" method="POST">
                    @csrf
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
                        <h4 class="page-title">{{ __('general-balance') }}</h4>
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
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Customer') }} / {{ __('Supplier') }}</th>
                                <th>{{ __('Amount') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cashMovements as $movement)
                                @php
                                    $balanceGeneral += $movement->final_amount;

                                    if ($movement->doc_type == 'purchase') {
                                        $purchaseAmount += $movement->amount;
                                    }
                                    if ($movement->doc_type == 'sale') {
                                        $saleAmount += $movement->amount;
                                    }
                                    if ($movement->doc_type == 'expense') {
                                        $expenseAmount += $movement->amount;
                                    }
                                    if ($movement->doc_type == 'income') {
                                        $incomeAmount += $movement->amount;
                                    }
                                @endphp

                                <tr>
                                    <td>{{ $movement->id }}</td>
                                    <td>{{ $movement->description }}</td>
                                    <td>{{ __($movement->doc_type) }}</td>
                                    <td>{{ $movement->date }}</td>
                                    <td>{{ $movement->getCustomerOrSupplier() }}</td>

                                    @if ($movement->doc_type == 'purchase')
                                        <td class="text-danger text-end">Q {{ number_format($movement->amount, 2) }}</td>
                                    @endif

                                    @if ($movement->doc_type == 'sale')
                                        <td class="text-success text-end">Q {{ number_format($movement->amount, 2) }}</td>
                                    @endif

                                    @if ($movement->doc_type == 'expense')
                                        <td class="text-danger text-end">Q {{ number_format($movement->amount, 2) }}</td>
                                    @endif

                                    @if ($movement->doc_type == 'income')
                                        <td class="text-success text-end">Q {{ number_format($movement->amount, 2) }}</td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <hr>

                    <div class="row text-center">
                        <table id="report-datatable" class="display table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>{{ __('Expenses') }}</th>
                                    <th>{{ __('Incomes') }}</th>
                                    <th>{{ __('Purchases') }}</th>
                                    <th>{{ __('Sales') }}</th>
                                    <th>{{ __('General Balance') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="">Q {{ number_format($expenseAmount, 2) }}</td>
                                    <td class="">Q {{ number_format($incomeAmount, 2) }}</td>
                                    <td class="">Q {{ number_format($purchaseAmount, 2) }}</td>
                                    <td class="">Q {{ number_format($saleAmount, 2) }}</td>
                                    @if ($total > 0)
                                        <td class="text-success">Q {{ number_format($balanceGeneral, 2) }}</td>
                                    @else
                                        <td class="text-danger">Q {{ number_format($balanceGeneral, 2) }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection
