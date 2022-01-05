<!DOCTYPE html>
<html lang=>

<head>
    <meta charset="utf-8">
    <title>Flare Editor - Registrar Servico</title>

    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flareeditor/login.css') }}">
</head>

<body class="hold-transition register-page mt-n5 flareeditor-bg">
    <div class="register-box flareeditor-login-pane" style="margin-top: 50px;">
        <div class="card card-outline card-orange">
            <div class="card-header text-center">
                <a href="/" class="h1"><img src="{{ asset('img/logo-flare.png') }}" alt="FlareEditor"
                        width="50%" height="50%"></a>
            </div>
            <div class="card-body">
                <h4 class="login-box-msg" style="color: #ff4500">Registrar O Serviço</h4>
                <br>
                <form action="{{ route('servico.store') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control flareeditor-input-orange" name="reason"
                            placeholder="Razao Social">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control flareeditor-input-orange" name="name"
                            placeholder="Nome Fantasia">
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control flareeditor-input-orange" name="email"
                            placeholder="Email SAC">
                    </div>
                    <div class="input-group mb-3">
                        <input type="tel" class="form-control flareeditor-input-orange" name="telephone"
                            placeholder="Telefone SAC">
                    </div>
                    <div class="input-group mb-3">
                        <input type="hidden" class="form-control flareeditor-input-orange" name="usersId"
                            value="{{ $user->id }}">
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-3">
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Concluir Cadastro</button>
                        </div>
                        <div class="col-3">
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
    @if (sizeof($errors, 0) > 0)
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
