@extends('layouts.master')
@php
$menuSelectPath = ['categ' => 'editorDeModelos', 'submenu' => 'criarModelo'];
$fixedFooter = false;
$fixedNavbar = false;
@endphp
@section('headerLinks')
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flareeditor/forminput.css') }}" rel="stylesheet">
@endsection
@section('pageTitle')
    Editar Modelo
@endsection
@section('bodyTitle')
    Editar
@endsection

@section('bodyContent')
    <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link active" href="#guiaInformacao" data-toggle="tab">Informações Do
                Modelo</a></li>
        <li class="nav-item"><a class="nav-link" href="#guiaEditar" data-toggle="tab">Editar Modelo</a>
        </li>
    </ul><br>
    <div class="tab-content">
        <div class="tab-pane active" id="guiaInformacao">
            <div class="row">
                <div class="col-10 card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('modelo.update',$modelo->id) }}" id="formulario">
                            @method("put")
                            @csrf
                            <div class="form-group">
                                <label for="titulo">Título <code>*</code></label>
                                <input type="text" class="form-control flareeditor-input-orange" id="titulo"
                                    placeholder="Título do Modelo" name="titulo" value="{{ $modelo->titulo }}">
                            </div>
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control flareeditor-input-orange" id="descricao" name="descricao"
                                    rows="3" style="resize: none;" placeholder="Descrição Do Modelo (Opcional)">{{ $modelo->descricao }}</textarea>
                            </div>
                            <input type="hidden" name="mensagem" id="mensagem">
                            <input type="hidden" name="servicoId" id="servicoId" value="{{ $servico->id }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="guiaEditar">
            <!-- Painel De Opções De Insert -->
            <h6>Inserir Variável</h6>
            <div class="btn-group">
                <!-- Variaveis De Cliente -->
                <div class="btn-group dropdown m-1">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Cliente
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" onclick="inserirVar('cliente.primeiroNome')">Primeiro
                            Nome</button>
                        <button class="dropdown-item" onclick="inserirVar('cliente.nomeCompleto')">Nome
                            Completo</button>
                        <button class="dropdown-item" onclick="inserirVar('cliente.email')">Email</button>
                        <button class="dropdown-item" onclick="inserirVar('cliente.endereco')">Endereço</button>

                    </div>
                </div>
                <!-- Variaveis De Produto -->
                <div class="btn-group dropdown m-1">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Produto
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" onclick="inserirVar('produto.descricao')">Descrição</button>
                        <button class="dropdown-item" onclick="inserirVar('produto.preco')">Preço</button>
                        <button class="dropdown-item" onclick="inserirVar('produto.quantidade')">Quantidade</button>
                        <button class="dropdown-item" onclick="inserirVar('produto.link')">Link</button>
                    </div>
                </div>
                <!-- Variaveis De Vendedor -->
                <div class="btn-group dropdown m-1">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Vendedor
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" onclick="inserirVar('vendedor.nome')">Nome</button>
                        <button class="dropdown-item" onclick="inserirVar('vendedor.email')">Email</button>
                        <button class="dropdown-item" onclick="inserirVar('vendedor.telefone')">Telefone</button>
                        <button class="dropdown-item" onclick="inserirVar('vendedor.pais')">País</button>
                    </div>
                </div>
                <!-- Variaveis De Servico -->
                <div class="btn-group dropdown m-1">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Serviço
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" onclick="inserirVar('servico.nome')">Nome Fantasia</button>
                        <button class="dropdown-item" onclick="inserirVar('servico.razao')">Razao Social</button>
                        <button class="dropdown-item" onclick="inserirVar('servico.email')">Email (SAC)</button>
                        <button class="dropdown-item" onclick="inserirVar('servico.telefone')">Telefone
                            (SAC)</button>
                    </div>
                </div>
                <!-- Rastreamento -->
                <div class="btn-group dropdown m-1">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Empresa De Entregas
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" onclick="inserirVar('rastreamento.nomeEmpresa')">Nome</button>
                        <button class="dropdown-item" onclick="inserirVar('rastreamento.email')">Email</button>
                        <button class="dropdown-item" onclick="inserirVar('rastreamento.site')">Site</button>
                        <button class="dropdown-item" onclick="inserirVar('rastreamento.telefone')">Telefone</button>
                    </div>
                </div>
                <!-- Remessa -->
                <div class="btn-group dropdown m-1">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Remessa
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" onclick="inserirVar('remessa.codigo')">Código De
                            Rastreamento</button>
                        <button class="dropdown-item" onclick="inserirVar('remessa.linkRastreamento')">Link De
                            Rastreamento</button>
                        <button class="dropdown-item" onclick="inserirVar('remessa.tipoRemessa')">Tipo De
                            Remessa</button>
                        <button class="dropdown-item" onclick="inserirVar('remessa.dataDeEntrega')">Data De
                            Entrega</button>
                        <button class="dropdown-item" onclick="inserirVar('remessa.statusRastreamento')">Status Da
                            Entrega</button>
                    </div>
                </div>
            </div>
            <br>
            <!-- /Painel De Opções De Insert -->
            <!-- Editor -->
            <br>
            <div id="editorDeTexto">
                @php echo old('mensagem',$modelo->conteudo) @endphp
            </div>
        </div>
        <button class="btn btn-primary" onclick="enviarForm()" type="button">Salvar</button>
        <br><br><br>
        <!-- Editor -->
    </div>
@endsection
@section('footerLinks')
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('summernote/lang/summernote-pt-BR.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#editorDeTexto').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['fontsize', ['fontsize']],
                    ['font', ['bold', 'italic', 'underline']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['picture', 'hr']],
                    ['table', ['table']]
                ],

                lang: 'pt-BR',
                fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '26', '28',
                    '36', '48', '72'
                ],
                lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0',
                    '3.0'
                ],
                spellCheck: true,
                height: 400,
                disableResizeEditor: true
            });
        });

        function enviarForm() {
            var formulario = document.querySelector("#formulario");
            $("#mensagem").val($("#editorDeTexto").summernote('code'));
            formulario.submit();
        }

        function inserirVar(valor) {
            var variavel = "{'" + valor + "'}";
            console.log(variavel);
            $("#editorDeTexto").summernote('insertText', variavel);
        }
    </script>
@endsection
