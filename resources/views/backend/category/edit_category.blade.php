@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Editar categoria</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">Editar categoria</h4>
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
                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- end timeline content-->

                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{ route('category.update') }}">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $category->id }}">

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1 "></i> Editar
                                        categoria</h5>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Nombre de la categoria</label>
                                                <input type="text" name="category_name" class="form-control"
                                                    value="{{ $category->category_name }}">

                                            </div>
                                        </div>

                                    </div> <!-- end row -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Guardar</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->

                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
