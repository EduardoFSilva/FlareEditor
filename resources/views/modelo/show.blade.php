@extends('layouts.master')
@php
$usePreloader = false;
$menuSelectPath = ['categ' => 'none', 'submenu' => 'servico'];
@endphp

@section('pageTitle')
    Gerar Modelo
@endsection

@section('bodyTitle')
    Gerar Modelo
@endsection

@section('headerLinks')

@endsection
<link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatables/dt/css/dataTables.bootstrap4.min.css') }}">
@section('bodyContent')
    <div class="card">
        <div class="card-header">
            <h5 class="text-primary">Selecione A Compra Para Gerar A Mensagem</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('modelo.process') }}" method="POST">
                @csrf
                <input type="hidden" name="modeloId" value="{{ $modelo->id }}">
                <table id="tableCompra" class="table table-bordered text-center">
                    <thead class="thead-dark ">
                        <tr>
                            <th scope="col">Select</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Remessa</th>
                            <th scope="col">Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <br>
                <button class="btn btn-primary" type="submit">Gerar Mensagem</button>
            </form>
        </div>
    </div>
@endsection
@section('footerLinks')
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('datatables/dt/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        var id = null;
        $('#tableCompra').DataTable({
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
                "url": '{{ route('datatables.compra') }}',
                "dataSrc": "",
                "type": "GET"
            },
            "columns": [{
                    data: 'id',
                    name: 'Select',
                    orderable: false,
                    width: '10%',
                    render: function(id, type, row) {
                        var html = '<div class="form-check">'
                        html += '    <input class="form-check-input" type="radio" name="compraId" value="' +
                            id + '" required>'
                        html += '</div>'
                        return html
                    }
                },
                {
                    data: 'cliente',
                    name: 'Cliente',
                    render: function(cliente, type, row) {
                        var nomeCompleto = cliente.nome + " " + cliente.sobrenome;
                        return nomeCompleto;
                    }
                },

                {
                    data: 'produto.descricao',
                    name: 'Empresa'
                },
                {
                    data: 'remessa.codigoRastreamento',
                    name: 'Remessa'
                },
                {
                    data: 'quantidade',
                    name: 'Quantidade'
                }
            ]
        });
    </script>
@endsection
