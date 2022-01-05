<html>

<head>
    <meta charset="UTF-8">
    <title>Flare Editor</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flareeditor/landing.css') }}">

</head>

<body>

    <nav class="navbar navbar-expand fixed-top navbar-dark navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <img src="{{ asset('img/logo-flare-o.png') }}" alt="FlareEditor Logo" height="36px" width="36px">
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            @auth
                <!-- Dashboard -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom"
                        title="Dashboard">
                        <i class="fas fa-desktop"></i></a>
                </li>
                <!-- Logout -->
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
            @else
                <!-- Login -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('login') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom"
                        title="Entrar">
                        <i class="fas fa-sign-in-alt"></i></a>
                </li>
                <!-- Registro -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('register') }}" class="nav-link" data-toggle="tooltip" data-placement="bottom"
                        title="Registrar">
                        <i class="fas fa-user-plus"></i></a>
                </li>
            @endauth

            <!-- Tela Cheia -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button" data-toggle="tooltip"
                    data-placement="bottom" title="Tela Cheia">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <br>
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-5 py-5">
            <div class="col-lg-8  flareeditor-board-bg rounded card card-outline card-orange">
                @auth
                    <div class="media">
                        <div class="media">
                            <img src="{{ asset('img/logo-flare-o.png') }}" height="64px" width="64px"
                                class="align-self-center mr-3" alt="...">
                            <div class="media-body">
                                <h3 class="flareeditor-text-orange">
                                    @php
                                        [$first, $surnames] = explode(' ', auth()->user()->name);
                                    @endphp
                                    Ola {{ $first }}
                                </h3>
                            </div>
                        </div>
                    </div>
                @else
                    <h1 class="display-5 fw-bold lh-1 mb-3">
                        <img src="{{ asset('img/logo-flare.png') }}" alt="Flare Editor" height="88px" width="150px">
                    </h1>
                @endauth
                @auth
                    <br>
                    <p class="lead">Você já esta conectado(a)<br><br>
                        Selecione "Painel De Controle" para editar seus modelos e informações<br>
                        Selecioner "Sair" para encerrar sua sessão</p>
                @else
                    <p class="lead">
                        Flare Editor é um editor de templates de mensagens de emails de e-commerce criado em cima das
                        tecnologia Laravel, Bootstrap, Summernote, DataTables, dentre outras.</p>
                    </p>
                @endauth
                <div class="d-grid gap-2 d-md-flex justify-content-md-start flareeditor-btn-spc">
                    @auth
                    <a type="button" href="{{ route('dashboard') }}"
                    class="btn btn-outline-danger btn-lg px-4 mx-2">Painel De Controle</a>
                    <button type="submit" form="sair_card" formmethod="Post" class="btn btn-outline-primary btn-lg px-4 mx-2">Sair</button>
                        <form type="post" action="{{ route('logout') }}" id="sair_card" hidden>
                            @csrf
                        </form>
                    @else
                        <a type="button" href="{{ route('register') }}"
                            class="btn btn-outline-danger btn-lg px-4 mx-2">Registrar</a>
                        <a type="button" href='{{ route('login') }}'
                            class="btn btn-outline-primary btn-lg px-4 mx-2">Entrar</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('popper/popper.min.js') }}"></script>
    <script src="{{ asset('popper/popper-utils.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //Inicialização De Tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>
