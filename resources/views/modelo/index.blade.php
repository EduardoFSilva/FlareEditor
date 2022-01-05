@extends('layouts.master')
@php
$usePreloader = true;
$menuSelectPath = ['categ' => 'editorDeModelos', 'submenu' => 'meusModelos'];
@endphp
@section('headerLinks')
    <link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/dt/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('pageTitle')
    Meus Modelos
@endsection
@section('bodyTitle')
    Meus Modelos
@endsection
@section('bodyContent')
    <a role="button" class="btn btn-primary m-2" href="{{ route('modelo.create') }}">Criar Novo Modelo</a><br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tableModelo" class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Titulo</th>
                                <th scope="col">Descricao</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($modelos as $modelo)
        <form action="{{ route('modelo.destroy', $modelo->id) }}" method="POST">
            @method("delete")
            @csrf
            <div class="modal fade" id="modalDelete{{ $modelo->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Apagar Modelo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Deseja apagar o modelo <b>{{ $modelo->titulo }}</b>? </p>
                            <p></p>
                            <p><span class="text-danger">Esta ação nao pode ser desfeita</span> </p>
                        </div>
                        <div class="modal-footer justify-content-right">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
                            <button type="submit" class="btn btn-danger">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach

@endsection

@section('footerLinks')
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('datatables/dt/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        function mostrarModal(idModal) {
            $("#modalDelete" + idModal).modal("show");
        }
    </script>
    @php
    $subtitulo = "";
    if (session()->exists('mensagemSucessoApagar')) {
        $mensagemSucesso = session()->get('mensagemSucessoApagar');
        $subtitulo = "Apagar Modelo";
        session()->forget('mensagemSucessoApagar');
    } elseif (session()->exists('mensagemSucessoAdicionar')) {
        $mensagemSucesso = session()->get('mensagemSucessoAdicionar');
        $subtitulo = "Adicionar Modelo";
        session()->forget('mensagemSucessoAdicionar');
    } elseif (session()->exists('mensagemSucessoAtualizar')) {
        $mensagemSucesso = session()->get('mensagemSucessoAtualizar');
        $subtitulo = "Atualizar Modelo";
        session()->forget('mensagemSucessoAtualizar');
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
                    subtitle: '{{ $subtitulo }}',
                    body: '<h6>{{ $mensagemSucesso }}</h6>'
                    {{ $mensagemSucesso = null }}
                })
            });
        </script>
    @endif


    <script>
        var id = null;
        $('#tableModelo').DataTable({
            "language": {
                "url": "{{ asset('datatables/pt_br.json') }}"
            },
            "order": [
                [0, "asc"]
            ],
            pageLength: 5,
            "lengthMenu": [
                [5, 10, 25, 50],
                [5, 10, 25, 50]
            ],
            "ajax": {
                "url": '{{ route('datatables.modelo') }}',
                "dataSrc": "",
                "type": "GET"
            },
            "columns": [{
                    data: 'titulo',
                    name: 'Titulo'
                },
                {
                    data: 'descricao',
                    name: 'Descricao'
                },
                {
                    data: 'id',
                    name: "Opções",
                    width: "40%",
                    orderable: false,
                    render: function(id, type, row) {
                        var html = '<div class="row">'
                        html += '    <div class="col-md-4">'
                        html += '        <p>'
                        html += '            <a href="/modelo/' + id + '/edit" class="btn btn-primary btn-block">'
                        html += '                Editar'
                        html += '            </a>'
                        html += '        </p>'
                        html += '    </div>'
                        html += '    <div class="col-md-4">'
                            html += '        <p>'
                            html += '            <a href="/modelo/' + id + '" class="btn btn-primary btn-block">'
                            html += '                Gerar'
                            html += '            </a>'
                            html += '        </p>'
                            html += '    </div>'
                        html += '    <div class="col-md-4">'
                        html += '        <p>'
                        html += '            <button type="button" onclick="mostrarModal(' + id +
                            ')" class="btn btn-danger btn-block">'
                        html += '                Apagar'
                        html += '            </button>'
                        html += '        </p>'
                        html += '    </div>'
                        html += '</div">'
                        return html;
                    }
                }
            ]
        });
    </script>
@endsection
