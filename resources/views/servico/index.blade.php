@extends('layouts.master')
@php
$usePreloader = true;
$menuSelectPath = ['categ' => 'none', 'submenu' => 'servico'];
@endphp

@section('pageTitle')
    Meu Servico
@endsection

@section('bodyTitle')
    Meu Servico
@endsection
@section('headerLinks')
    <link rel="stylesheet" href="{{asset('css/flareeditor/forminput.css')}}">
@endsection
@section('bodyContent')
    @php
    use App\Models\User;
    use App\Models\Servico;

    $servico = auth()->user()->servico;
    @endphp
    <div class="row">
        <div class="col-md-4">

            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Seus Dados</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-id-card mr-1"></i> Razão Social</strong>
                    <p class="text-muted">
                        {{ $servico->razaoSocial }}
                    </p>
                    <hr>
                    <strong><i class="fas fa-user mr-1"></i>Nome Fantasia</strong>
                    <p class="text-muted">{{ $servico->nomeFantasia }}</p>

                    <hr>

                    <strong><i class="fas fa-envelope mr-1"></i>Email SAC</strong>

                    <p class="text-muted">
                        <a href="mailto:{{ $servico->email }}">{{ $servico->email }}</a>
                    </p>

                    <hr>

                    <strong><i class="fas fa-phone-alt mr-1"></i> Telefone SAC</strong>

                    <p class="text-muted"><a href="tel:{{ $servico->telefone }}"> {{ $servico->telefone }}</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#guiaInformacao"
                                data-toggle="tab">Informações</a></li>
                        <li class="nav-item"><a class="nav-link" href="#guiaEditarUsuario"
                                data-toggle="tab">Editar Dados de Usuário</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#guiaEditarServico"
                                data-toggle="tab">Editar Dados de Serviço</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="guiaInformacao">
                            <h5 class="text-navy">Você Possui Cadastrado:</h5>
                            <p><b class="text-secondary">{{ sizeof($servico->cliente, 0) }}</b> cliente(s)</p>
                            <p><b class="text-secondary">{{ sizeof($servico->compra, 0) }}</b> compra(s)</p>
                            <p><b class="text-secondary">{{ sizeof($servico->modelo, 0) }}</b> modelo(s)</p>
                            <p><b class="text-secondary">{{ sizeof($servico->produto, 0) }}</b> produto(s)</p>
                            <p><b class="text-secondary">{{ sizeof($servico->rastreamento, 0) }}</b> empresa(s) de
                                rastreamento</p>
                            <p><b class="text-secondary">{{ sizeof($servico->vendedor, 0) }}</b> vendedor(es)</p>

                        </div>
                        <div class="tab-pane" id="guiaEditarUsuario">
                            <div id="editarUsuarioAcc">
                                <div class="card card-danger card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#editarSenhaUsuario">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                Alterar Senha
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="editarSenhaUsuario" class="collapse" data-parent="#editarUsuarioAcc">
                                        <div class="card-body">
                                            <!-- Formulario Alterar Senha -->
                                            <form action="{{ route('users.update', auth()->user()->id) }}" method="POST">
                                                @method('put')
                                                @csrf
                                                <input type="hidden" name="editType" value="password">
                                                <div class="form-group">
                                                    <label for="oldPassword">Senha Atual</label>
                                                    <input type="password" class="form-control flareeditor-input-orange" id="oldPassword"
                                                        name="oldPassword" placeholder="Senha Atual">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Nova Senha</label>
                                                    <input type="password" class="form-control flareeditor-input-orange" id="password"
                                                        name="password" placeholder="Nova Senha">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password_confirmation">Nova Senha</label>
                                                    <input type="password" class="form-control flareeditor-input-orange" id="password_confirmation"
                                                        name="password_confirmation" placeholder="Confirmar Nova Senha">
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                </div>
                                            </form>
                                            <!--/ Formulario Alterar Senha -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-success card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#editarNomeUsuario">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                Alterar Nome
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="editarNomeUsuario" class="collapse" data-parent="#editarUsuarioAcc">
                                        <div class="card-body">
                                            <!-- Formulario De Alterar Nome -->
                                            <form action="{{ route('users.update', auth()->user()->id) }}" method="POST">
                                                @method("put")
                                                @csrf
                                                <input type="hidden" name="editType" value="name">
                                                <div class="form-group">
                                                    <label for="userName">Nome De Usuário</label>
                                                    <input type="text" class="form-control flareeditor-input-orange" id="userName" name="userName"
                                                        placeholder="Nome Atual" value="{{ auth()->user()->name }}">
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                </div>
                                            </form>
                                            <!--/ Formulario De Alterar Nome -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="guiaEditarServico">
                            <form method="POST" action="{{ route('servico.update', $servico->id) }}">
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label for="servNomeRazaoSocial">Razão Social</label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="servNomeRazaoSocial" name="reason"
                                        placeholder="Razão Social" value="{{ $servico->razaoSocial }}">
                                </div>
                                <div class="form-group">
                                    <label for="servNomeFantasia">Nome Fantasia</label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="servNomeFantasia" name="name"
                                        placeholder="Nome Fantasia" value="{{ $servico->nomeFantasia }}">
                                </div>
                                <div class="form-group">
                                    <label for="servEmail">Email SAC</label>
                                    <input type="email" class="form-control flareeditor-input-orange" id="servEmail" placeholder="Email SAC"
                                        name="email" value="{{ $servico->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="servTelefone">Telefone SAC</label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="servTelefone" placeholder="Telefone SAC"
                                        name="telephone" value="{{ $servico->telefone }}">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                </div>
                            </form>
                            <!--/ Formulario Dados do servico -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footerLinks')
    @php
    if (session()->exists('mensagemSucesso')) {
        $mensagemSucesso = session()->get('mensagemSucesso');
        session()->forget('mensagemSucesso');
    } else {
        $mensagemSucesso = null;
    }
    @endphp
    @if ($mensagemSucesso != null)
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Sucesso',
                    subtitle: 'Editar Dados',
                    body: '<h6>{{ $mensagemSucesso }}</h6>'
                })
            });
        </script>
    @endif
@endsection
