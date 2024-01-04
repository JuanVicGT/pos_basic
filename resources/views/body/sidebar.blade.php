<div class="left-side-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">

                <!-- Accesos directos -->
                <li class="menu-title">Favoritos</li>

                <li>
                    <a href="{{ url('/dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Tablero</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('pos') }}">
                        <!-- <span class="badge bg-pink float-end">POS</span>-->
                        <i class="mdi mdi-cart"></i>
                        <span>POS</span>
                    </a>
                </li>

                <!-- Módulo administación -->
                <li class="menu-title mt-2">Administración</li>

                <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i class="mdi mdi-badge-account-outline"></i>
                        <span>Empleados</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.employee') }}">Lista</a>
                            </li>
                            <li>
                                <a href="{{ route('add.employee') }}">Agregar nuevo</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarSalary" data-bs-toggle="collapse">
                        <i class="mdi mdi-cash-multiple"></i>
                        <span> Salarios </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSalary">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.advance.salary') }}">Agregar adelanto de salario</a>
                            </li>
                            <li>
                                <a href="{{ route('all.advance.salary') }}">Todos los adelantos de salario</a>
                            </li>
                            <li>
                                <a href="{{ route('pay.salary') }}">Pagar salarios</a>
                            </li>
                            <li>
                                <a href="{{ route('month.salary') }}">Ultimo mes pagado</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#attendence" data-bs-toggle="collapse">
                        <i class="mdi mdi-check-underline-circle-outline"></i>
                        <span> Asistencias de Empleados </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="attendence">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('employee.attend.list') }}">Asistencia de Empleados</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span> Gastos </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.expense') }}">Agregar Gasto</a>
                            </li>
                            <li>
                                <a href="{{ route('today.expense') }}">Gastos del dia</a>
                            </li>
                            <li>
                                <a href="{{ route('month.expense') }}">Gastos mensuales</a>
                            </li>
                            <li>
                                <a href="{{ route('year.expense') }}">Gastos anuales</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Módulo inventario -->
                <li class="menu-title mt-2">{{ __('inventory') }}</li>

                <li>
                    <a href="{{ route('all.category') }}">
                        <i class="mdi mdi-shape-plus"></i>
                        <span>{{ __('list-categories') }}</span>
                    </a>
                </li>

                <li>
                    <a href="#product" data-bs-toggle="collapse">
                        <i class="mdi mdi-basket-outline"></i>
                        <span> {{ __('products') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="product">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.product') }}">{{ __('add-product') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('all.product') }}">{{ __('list-products') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('stock.manage') }}">
                        <i class="mdi mdi-counter"></i>
                        <span>{{ __('stock') }}</span>
                    </a>
                </li>

                <!-- Módulo de compras -->
                <li class="menu-title mt-2">{{ __('purchases') }}</li>

                <li>
                    <a href="#sidebarSupplier" data-bs-toggle="collapse">
                        <i class="mdi mdi-truck-fast"></i>
                        <span> {{ __('suppliers') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSupplier">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.supplier') }}">{{ __('add-supplier') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('all.supplier') }}">{{ __('list-suppliers') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#purchases" data-bs-toggle="collapse">
                        <i class="mdi mdi-file-document"></i>
                        <span> {{ __('purchases') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="purchases">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('purchase.pos') }}"> {{ __('add-purchase') }} </a>
                            </li>
                            <li>
                                <a href="{{ route('all.purchase.order') }}"> {{ __('list-purchases') }} </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Módulo de ventas -->
                <li class="menu-title mt-2">{{ __('sales') }}</li>

                <li>
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> {{ __('customers') }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.customer') }}">{{ __('add-customer') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('all.customer') }}">{{ __('list-customers') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('all.order') }}">
                        <i class="mdi mdi-file-document"></i>
                        <span>{{ __('list-sales') }}</span>
                    </a>
                </li>

                <!-- Módulo de reportes -->
                <li class="menu-title mt-2">{{ __('reports') }}</li>

                <li>
                    <a href="{{ route('report.difference') }}">
                        <i class="mdi mdi-ab-testing"></i>
                        <span>{{ __('difference') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Sidebar -->

</div>
<!-- Sidebar -left -->
