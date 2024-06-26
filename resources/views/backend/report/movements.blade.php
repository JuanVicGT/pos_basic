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
                                <a href="{{ route('add.product') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">{{ __('add-product') }}</a>
                            </ol>
                        </div>
                        <h4 class="page-title">Stock</h4>
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
                                        <th>{{ __('category') }}</th>
                                        <th>{{ __('code') }}</th>
                                        <th>{{ __('quantity') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($product as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> <img src="{{ asset($item->product_image) }}"
                                                    style="width:50px; height: 40px;"> </td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item['category']['category_name'] }}</td>
                                            <td>{{ $item->product_code }}</td>
                                            <td> <button
                                                    class="btn btn-warning waves-effect waves-light">{{ $item->product_store }}</button>
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
