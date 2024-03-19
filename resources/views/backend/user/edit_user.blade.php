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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Editar Usuario</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Editar Usuario</h4>
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
                                <form method="post" action="{{ route('update.user') }}">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $user->id }}">

                                    <div class="row">

                                        <!-- UserName -->
                                        <div class="col-md-4 form-group mt-2">
                                            <x-input-label for="username" :value="__('Username') . '*'" class="form-label" />
                                            <x-text-input id="username" class="form-control" type="text" name="username"
                                                :value="old('username', $user->username)" required autofocus />
                                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                        </div>

                                        <!-- Name -->
                                        <div class="col-md-4 form-group mt-2">
                                            <x-input-label for="name" :value="__('Name')" class="form-label" />
                                            <x-text-input id="name" class="form-control" type="text" name="name"
                                                :value="old('name', $user->name)" required />
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>

                                        <!-- Email Address -->
                                        <div class="col-md-4 form-group mt-2">
                                            <x-input-label for="email" :value="__('Email') . '*'" class="form-label" />
                                            <x-text-input id="email" class="form-control" type="email" name="email"
                                                :value="old('email', $user->email)" required autocomplete="email" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="col-md-4 form-group mt-2">
                                            <x-input-label for="phone" :value="__('Phone')" class="form-label" />
                                            <x-text-input id="phone" class="form-control" type="text" name="phone"
                                                :value="old('phone', $user->phone)" required autocomplete="phone" />
                                        </div>

                                        <!-- Printer Name -->
                                        <div class="col-md-4 form-group mt-2">
                                            <x-input-label for="printer" :value="__('Name Printer')" class="form-label" />
                                            <x-text-input id="printer" class="form-control" type="text" name="printer"
                                                :value="old('printer', $user->printer)" autocomplete="printer" />
                                        </div>

                                        <!-- Role -->
                                        <div class="col-md-4 form-group mt-2">
                                            <x-input-label for="role" :value="__('Role')" class="form-label" />
                                            <select name="role" class="form-select" aria-label="Default select example">
                                                <option value="caja" @selected(old('role', $role) === 'caja' || empty(old('role')))>
                                                    Caja</option>
                                                <option value="encargado" @selected(old('role', $role) === 'encargado')>
                                                    Encargado</option>
                                                <option value="gerente" @selected(old('role', $role) === 'gerente')>
                                                    Gerente</option>
                                            </select>
                                        </div>

                                    </div> <!-- end row -->

                                    <!-- Checkboxes Section -->
                                    <div class="row">
                                        <!-- Is Admin -->
                                        <div class="col-md-6 form-group mt-2">
                                            <input id="admin" class="form-check-input" type="checkbox" name="admin"
                                                value="1" @checked(old('admin', $user->admin)) />
                                            <x-input-label for="admin" :value="__('is-admin')" class="form-check-label" />
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
