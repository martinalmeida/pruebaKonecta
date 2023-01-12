<!DOCTYPE html>
<html lang="ES">

<head>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <meta name="description" content="Introduction">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="{{ asset('/build/css/vendors.bundle.css') }}">
    <link id='appbundle' rel='stylesheet' media='screen, print' href="{{ asset('/build/css/app.bundle.css') }}">
    <link id='mytheme' rel='stylesheet' media='screen, print' href='#'>
    <link id='myskin' rel='stylesheet' media='screen, print' href="{{ asset('/build/css/skins/skin-master.css') }}">
    <link rel='apple-touch-icon' sizes='180x180' href="{{ asset('/build/img/favicon/apple-touch-icon.png') }}">
    <link rel='icon' type='image/png' sizes='32x32' href="{{ asset('/build/img/favicon/favicon-32x32.png') }}">
    <link rel='mask-icon' href="{{ asset('/build/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel='stylesheet' media='screen, print'
        href="{{ asset('/build/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel='stylesheet' media='screen, print' href="{{ asset('/build/css/fa-solid.css') }}">
    <link rel='stylesheet' media='screen, print'
        href="{{ asset('/build/css/formplugins/select2/select2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
        href="{{ asset('/build/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('/build/css/notifications/toastr/toastr.css') }}">
</head>

