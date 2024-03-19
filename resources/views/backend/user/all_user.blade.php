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
                                <a href="{{ route('add.user') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Nuevo Usuario</a>
                            </ol>
                        </div>
                        <h4 class="page-title">Listado de usuarios</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- start page notifications -->
            @if (Session::has('message'))
                <div class="d-flex justify-content-between {{ Session::get('text-color', 'text-white') }} alert alert-{{ Session::get('alert-type', 'warning') }} fade show"
                    role="alert">
                    {{ Session::get('message') }}
                    <span id="close-alert" class="btn text-white border-0">x</span>
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
                                        <th>{{ __('id') }}</th>
                                        <th>{{ __('username') }}</th>
                                        <th>{{ __('name') }}</th>
                                        <th>{{ __('actions') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <a href="{{ route('edit.user', $user->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    {{ __('edit') }} </a>
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
