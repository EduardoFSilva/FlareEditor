<!DOCTYPE html>
<html lang=>

<head>
    <meta charset="utf-8">
    <title>Flare Editor - Registrar</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flareeditor/login.css') }}">
</head>

<body class="hold-transition register-page mt-n5 flareeditor-bg">
    <div class="register-box flareeditor-login-pane">
        <div class="card card-outline card-orange">
            <div class="card-header text-center">
                <a href="/" class="h1"><img src="{{ asset('img/logo-flare.png') }}" alt="FlareEditor"
                        width="50%" height="50%"></a>
            </div>
            <div class="card-body">
                <br>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control flareeditor-input-orange" name="name"
                            placeholder="Nome Completo">
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control flareeditor-input-orange" name="email"
                            placeholder="Email">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control flareeditor-input-orange" name="password"
                            placeholder="Senha">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control flareeditor-input-orange"
                            name="password_confirmation" placeholder="Confirmar Senha">
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('login') }}" class="btn btn-secondary btn-block">Já Sou Usuario</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('popper/popper.min.js') }}"></script>
    <script src="{{ asset('popper/popper-utils.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
    @if (sizeof($errors,0) > 0)
        <script type="text/javascript">
            $(document).ready(function() {
                @foreach ($errors->all() as $error)
                $(document).Toasts('create', {
                  class: 'bg-danger',
                  title: 'Erro',
                  subtitle: 'Registro',
                  body: '{{ $error }}'
                })
                @endforeach
              });
              
        </script>
    @endif
</body>

</html>
