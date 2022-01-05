<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flare Editor -
        @hasSection('pageTitle')
            @yield('pageTitle')
        @else
            Master Layout
        @endif
    </title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flareeditor/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flareeditor/scrollbar.css') }}">
    @hasSection('headerLinks')
        @yield('headerLinks')
    @endif
</head>
@php
//Seleciona O Menu lateral
if (!isset($menuSelectPath)) {
    $menuSelectPath = ['categ' => 'none', 'submenu' => 'none'];
}
if (!isset($usePreloader)) {
    $usePreloader = false;
}

if (!isset($noSidebarElevation)) {
    $noSidebarElevation = false;
}
if (!isset($fixedFooter)){
    $fixedFooter = true;
}
if (!isset($fixedNavbar)){
    $fixedNavbar = true;
}
@endphp


<body class="hold-transition sidebar-mini layout-fixed @if($fixedFooter)layout-footer-fixed  @endif @if($fixedNavbar)layout-navbar-fixed @endif">
    <div class="wrapper">
        @if($usePreloader)
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center" style="background-color: #333333">
                <img class="animation__shake" src="{{ asset('img/logo-flare-w.png') }}" alt="Flare Logo" height="175" width="300">
            </div>
        @endif
        <!-- Navbar -->
        <nav
            class="main-header navbar navbar-expand flareeditor-navbar-orange navbar-dark flareeditor-navbar-bottom-border">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('modelo.create') }}" class="nav-link" data-toggle="tooltip" data-placement="top"
                        title="Criar novo modelo de email">Novo Modelo</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('instrucoes') }}" class="nav-link" data-toggle="tooltip" data-placement="top"
                        title="Sobre o Flare Editor">Sobre</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Side Menu">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> -->
                <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Log Out">
                    <a class="nav-link" href="#" onclick="document.querySelector('#form-logout').submit()">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline" id="form-logout" method="POST" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </div>
                </li>
                <!-- Fullscreen Button -->
                <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Tela Cheia">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary @if($noSidebarElevation == false) elevation-4 @endif">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="{{ asset('img/logo-flare-o.png') }}" alt="FlareEditor Logo" class="brand-image"
                    height="32px" width="32px" style="opacity: .8">
                <span class="brand-text font-weight-light" style="color: #ff4500;">Flare Editor</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="{{ route('dashboard') }}" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('servico.index') }}" class="nav-link @if ($menuSelectPath['categ'] == 'none' && $menuSelectPath['submenu'] == 'servico') active @endif">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    Meu Serviço
                                </p>
                            </a>
                        </li>
                        <!-- Editor -->
                        <li class="nav-item @if ($menuSelectPath['categ'] == 'editorDeModelos') menu-open @endIf">
                            <a href="#" class="nav-link @if ($menuSelectPath['categ'] == 'editorDeModelos') active @endIf">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Editor De Modelos
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('modelo.index') }}" class="nav-link @if ($menuSelectPath['categ'] == 'editorDeModelos' && $menuSelectPath['submenu'] == 'meusModelos') active @endIf">
                                        <i class="far fa-folder-open nav-icon"></i>
                                        <p>Meus Modelos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('modelo.create') }}" class="nav-link @if ($menuSelectPath['categ'] == 'editorDeModelos' && $menuSelectPath['submenu'] == 'criarModelo') active @endIf">
                                        <i class="far fa-file nav-icon"></i>
                                        <p>Criar Modelo</p>
                                    </a>
                                </li>
                             @php /*  <li class="nav-item">
                                    <a href="#" class="nav-link @if ($menuSelectPath['categ'] == 'editorDeModelos' && $menuSelectPath['submenu'] == 'gerarMensagem') active @endIf">
                                        <i class="far fa-envelope-open nav-icon"></i>
                                        <p>Gerar Mensagem</p>
                                    </a>
                                </li> */ @endphp
                            </ul>
                        </li>
                        <!-- Cadastros -->
                        <li class="nav-item @if ($menuSelectPath['categ'] == 'registros') menu-open @endIf">
                            <a href="#" class="nav-link @if ($menuSelectPath['categ'] == 'registros') active @endIf">
                                <i class="nav-icon fas fa-save"></i>
                                <p>
                                    Registros
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('cliente.index') }}" class="nav-link @if ($menuSelectPath['categ'] == 'registros' && $menuSelectPath['submenu'] == 'cliente') active @endIf">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cliente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('vendedor.index') }}" class="nav-link @if ($menuSelectPath['categ'] == 'registros' && $menuSelectPath['submenu'] == 'vendedor') active @endIf">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Vendedor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('produto.index') }}" class="nav-link @if ($menuSelectPath['categ'] == 'registros' && $menuSelectPath['submenu'] == 'produto') active @endIf">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Produto</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('rastreamento.index') }}" class="nav-link @if ($menuSelectPath['categ'] == 'registros' && $menuSelectPath['submenu'] == 'rastreamento') active @endIf">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Empresa De Entregas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('remessa.index') }}" class="nav-link @if ($menuSelectPath['categ'] == 'registros' && $menuSelectPath['submenu'] == 'remessa') active @endIf">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Remessa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('compra.index') }}" class="nav-link @if ($menuSelectPath['categ'] == 'registros' && $menuSelectPath['submenu'] == 'compra') active @endIf">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Compra</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Sobre E Ajuda -->
                        <li class="nav-item @if ($menuSelectPath['categ'] == 'informacoes') menu-open @endIf">
                            <a href="#" class="nav-link @if ($menuSelectPath['categ'] == 'informacoes') active @endIf">
                                <i class="nav-icon fas fa-info"></i>
                                <p>
                                    Informações
                                    <i class="fas fa-angle-right right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('sobre') }}" class="nav-link @if ($menuSelectPath['categ'] == 'informacoes' && $menuSelectPath['submenu'] == 'sobre') active @endIf">
                                        <i class="far fa-bookmark nav-icon"></i>
                                        <p>Sobre o Flare Editor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('instrucoes') }}" class="nav-link @if ($menuSelectPath['categ'] == 'informacoes' && $menuSelectPath['submenu'] == 'comoUsar') active @endIf">
                                        <i class="far fa-bookmark nav-icon"></i>
                                        <p>Como Usar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @hasSection('bodyContentWrapped')
                @yield("bodyContentWrapped")
            @else

                @hasSection('bodyTitle')
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0">
                                        @yield('bodyTitle')
                                    </h1>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->
                @endif

                @hasSection('bodyContent')
                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">
                            @yield('bodyContent')
                        </div>
                    </div>
                    <!-- /.content -->
                @endif
            @endif
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark flareeditor-control-sidebar-glass">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer border-top border-dark text-dark" style="background-color: white;">
            <!-- Default to the left -->
            <strong>Copyright &copy; <span id="copyrightYear">2021</span> Eduardo F Silva</strong> All rights
            reserved.
        </footer>
    </div>

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('popper/popper.min.js') }}"></script>
    <script src="{{ asset('popper/popper-utils.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
    @hasSection('footerLinks')
        @yield('footerLinks')
    @endif
    <script type="text/javascript">
        $(document).ready(function() {
            //Inicialização De Tooltips
            $('[data-toggle="tooltip"]').tooltip();
            //Autocorreção Do Ano de Copyright
            var year = new Date().getFullYear();
            if (year > 2021) {
                var newCopyright = "2021-" + year;
                $('#copyrightYear').html(newCopyright);
            }
        });
        //Remove o element Id da URL (causa problemas ao tentar atualizar a página)
        $("a[href^='#']").click(function(e) {
            e.preventDefault();
            var elem = $($(this).attr('href'));
            /* check for broken link */
            //if (elem.length)
            //    $(window).animate('scrollTop', elem.offset().top)
        });
    </script>
    @if (sizeof($errors, 0) > 0)
        <script type="text/javascript">
            $(document).ready(function() {
                @foreach ($errors->all() as $error)
                    $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Erro',
                    subtitle: 'Editar Dados',
                    body: '<h6>{{ $error }}</h6>'
                    })
                @endforeach
            });
        </script>
    @endif
</body>

</html>
