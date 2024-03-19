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
                                <a href="{{ route('pos') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Nueva venta</a>
                            </ol>
                        </div>
                        <h4 class="page-title">{{ __('list-sales') }}</h4>
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
                                        <th>{{ __('image') }}</th>
                                        <th>{{ __('name') }}</th>
                                        <th>{{ __('date') }}</th>
                                        <th>{{ __('payment') }}</th>
                                        <th>{{ __('code') }}</th>
                                        <th>{{ __('amount') }}</th>
                                        <th>{{ __('actions') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($orders as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> <img src="{{ asset($item->customer->image) }}"
                                                    style="width:50px; height: 40px;"> </td>
                                            <td>{{ $item['customer']['name'] }}</td>
                                            <td>{{ $item->order_date }}</td>
                                            <td>{{ $item->payment_status }}</td>
                                            <td>{{ $item->invoice_no }}</td>
                                            <td>{{ $item->pay }}</td>
                                            <td>
                                                <a href="{{ route('order.details', $item->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    {{ __('see') }} </a>
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