<body class="mod-bg-1 mod-nav-link ">
    <script src="{{ asset('/js/configApp.js') }}"></script>
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            <aside class="page-sidebar">
                <div class="page-logo">
                    <a href="/inicio"
                        class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                        <img src="{{ asset('/build/img/logo.png') }}" alt="SmartAdmin WebApp"
                            aria-roledescription="logo">
                        <span class="page-logo-text mr-1">Konecta ®</span>
                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION -->
                <nav id="js-primary-nav" class="primary-nav" role="navigation">
                    <div class="info-card">
                        <img src="{{ asset('/build/img/logo.png') }}" class="profile-image rounded-circle">
                        <div class="info-card-text">
                            <a href="#" class="d-flex align-items-center text-white">
                                <span class="text-truncate text-truncate-sm d-inline-block">
                                    {{ auth()->user()->name }}
                                </span>
                            </a>
                            <span class="d-inline-block text-truncate text-truncate-sm">@
                                {{ auth()->user()->name }}</span>
                        </div>
                        <img src="{{ asset('/build/img/card-backgrounds/banner.png') }}" class="cover" alt="cover">
                    </div>
                    <ul id="js-nav-menu" class="nav-menu">

                        <li class="nav-title">Menu Prueba</li>

                        <li class="{{ $routeActive == 'home' ? 'active' : '' }}">
                            <a href="/inicio" title="Inicio de plataforma" data-filter-tags="category">
                                <i class="fal fa-house"></i>
                                <span class="nav-link-text" data-i18n="nav.category">Inicio</span>
                            </a>
                        </li>
                        <li
                            class="{{ $routeActive == 'producto' ? 'active open' : '' }}
                                {{ $routeActive == 'asignar' ? 'active open' : '' }}
                                {{ $routeActive == 'roles' ? 'active open' : '' }}">

                            <a href="#" title="Inventario" data-filter-tags="category">
                                <i class="fal fa-user-cog"></i>
                                <span class="nav-link-text" data-i18n="nav.category">Inventario</span>
                            </a>
                            <ul>
                                <li class="{{ $routeActive == 'producto' ? 'active' : '' }}">
                                    <a href="/productos" title="Productos del Inventario"
                                        data-filter-tags="utilities disabled item">
                                        <span class="nav-link-text"
                                            data-i18n="nav.utilities_menu_child_another_item">Productos</span>
                                    </a>
                                </li>
                                <li class="{{ $routeActive == 'asignar' ? 'active' : '' }}">
                                    <a href="/asignar" title="Administrar stoks de productos"
                                        data-filter-tags="utilities disabled item">
                                        <span class="nav-link-text"
                                            data-i18n="nav.utilities_menu_child_another_item">Administrar Stoks</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ $routeActive == 'informes' ? 'active' : '' }}">
                            <a href="/informes" title="Venta de productos en stock" data-filter-tags="category">
                                <i class="fal fa-file-chart-line"></i>
                                <span class="nav-link-text" data-i18n="nav.category">Venta de Productos</span>
                            </a>
                        </li>
                    </ul>
                    <div class="filter-message js-filter-message bg-success-600"></div>
                </nav>
                <!-- END PRIMARY NAVIGATION -->
            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <header class="page-header" role="banner">
                    <!-- we need this logo when user switches to nav-function-top -->
                    <div class="page-logo">
                        <a href="#"
                            class="page-logo-link press-scale-down d-flex align-items-center position-relative"
                            data-toggle="modal" data-target="#modal-shortcut">
                            <img src="{{ asset('/build/img/logo.png') }}" alt="SmartAdmin WebApp"
                                aria-roledescription="logo">
                            <span class="page-logo-text mr-1">LOGO</span>
                            <span
                                class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                        </a>
                    </div>
                    <!-- DOC: nav menu layout change shortcut -->
                    <div class="hidden-md-down dropdown-icon-menu position-relative">
                        <a href="#" class="header-btn btn js-waves-off" data-action="toggle"
                            data-class="nav-function-minify" title="Minimizar Menu">
                            <i class="ni ni-menu"></i>
                        </a>
                    </div>
                    <!-- DOC: mobile button appears during mobile width -->
                    <div class="hidden-lg-up">
                        <a href="#" class="header-btn btn press-scale-down" data-action="toggle"
                            data-class="mobile-nav-on">
                            <i class="ni ni-menu"></i>
                        </a>
                    </div>
                    <div class="ml-auto d-flex">
                        <!-- app settings -->
                        <div class="hidden-md-down">
                            <a href="#" class="header-icon" data-toggle="modal"
                                data-target=".js-modal-settings">
                                <i class="fal fa-cog"></i>
                            </a>
                        </div>
                        <div>
                            <a href="#" data-toggle="dropdown"
                                class="header-icon d-flex align-items-center justify-content-center ml-2">
                                <img src="{{ asset('/build/img/logo.png') }}" class="profile-image rounded-circle"
                                    alt="Dr. Codex Lantern">
                                <!-- you can also add username next to the avatar with the codes below:
                                            <span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
                                            <i class="ni ni-chevron-down hidden-xs-down"></i> -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                        <span class="mr-2">
                                            <img src="{{ asset('/build/img/logo.png') }}"
                                                class="rounded-circle profile-image" alt="Dr. Codex Lantern">
                                        </span>
                                        <div class="info-card-text">
                                            <div class="fs-lg text-truncate text-truncate-lg">
                                                {{ auth()->user()->name }}</div>
                                            <span
                                                class="text-truncate text-truncate-md opacity-80">{{ auth()->user()->email }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider m-0"></div>
                                <a href="#" class="dropdown-item" data-action="app-reset">
                                    <span data-i18n="drpdwn.reset_layout">Reset Plataforma</span>
                                </a>
                                <a href="#" class="dropdown-item" data-toggle="modal"
                                    data-target=".js-modal-settings">
                                    <span data-i18n="drpdwn.settings">Ajustes</span>
                                </a>
                                <div class="dropdown-divider m-0"></div>
                                <a href="#" class="dropdown-item" data-action="app-fullscreen">
                                    <span data-i18n="drpdwn.fullscreen">Pantalla Completa</span>
                                    <i class="float-right text-muted fw-n">F11</i>
                                </a>
                                <a href="#" class="dropdown-item" data-action="app-print">
                                    <span data-i18n="drpdwn.print">Imprimir</span>
                                    <i class="float-right text-muted fw-n">Ctrl + P</i>
                                </a>
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item fw-500 pt-3 pb-3" href="/logout">
                                    <span data-i18n="drpdwn.page-logout">Salir</span>
                                    <span class="float-right fw-n">@ {{ auth()->user()->name }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- END Page Header -->
                <!-- BEGIN Page Content -->
                <!-- the #js-page-content id is needed for some plugins to initialize -->
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="position-absolute pos-top pos-left d-none d-sm-block"><span
                                class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader"></div>

                    <!-- ========== Inicio Componente de Vista ========== -->
                    @yield('head')

                    <div class="row">

                        @yield('content')

                    </div>

                    <h3>
                        @yield('subName')
                    </h3>
                    <!-- ========== Fin Componente de Vista ========== -->

                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <footer class="page-footer" role="contentinfo">
                    <div class="d-flex align-items-center flex-1 text-muted">
                        <span class="hidden-md-down fw-700">2022 © KONECTA</span>
                    </div>
                    <div>
                        <ul class="list-table m-0">
                            <li class="pl-3"><a target="_blank" href="https://choosealicense.com/licenses/mit/"
                                    class="text-secondary fw-700">Licencia</a></li>
                        </ul>
                    </div>
                </footer>

                <p id="js-color-profile" class="d-none">
                    <span class="color-primary-50"></span>
                    <span class="color-primary-100"></span>
                    <span class="color-primary-200"></span>
                    <span class="color-primary-300"></span>
                    <span class="color-primary-400"></span>
                    <span class="color-primary-500"></span>
                    <span class="color-primary-600"></span>
                    <span class="color-primary-700"></span>
                    <span class="color-primary-800"></span>
                    <span class="color-primary-900"></span>
                    <span class="color-info-50"></span>
                    <span class="color-info-100"></span>
                    <span class="color-info-200"></span>
                    <span class="color-info-300"></span>
                    <span class="color-info-400"></span>
                    <span class="color-info-500"></span>
                    <span class="color-info-600"></span>
                    <span class="color-info-700"></span>
                    <span class="color-info-800"></span>
                    <span class="color-info-900"></span>
                    <span class="color-danger-50"></span>
                    <span class="color-danger-100"></span>
                    <span class="color-danger-200"></span>
                    <span class="color-danger-300"></span>
                    <span class="color-danger-400"></span>
                    <span class="color-danger-500"></span>
                    <span class="color-danger-600"></span>
                    <span class="color-danger-700"></span>
                    <span class="color-danger-800"></span>
                    <span class="color-danger-900"></span>
                    <span class="color-warning-50"></span>
                    <span class="color-warning-100"></span>
                    <span class="color-warning-200"></span>
                    <span class="color-warning-300"></span>
                    <span class="color-warning-400"></span>
                    <span class="color-warning-500"></span>
                    <span class="color-warning-600"></span>
                    <span class="color-warning-700"></span>
                    <span class="color-warning-800"></span>
                    <span class="color-warning-900"></span>
                    <span class="color-success-50"></span>
                    <span class="color-success-100"></span>
                    <span class="color-success-200"></span>
                    <span class="color-success-300"></span>
                    <span class="color-success-400"></span>
                    <span class="color-success-500"></span>
                    <span class="color-success-600"></span>
                    <span class="color-success-700"></span>
                    <span class="color-success-800"></span>
                    <span class="color-success-900"></span>
                    <span class="color-fusion-50"></span>
                    <span class="color-fusion-100"></span>
                    <span class="color-fusion-200"></span>
                    <span class="color-fusion-300"></span>
                    <span class="color-fusion-400"></span>
                    <span class="color-fusion-500"></span>
                    <span class="color-fusion-600"></span>
                    <span class="color-fusion-700"></span>
                    <span class="color-fusion-800"></span>
                    <span class="color-fusion-900"></span>
                </p>
            </div>
        </div>
    </div>
    <nav class="shortcut-menu d-none d-sm-block">
        <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
        <label for="menu_open" class="menu-open-button ">
            <span class="app-shortcut-icon d-block"></span>
        </label>
        <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Arriba">
            <i class="fal fa-arrow-up"></i>
        </a>
        <a href="/logout" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Salir">
            <i class="fal fa-sign-out"></i>
        </a>
        <a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip"
            data-placement="left" title="Pantalla Completa">
            <i class="fal fa-expand"></i>
        </a>
        <a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left"
            title="Imprimir Pagina">
            <i class="fal fa-print"></i>
        </a>
    </nav>
    <!-- END Quick Menu -->
    <!-- BEGIN Messenger -->
    <div class="modal fade js-modal-messenger modal-backdrop-transparent" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-right">
            <div class="modal-content h-100">
                <div class="dropdown-header bg-trans-gradient d-flex align-items-center w-100">
                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                        <span class="mr-2">
                            <span class="rounded-circle profile-image d-block"
                                style="background-image:url('{{ asset('/build/img/demo/avatars/avatar-d.png') }}'); background-size: cover;"></span>
                        </span>
                        <div class="info-card-text">
                            <a href="javascript:void(0);" class="fs-lg text-truncate text-truncate-lg text-white"
                                data-toggle="dropdown" aria-expanded="false">
                                Tracey Chang
                                <i class="fal fa-angle-down d-inline-block ml-1 text-white fs-md"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Send Email</a>
                                <a class="dropdown-item" href="#">Create Appointment</a>
                                <a class="dropdown-item" href="#">Block User</a>
                            </div>
                            <span class="text-truncate text-truncate-md opacity-80">IT Director</span>
                        </div>
                    </div>
                    <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body p-0 h-100 d-flex">
                    <!-- BEGIN msgr-list -->
                    <div
                        class="msgr-list d-flex flex-column bg-faded border-faded border-top-0 border-right-0 border-bottom-0 position-absolute pos-top pos-bottom">
                        <div>
                            <div
                                class="height-4 width-3 h3 m-0 d-flex justify-content-center flex-column color-primary-500 pl-3 mt-2">
                                <i class="fal fa-search"></i>
                            </div>
                            <input type="text" class="form-control bg-white" id="msgr_listfilter_input"
                                placeholder="Filter contacts" aria-label="FriendSearch"
                                data-listfilter="#js-msgr-listfilter">
                        </div>
                        <div class="flex-1 h-100 custom-scroll">
                            <div class="w-100">
                                <ul id="js-msgr-listfilter" class="list-unstyled m-0">
                                    <li>
                                        <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white"
                                            data-filter-tags="tracey chang online">
                                            <div class="d-table-cell align-middle status status-success status-sm ">
                                                <span class="profile-image-md rounded-circle d-block"
                                                    style="background-image:url('{{ asset('/build/img/demo/avatars/avatar-d.png') }}'); background-size: cover;"></span>
                                            </div>
                                            <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                <div class="text-truncate text-truncate-md">
                                                    Tracey Chang
                                                    <small class="d-block font-italic text-success fs-xs">
                                                        Online
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white"
                                            data-filter-tags="oliver kopyuv online">
                                            <div class="d-table-cell align-middle status status-success status-sm ">
                                                <span class="profile-image-md rounded-circle d-block"
                                                    style="background-image:url('{{ asset('/build/img/demo/avatars/avatar-b.png') }}'); background-size: cover;"></span>
                                            </div>
                                            <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                <div class="text-truncate text-truncate-md">
                                                    Oliver Kopyuv
                                                    <small class="d-block font-italic text-success fs-xs">
                                                        Online
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white"
                                            data-filter-tags="dr john cook phd away">
                                            <div class="d-table-cell align-middle status status-warning status-sm ">
                                                <span class="profile-image-md rounded-circle d-block"
                                                    style="background-image:url('{{ asset('/build/img/demo/avatars/avatar-e.png') }}'); background-size: cover;"></span>
                                            </div>
                                            <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                <div class="text-truncate text-truncate-md">
                                                    Dr. John Cook PhD
                                                    <small class="d-block font-italic fs-xs">
                                                        Away
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white"
                                            data-filter-tags="ali amdaney online">
                                            <div class="d-table-cell align-middle status status-success status-sm ">
                                                <span class="profile-image-md rounded-circle d-block"
                                                    style="background-image:url('{{ asset('/build/img/demo/avatars/avatar-g.png') }}'); background-size: cover;"></span>
                                            </div>
                                            <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                <div class="text-truncate text-truncate-md">
                                                    Ali Amdaney
                                                    <small class="d-block font-italic fs-xs text-success">
                                                        Online
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white"
                                            data-filter-tags="sarah mcbrook online">
                                            <div class="d-table-cell align-middle status status-success status-sm">
                                                <span class="profile-image-md rounded-circle d-block"
                                                    style="background-image:url('{{ asset('/build/img/demo/avatars/avatar-h.png') }}'); background-size: cover;"></span>
                                            </div>
                                            <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                <div class="text-truncate text-truncate-md">
                                                    Sarah McBrook
                                                    <small class="d-block font-italic fs-xs text-success">
                                                        Online
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white"
                                            data-filter-tags="ali amdaney offline">
                                            <div class="d-table-cell align-middle status status-sm">
                                                <span class="profile-image-md rounded-circle d-block"
                                                    style="background-image:url('{{ asset('/build/img/demo/avatars/avatar-a.png') }}'); background-size: cover;"></span>
                                            </div>
                                            <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                <div class="text-truncate text-truncate-md">
                                                    oliver.kopyuv@gotbootstrap.com
                                                    <small class="d-block font-italic fs-xs">
                                                        Offline
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white"
                                            data-filter-tags="ali amdaney busy">
                                            <div class="d-table-cell align-middle status status-danger status-sm">
                                                <span class="profile-image-md rounded-circle d-block"
                                                    style="background-image:url('{{ asset('/build/img/demo/avatars/avatar-j.png') }}'); background-size: cover;"></span>
                                            </div>
                                            <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                <div class="text-truncate text-truncate-md">
                                                    oliver.kopyuv@gotbootstrap.com
                                                    <small class="d-block font-italic fs-xs text-danger">
                                                        Busy
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white"
                                            data-filter-tags="ali amdaney offline">
                                            <div class="d-table-cell align-middle status status-sm">
                                                <span class="profile-image-md rounded-circle d-block"
                                                    style="background-image:url('{{ asset('/build/img/demo/avatars/avatar-c.png') }}'); background-size: cover;"></span>
                                            </div>
                                            <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                <div class="text-truncate text-truncate-md">
                                                    oliver.kopyuv@gotbootstrap.com
                                                    <small class="d-block font-italic fs-xs">
                                                        Offline
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white"
                                            data-filter-tags="ali amdaney inactive">
                                            <div class="d-table-cell align-middle">
                                                <span class="profile-image-md rounded-circle d-block"
                                                    style="background-image:url('{{ asset('/build/img/demo/avatars/avatar-m.png') }}'); background-size: cover;"></span>
                                            </div>
                                            <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                <div class="text-truncate text-truncate-md">
                                                    +714651347790
                                                    <small class="d-block font-italic fs-xs opacity-50">
                                                        Missed Call
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="filter-message js-filter-message"></div>
                            </div>
                        </div>
                        <div>
                            <a class="fs-xl d-flex align-items-center p-3">
                                <i class="fal fa-cogs"></i>
                            </a>
                        </div>
                    </div>
                    <!-- END msgr-list -->
                    <!-- BEGIN msgr -->
                    <div class="msgr d-flex h-100 flex-column bg-white">
                        <!-- BEGIN custom-scroll -->
                        <div class="custom-scroll flex-1 h-100">
                            <div id="chat_container" class="w-100 p-4">
                                <!-- start .chat-segment -->
                                <div class="chat-segment">
                                    <div class="time-stamp text-center mb-2 fw-400">
                                        Jun 19
                                    </div>
                                </div>
                                <!--  end .chat-segment -->
                                <!-- start .chat-segment -->
                                <div class="chat-segment chat-segment-sent">
                                    <div class="chat-message">
                                        <p>
                                            Hey Tracey, did you get my files?
                                        </p>
                                    </div>
                                    <div class="text-right fw-300 text-muted mt-1 fs-xs">
                                        3:00 pm
                                    </div>
                                </div>
                                <!--  end .chat-segment -->
                                <!-- start .chat-segment -->
                                <div class="chat-segment chat-segment-get">
                                    <div class="chat-message">
                                        <p>
                                            Hi
                                        </p>
                                        <p>
                                            Sorry going through a busy time in office. Yes I analyzed the solution.
                                        </p>
                                        <p>
                                            It will require some resource, which I could not manage.
                                        </p>
                                    </div>
                                    <div class="fw-300 text-muted mt-1 fs-xs">
                                        3:24 pm
                                    </div>
                                </div>
                                <!--  end .chat-segment -->
                                <!-- start .chat-segment -->
                                <div class="chat-segment chat-segment-sent chat-start">
                                    <div class="chat-message">
                                        <p>
                                            Okay
                                        </p>
                                    </div>
                                </div>
                                <!--  end .chat-segment -->
                                <!-- start .chat-segment -->
                                <div class="chat-segment chat-segment-sent chat-end">
                                    <div class="chat-message">
                                        <p>
                                            Sending you some dough today, you can allocate the resources to this
                                            project.
                                        </p>
                                    </div>
                                    <div class="text-right fw-300 text-muted mt-1 fs-xs">
                                        3:26 pm
                                    </div>
                                </div>
                                <!--  end .chat-segment -->
                                <!-- start .chat-segment -->
                                <div class="chat-segment chat-segment-get chat-start">
                                    <div class="chat-message">
                                        <p>
                                            Perfect. Thanks a lot!
                                        </p>
                                    </div>
                                </div>
                                <!--  end .chat-segment -->
                                <!-- start .chat-segment -->
                                <div class="chat-segment chat-segment-get">
                                    <div class="chat-message">
                                        <p>
                                            I will have them ready by tonight.
                                        </p>
                                    </div>
                                </div>
                                <!--  end .chat-segment -->
                                <!-- start .chat-segment -->
                                <div class="chat-segment chat-segment-get chat-end">
                                    <div class="chat-message">
                                        <p>
                                            Cheers
                                        </p>
                                    </div>
                                </div>
                                <!--  end .chat-segment -->
                                <!-- start .chat-segment for timestamp -->
                                <div class="chat-segment">
                                    <div class="time-stamp text-center mb-2 fw-400">
                                        Jun 20
                                    </div>
                                </div>
                                <!--  end .chat-segment for timestamp -->
                            </div>
                        </div>
                        <!-- END custom-scroll  -->
                        <!-- BEGIN msgr__chatinput -->
                        <div class="d-flex flex-column">
                            <div
                                class="border-faded border-right-0 border-bottom-0 border-left-0 flex-1 mr-3 ml-3 position-relative shadow-top">
                                <div class="pt-3 pb-1 pr-0 pl-0 rounded-0" tabindex="-1">
                                    <div id="msgr_input" contenteditable="true"
                                        data-placeholder="Type your message here..."
                                        class="height-10 form-content-editable"></div>
                                </div>
                            </div>
                            <div class="height-8 px-3 d-flex flex-row align-items-center flex-wrap flex-shrink-0">
                                <a href="javascript:void(0);" class="btn btn-icon fs-xl width-1 mr-1"
                                    data-toggle="tooltip" data-original-title="More options" data-placement="top">
                                    <i class="fal fa-ellipsis-v-alt color-fusion-300"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip"
                                    data-original-title="Attach files" data-placement="top">
                                    <i class="fal fa-paperclip color-fusion-300"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip"
                                    data-original-title="Insert photo" data-placement="top">
                                    <i class="fal fa-camera color-fusion-300"></i>
                                </a>
                                <div class="ml-auto">
                                    <a href="javascript:void(0);" class="btn btn-info">Send</a>
                                </div>
                            </div>
                        </div>
                        <!-- END msgr__chatinput -->
                    </div>
                    <!-- END msgr -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Messenger -->
    <!-- BEGIN Page Settings -->
    <div class="modal fade js-modal-settings modal-backdrop-transparent" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-right modal-md">
            <div class="modal-content">
                <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center w-100">
                    <h4 class="m-0 text-center color-white">
                        Opciones de diseño
                        <small class="mb-0 opacity-80">Configuración de la interfaz de usuario</small>
                    </h4>
                    <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="settings-panel">
                        <div class="mt-4 d-table w-100 px-5">
                            <div class="d-table-cell align-middle">
                                <h5 class="p-0">
                                    Diseño de la aplicación
                                </h5>
                            </div>
                        </div>
                        <div class="list" id="fh">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="header-function-fixed"></a>
                            <span class="onoffswitch-title">Encabezado fijo</span>
                            <span class="onoffswitch-title-desc">el encabezado está en un fijo en todo momento</span>
                        </div>
                        <div class="list" id="nff">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="nav-function-fixed"></a>
                            <span class="onoffswitch-title">Navegación fija</span>
                            <span class="onoffswitch-title-desc">el panel izquierdo está fijo</span>
                        </div>
                        <div class="list" id="nfm">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="nav-function-minify"></a>
                            <span class="onoffswitch-title">Minimizar navegación</span>
                            <span class="onoffswitch-title-desc">navegación sesgada para maximizar el espacio</span>
                        </div>
                        <div class="list" id="nfh">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="nav-function-hidden"></a>
                            <span class="onoffswitch-title">Ocultar navegación</span>
                            <span class="onoffswitch-title-desc">haga rodar el mouse sobre el borde para revelar</span>
                        </div>
                        <div class="list" id="nft">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="nav-function-top"></a>
                            <span class="onoffswitch-title">Navegación superior</span>
                            <span class="onoffswitch-title-desc">reubicar el panel izquierdo en la parte
                                superior</span>
                        </div>
                        <div class="list" id="fff">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="footer-function-fixed"></a>
                            <span class="onoffswitch-title">Pie de página fijo</span>
                            <span class="onoffswitch-title-desc">el pie de página es fijo</span>
                        </div>
                        <div class="list" id="mmb">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-main-boxed"></a>
                            <span class="onoffswitch-title">Diseño en caja</span>
                            <span class="onoffswitch-title-desc">encapsula a un contenedorr</span>
                        </div>
                        <div class="expanded">
                            <ul class="mb-3 mt-1">
                                <li>
                                    <div class="bg-fusion-50" data-action="toggle" data-class="mod-bg-1"></div>
                                </li>
                                <li>
                                    <div class="bg-warning-200" data-action="toggle" data-class="mod-bg-2"></div>
                                </li>
                                <li>
                                    <div class="bg-primary-200" data-action="toggle" data-class="mod-bg-3"></div>
                                </li>
                                <li>
                                    <div class="bg-success-300" data-action="toggle" data-class="mod-bg-4"></div>
                                </li>
                                <li>
                                    <div class="bg-white border" data-action="toggle" data-class="mod-bg-none"></div>
                                </li>
                            </ul>
                            <div class="list" id="mbgf">
                                <a href="#" onclick="return false;" class="btn btn-switch"
                                    data-action="toggle" data-class="mod-fixed-bg"></a>
                                <span class="onoffswitch-title">fondo fijo</span>
                            </div>
                        </div>
                        <div class="mt-4 d-table w-100 px-5">
                            <div class="d-table-cell align-middle">
                                <h5 class="p-0">
                                    Menú móvil
                                </h5>
                            </div>
                        </div>
                        <div class="list" id="nmp">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="nav-mobile-push"></a>
                            <span class="onoffswitch-title">Empujar contenido</span>
                            <span class="onoffswitch-title-desc">Contenido empujado en el menú revelado</span>
                        </div>
                        <div class="list" id="nmno">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="nav-mobile-no-overlay"></a>
                            <span class="onoffswitch-title">Sin superposición</span>
                            <span class="onoffswitch-title-desc">elimina la malla en el menú revelado</span>
                        </div>
                        <div class="list" id="sldo">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="nav-mobile-slide-out"></a>
                            <span class="onoffswitch-title">fuera del lienzo <sup>(beta)</sup></span>
                            <span class="onoffswitch-title-desc">Menú de superposición de contenido</span>
                        </div>
                        <div class="mt-4 d-table w-100 px-5">
                            <div class="d-table-cell align-middle">
                                <h5 class="p-0">
                                    Accesibilidad
                                </h5>
                            </div>
                        </div>
                        <div class="list" id="mbf">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-bigger-font"></a>
                            <span class="onoffswitch-title">Fuente de contenido más grande</span>
                            <span class="onoffswitch-title-desc">las fuentes de contenido son más grandes para
                                facilitar la lectura</span>
                        </div>
                        <div class="list" id="mhc">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-high-contrast"></a>
                            <span class="onoffswitch-title">Texto de alto contraste (WCAG 2 AA)</span>
                            <span class="onoffswitch-title-desc">4.5:1 relación de contraste de texto</span>
                        </div>
                        <div class="list" id="mcb">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-color-blind"></a>
                            <span class="onoffswitch-title">Daltonismo <sup>(beta)</sup> </span>
                            <span class="onoffswitch-title-desc">deficiencia de la visión del color</span>
                        </div>
                        <div class="list" id="mpc">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-pace-custom"></a>
                            <span class="onoffswitch-title">Precargador interior</span>
                            <span class="onoffswitch-title-desc">el precargador estará dentro del contenido</span>
                        </div>
                        <div class="list" id="mpi">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-panel-icon"></a>
                            <span class="onoffswitch-title">Iconos de SmartPanel (no paneles)</span>
                            <span class="onoffswitch-title-desc">los botones del panel inteligente aparecerán como
                                iconos</span>
                        </div>
                        <div class="mt-4 d-table w-100 px-5">
                            <div class="d-table-cell align-middle">
                                <h5 class="p-0">
                                    Modificaciones globales
                                </h5>
                            </div>
                        </div>
                        <div class="list" id="mcbg">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-clean-page-bg"></a>
                            <span class="onoffswitch-title">Limpiar el fondo de la página</span>
                            <span class="onoffswitch-title-desc">agrega más espacios en blanco</span>
                        </div>
                        <div class="list" id="mhni">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-hide-nav-icons"></a>
                            <span class="onoffswitch-title">Ocultar iconos de navegación</span>
                            <span class="onoffswitch-title-desc">iconos de navegación invisibles</span>
                        </div>
                        <div class="list" id="dan">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-disable-animation"></a>
                            <span class="onoffswitch-title">Deshabilitar animación CSS</span>
                            <span class="onoffswitch-title-desc">Animaciones basadas en CSS deshabilitadas</span>
                        </div>
                        <div class="list" id="mhic">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-hide-info-card"></a>
                            <span class="onoffswitch-title">Ocultar tarjeta de información</span>
                            <span class="onoffswitch-title-desc">oculta la tarjeta de información del panel
                                izquierdo</span>
                        </div>
                        <div class="list" id="mlph">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-lean-subheader"></a>
                            <span class="onoffswitch-title">Subheader magro</span>
                            <span class="onoffswitch-title-desc">encabezado de página distinguido</span>
                        </div>
                        <div class="list" id="mnl">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-nav-link"></a>
                            <span class="onoffswitch-title">Navegación jerárquica</span>
                            <span class="onoffswitch-title-desc">Desglose claro de enlaces de navegación</span>
                        </div>
                        <div class="list" id="mdn">
                            <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle"
                                data-class="mod-nav-dark"></a>
                            <span class="onoffswitch-title">Navegación oscura</span>
                            <span class="onoffswitch-title-desc">El fondo de navegación está oscuro</span>
                        </div>
                        <hr class="mb-0 mt-4">
                        <div class="mt-4 d-table w-100 pl-5 pr-3">
                            <div class="d-table-cell align-middle">
                                <h5 class="p-0">
                                    Tamaño de fuente global
                                </h5>
                            </div>
                        </div>
                        <div class="list mt-1">
                            <div class="btn-group btn-group-sm btn-group-toggle my-2" data-toggle="buttons">
                                <label class="btn btn-default btn-sm" data-action="toggle-swap"
                                    data-class="root-text-sm" data-target="html">
                                    <input type="radio" name="changeFrontSize"> SM
                                </label>
                                <label class="btn btn-default btn-sm" data-action="toggle-swap"
                                    data-class="root-text" data-target="html">
                                    <input type="radio" name="changeFrontSize" checked=""> MD
                                </label>
                                <label class="btn btn-default btn-sm" data-action="toggle-swap"
                                    data-class="root-text-lg" data-target="html">
                                    <input type="radio" name="changeFrontSize"> LG
                                </label>
                                <label class="btn btn-default btn-sm" data-action="toggle-swap"
                                    data-class="root-text-xl" data-target="html">
                                    <input type="radio" name="changeFrontSize"> XL
                                </label>
                            </div>
                            <span class="onoffswitch-title-desc d-block mb-0">Cambio <strong>root</strong> tamaño de
                                fuente para efecto rem
                                valores (se restablece al actualizar la página)</span>
                        </div>
                        <hr class="mb-0 mt-4">
                        <div class="mt-4 d-table w-100 pl-5 pr-3">
                            <div class="d-table-cell align-middle">
                                <h5 class="p-0 pr-2 d-flex">
                                    colores del tema
                                </h5>
                            </div>
                        </div>
                        <div class="expanded theme-colors pl-5 pr-3">
                            <ul class="m-0">
                                <li>
                                    <a href="#" id="myapp-0" data-action="theme-update" data-themesave
                                        data-theme="" data-toggle="tooltip" data-placement="top"
                                        title="Wisteria (base css)" data-original-title="Wisteria (base css)"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-1" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-1.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Tapestry"
                                        data-original-title="Tapestry"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-2" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-2.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Atlantis"
                                        data-original-title="Atlantis"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-3" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-3.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Indigo"
                                        data-original-title="Indigo"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-4" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-4.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Dodger Blue"
                                        data-original-title="Dodger Blue"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-5" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-5.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Tradewind"
                                        data-original-title="Tradewind"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-6" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-6.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Cranberry"
                                        data-original-title="Cranberry"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-7" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-7.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Oslo Gray"
                                        data-original-title="Oslo Gray"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-8" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-8.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Chetwode Blue"
                                        data-original-title="Chetwode Blue"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-9" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-9.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Apricot"
                                        data-original-title="Apricot"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-10" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-10.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Blue Smoke"
                                        data-original-title="Blue Smoke"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-11" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-11.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Green Smoke"
                                        data-original-title="Green Smoke"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-12" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-12.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Wild Blue Yonder"
                                        data-original-title="Wild Blue Yonder"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-13" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-13.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Emerald"
                                        data-original-title="Emerald"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-14" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-14.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Supernova"
                                        data-original-title="Supernova"></a>
                                </li>
                                <li>
                                    <a href="#" id="myapp-15" data-action="theme-update" data-themesave
                                        data-theme="{{ asset('/build/css/themes/cust-theme-15.css') }}"
                                        data-toggle="tooltip" data-placement="top" title="Hoki"
                                        data-original-title="Hoki"></a>
                                </li>
                            </ul>
                        </div>
                        <hr class="mb-0 mt-4">
                        <div class="mt-4 d-table w-100 pl-5 pr-3">
                            <div class="d-table-cell align-middle">
                                <h5 class="p-0 pr-2 d-flex">
                                    Modos de tema
                                </h5>
                            </div>
                        </div>
                        <div class="pl-5 pr-3 py-3">
                            <div class="ie-only alert alert-warning d-none">
                                <h6>Problema de Internet Explorer</h6>
                                Es posible que este componente en particular no funcione como se esperaba en Internet
                                Explorer. Úselo con precaución.
                            </div>
                            <div class="row no-gutters">
                                <div class="col-4 pr-2 text-center">
                                    <div id="skin-default" data-action="toggle-replace"
                                        data-replaceclass="mod-skin-light mod-skin-dark" data-class=""
                                        data-toggle="tooltip" data-placement="top" title=""
                                        class="d-flex bg-white border border-primary rounded overflow-hidden text-success js-waves-on"
                                        data-original-title="Default Mode" style="height: 80px">
                                        <div
                                            class="bg-primary-600 bg-primary-gradient px-2 pt-0 border-right border-primary">
                                        </div>
                                        <div class="d-flex flex-column flex-1">
                                            <div class="bg-white border-bottom border-primary py-1"></div>
                                            <div class="bg-faded flex-1 pt-3 pb-3 px-2">
                                                <div class="py-3"
                                                    style="background:url('{{ asset('/build/img/demo/s-1.png') }}') top left no-repeat;background-size: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    Normal
                                </div>
                                <div class="col-4 px-1 text-center">
                                    <div id="skin-light" data-action="toggle-replace"
                                        data-replaceclass="mod-skin-dark" data-class="mod-skin-light"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        class="d-flex bg-white border border-secondary rounded overflow-hidden text-success js-waves-on"
                                        data-original-title="Light Mode" style="height: 80px">
                                        <div class="bg-white px-2 pt-0 border-right border-"></div>
                                        <div class="d-flex flex-column flex-1">
                                            <div class="bg-white border-bottom border- py-1"></div>
                                            <div class="bg-white flex-1 pt-3 pb-3 px-2">
                                                <div class="py-3"
                                                    style="background:url('{{ asset('/build/img/demo/s-1.png') }}') top left no-repeat;background-size: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    Blanco
                                </div>
                                <div class="col-4 pl-2 text-center">
                                    <div id="skin-dark" data-action="toggle-replace"
                                        data-replaceclass="mod-skin-light" data-class="mod-skin-dark"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        class="d-flex bg-white border border-dark rounded overflow-hidden text-success js-waves-on"
                                        data-original-title="Dark Mode" style="height: 80px">
                                        <div class="bg-fusion-500 px-2 pt-0 border-right"></div>
                                        <div class="d-flex flex-column flex-1">
                                            <div class="bg-fusion-600 border-bottom py-1"></div>
                                            <div class="bg-fusion-300 flex-1 pt-3 pb-3 px-2">
                                                <div class="py-3 opacity-30"
                                                    style="background:url('{{ asset('/build/img/demo/s-1.png') }}') top left no-repeat;background-size: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    Negro
                                </div>
                            </div>
                        </div>
                        <hr class="mb-0 mt-4">
                        <div class="pl-5 pr-3 py-3 bg-faded">
                            <div class="row no-gutters">
                                <div class="col-6 pr-1">
                                    <a href="#" class="btn btn-outline-danger fw-500 btn-block"
                                        data-action="app-reset">Reiniciar ajustes</a>
                                </div>
                                <div class="col-6 pl-1">
                                    <a href="#" class="btn btn-danger fw-500 btn-block"
                                        data-action="factory-reset">Restablecimiento</a>
                                </div>
                            </div>
                        </div>
                    </div> <span id="saving"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Settings -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="{{ asset('/js/vendors.bundle.js') }}"></script>
    <script src="{{ asset('/js/app.bundle.js') }}"></script>
    <script src="{{ asset('/js/notifications/toastr/toastr.js') }}"></script>
    <script src="{{ asset('/js/formplugins/select2/select2.bundle.js') }}"></script>
    <script src="{{ asset('/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
    <script src="{{ asset('/js/notifications/sweetalert2/sweetalert2@9.js') }}"></script>
    <script src="{{ asset('/js/validaciones.js') }}"></script>
    <script src="{{ asset('/js/datagrid/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('/js/datagrid/datatables/datatables.export.js') }}"></script>
    @yield('script')
</body>

</html>
