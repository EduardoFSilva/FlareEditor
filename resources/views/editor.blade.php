<html lang="en">

<head>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('popper/popper.min.js') }}"></script>
    <script src="{{ asset('popper/popper-utils.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('summernote/lang/summernote-pt-BR.min.js') }}"></script>
    <link href="{{ asset('css/flareeditor.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Flare Editor - Criar Modelo</title>
</head>

<body class="bg-dark">
    <br>
    <div class="container">
        <div class="row mt-2">
            <div class="col-lg-2 border border-light text-white text-center py-2 rounded">
                Inserir Variável
                <div class="btn-group-vertical">
                    <!-- Variaveis De Cliente -->
                    <div class="btn-group dropright m-1">
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
                    <div class="btn-group dropright m-1">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Produto
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item" onclick="inserirVar('produto.descricao')">Descrição</button>
                            <button class="dropdown-item" onclick="inserirVar('produto.preco')">Preço</button>
                            <button class="dropdown-item"
                                onclick="inserirVar('produto.quantidade')">Quantidade</button>
                            <button class="dropdown-item" onclick="inserirVar('produto.link')">Link</button>
                        </div>
                    </div>
                    <!-- Variaveis De Vendedor -->
                    <div class="btn-group dropright m-1">
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
                    <div class="btn-group dropright m-1">
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
                    <div class="btn-group dropright m-1">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Rastreamento
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item" onclick="inserirVar('rastreamento.progresso')">Progresso Da Entrega</button>
                            <button class="dropdown-item"
                                onclick="inserirVar('rastreamento.identificador')">Identificador Da Remessa</button>
                            <button class="dropdown-item" onclick="inserirVar('rastreamento.empresa')">Nome Da
                                Empresa</button>
                            <button class="dropdown-item" onclick="inserirVar('rastreamento.tiporemessa')">Tipo
                                Remessa</button>
                            <button class="dropdown-item" onclick="inserirVar('rastreamento.email')">Email Da
                                Transportadora</button>
                            <button class="dropdown-item" onclick="inserirVar('rastreamento.telefone')">Telefone Da
                                Transportadora</button>
                            <button class="dropdown-item" onclick="inserirVar('rastreamento.site')">Site Da
                                Transportadora</button>
                            <button class="dropdown-item" onclick="inserirVar('rastreamento.link')">Link De
                                Rastreamento</button>
                            <button class="dropdown-item" onclick="inserirVar('rastreamento.dataEntrega')">Data De
                                Entrega</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div id="editorSummernote"></div>
                <form method="post" action="{{ route('receber') }}" id="formulario">
                    @csrf
                    <input type="hidden" name="rawHtml" id="rawHtml">
                    <!-- <div class="mx-auto mt-4 text-center">
                        <input type="button" value="Enviar Texto" onclick="enviarForm()"
                            class="btn btn-primary mx-auto">
                    </div> -->
                </form>
            </div>
            <div class="col-lg-2 border border-light text-white text-center py-2 rounded">
                <!-- Botao De Envio -->
                Opções
                <div class="btn-group-vertical">
                    <input type="button" value="Salvar Modelo" onclick="enviarForm()" class="btn btn-primary my-1">
                    <input type="button" value="Cancelar" class="btn btn-danger my-1">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/editorInit.js') }}">
    </script>
</body>

</html>
