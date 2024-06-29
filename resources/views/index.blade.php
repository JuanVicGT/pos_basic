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
                            <form class="d-flex align-items-center mb-3">
                                <span class="text-white h4">{{ __($currentMonthText) . ' ' . $currentYear }}</span>
                            </form>
                        </div>
                        <h4 class="page-title">{{ __('Resume of month') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-primary border-primary border shadow">
                                        <i class="fe-box font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1">Q <span
                                                data-plugin="counterup">{{ $purchasesTotal }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">{{ __('Total Purchases') }}</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                                        <i class="fe-shopping-cart font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1">Q <span
                                                data-plugin="counterup">{{ $salesTotal }}</span>
                                        </h3>
                                        <p class="text-muted mb-1 text-truncate">{{ __('Total Sales') }}</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                                        <i class="bi-currency-dollar font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1">Q <span
                                                data-plugin="counterup">{{ $dueTotal }}</span>
                                        </h3>
                                        <p class="text-muted mb-1 text-truncate">{{ __('Pending Amount') }}</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                                        <i class="fe-users font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span
                                                data-plugin="counterup">{{ $countNewCustomers }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">{{ __('New Customers') }}</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="float-end d-none d-md-inline-block">
                                <span class="btn btn-xs btn-secondary">{{ __('Top 25') }}</span>
                            </div>

                            <h4 class="header-title mb-3">{{ __('Products with less stock') }}</h4>

                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>{{ __('Code') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Stock') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($products as $item)
                                            <tr>
                                                <td>{{ $item->product_code }}</td>
                                                <td>{{ $item->product_name }}</td>
                                                <td>{{ $item->product_store }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-white">
                                                    {{ __('No data found') }}
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div> <!-- end .table-responsive-->

                            <div dir="ltr">
                                <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
