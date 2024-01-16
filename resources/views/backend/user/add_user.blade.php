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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Agregar Usuario</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Agregar Usuario</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- end timeline content-->

                            <div class="tab-pane" id="settings">
                                <form id="myForm" method="post" action="{{ route('store.user') }}">
                                    @csrf

                                    <div class="row">

                                        <!-- Name -->
                                        <div class="col-md-6 form-group mt-2">
                                            <x-input-label for="name" :value="__('Name') . '*'" class="form-label" />
                                            <x-text-input id="name" class="form-control" type="text" name="name"
                                                :value="old('name')" required autofocus autocomplete="name" />
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>

                                        <!-- Email Address -->
                                        <div class="col-md-6 form-group mt-2">
                                            <x-input-label for="email" :value="__('Email') . '*'" class="form-label" />
                                            <x-text-input id="email" class="form-control" type="email" name="email"
                                                :value="old('email')" required autocomplete="username" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="col-md-6 form-group mt-2">
                                            <x-input-label for="phone" :value="__('Phone')" class="form-label" />
                                            <x-text-input id="phone" class="form-control" type="text" name="phone"
                                                :value="old('phone')" required autocomplete="phone" />
                                        </div>

                                        <!-- Printer Name -->
                                        <div class="col-md-6 form-group mt-2">
                                            <x-input-label for="printer" :value="__('Name Printer')" class="form-label" />
                                            <x-text-input id="printer" class="form-control" type="text" name="printer"
                                                :value="old('printer')" autocomplete="printer" />
                                        </div>

                                        <!-- Role -->
                                        <div class="col-md-6 form-group mt-2">
                                            <x-input-label for="printer" :value="__('Name Printer')" class="form-label" />
                                            <select class="form-select" aria-label="Default select example">
                                                <option value="caja">One</option>
                                                <option value="encargado">Two</option>
                                                <option value="gerente">Three</option>
                                            </select>
                                            <x-text-input id="printer" class="form-control" type="text" name="printer"
                                                :value="old('printer')" autocomplete="printer" />
                                        </div>

                                    </div> <!-- end row -->

                                    <!-- Checkboxes Section -->
                                    <div class="row">
                                        <!-- Is Admin -->
                                        <div class="col-md-6 form-group mt-2">
                                            <x-input-label for="printer" :value="__('is-admin')" class="form-label" />
                                            <x-text-input id="printer" class="form-control" type="text" name="printer"
                                                :value="old('printer')" autocomplete="printer" />
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
