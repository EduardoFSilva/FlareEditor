<html>

<head>
    <meta charset="utf-8">
    <title>Flare Editor - Login</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flareeditor/login.css') }}">
</head>



<body class="hold-transition login-page mt-n5 flareeditor-bg">
    <div class="login-box flareeditor-login-pane">
        <div class="card card-outline card-orange">
            <div class="card-header text-center">
                <a href="/" class="h1"><img src="{{ asset('img/logo-flare.png') }}" alt="FlareEditor"
                        width="50%" height="50%"></a>
            </div>
            <div class="card-body">
                <br>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control flareeditor-input-orange"
                            placeholder="Email">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control flareeditor-input-orange"
                            placeholder="Senha">
                    </div><br>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('register') }}" class="btn btn-secondary btn-block">Criar Conta</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('popper/popper.min.js') }}"></script>
    <script src="{{ asset('popper/popper-utils.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
    @if (sizeof($errors, 0) > 0)
        <script type="text/javascript">
            $(document).ready(function() {
                @foreach ($errors->all() as $error)
                    $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Erro',
                    subtitle: 'Login',
                    body: '{{ $error }}'
                    })
                @endforeach
            });
        </script>
    @endif
</body>

</html>
