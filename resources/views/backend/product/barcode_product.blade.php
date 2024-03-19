@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    @php
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    @endphp

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page notifications -->
            @if (Session::has('message'))
                <div class="d-flex justify-content-between {{ Session::get('text-color', 'text-white') }} alert alert-{{ Session::get('alert-type', 'warning') }} fade show"
                    role="alert">
                    {{ Session::get('message') }}
                    <span id="close-alert" class="btn text-white border-0">x</span>
                </div>
            @endif
            <!-- end page notifications -->

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                        class="mdi mdi-printer me-1"></i> Imprimir</a>
                            </ol>
                        </div>
                        <h4 class="page-title">Codigo de barras del producto: {{ $product->product_name }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                @if ($product->barcode)
                    @for ($i = 0; $i < $qty; $i++)
                        <img style="width: 25%; height: 75px; margin-bottom: 35px;" alt="Responsive image"
                            src="{{ 'data:image/png;base64,' . base64_encode($generator->getBarcode($product->barcode, $generator::TYPE_CODE_128)) }}">
                    @endfor
                    @if ($i % 4 === 0)
                        <hr>
                    @endif
                @else
                    <div class="col-lg-8 col-xl-12">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <h3 class="text-6xl"> {{ __('no-have-barcode') }} </h3>
                            </div>
                        </div>
                    </div>
                @endif

            </div> <!-- end row -->

            <!-- end settings content-->
        </div> <!-- end col -->
    </div>
    <!-- end content -->
@endsection
