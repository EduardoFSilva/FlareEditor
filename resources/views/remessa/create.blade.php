@extends('layouts.master')
@php
$menuSelectPath = ['categ' => 'registros', 'submenu' => 'remessa'];
@endphp
@section('headerLinks')
    <link rel="stylesheet" href="{{ asset('css/flareeditor/forminput.css') }}">
@endsection
@section('pageTitle')
    Adicionar Remessa
@endsection
@section('bodyTitle')
    Adicionar Remessa
@endsection
@section('bodyContent')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <form method="POST" action="{{ route('remessa.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigoRastreamento">Código De Rastreamento <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="codigoRastreamento"
                                        placeholder="Código De Rastreamento Da Remessa" name="codigoRastreamento">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipoRemessa">Tipo <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="tipoRemessa"
                                        placeholder="Tipo Da Remessa" name="tipoRemessa">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkRastreamento">Link De Rastreamento <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="linkRastreamento"
                                        placeholder="Link Do Site De Rastreamento Da Remessa" name="linkRastreamento">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dataEntrega">Data De Entrega <code>*</code></label>
                                    <input type="date" class="form-control flareeditor-input-orange" id="dataEntrega"
                                        placeholder="Email Da Empresa De Entregas" name="dataEntrega" value={{ date('Y-m-d') }}>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rastreamentoId">Empresa De Entregas <code>*</code></label>
                                    <select class="form-control flareeditor-input-orange" id="rastreamentoId" name="rastreamentoId">
                                        @foreach ($rastreamentos as $rastreamento)
                                            <option value="{{ $rastreamento->id }}">{{ $rastreamento->nomeEmpresa }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="progressoRastreamento">Progresso Da Entrega<code>*</code></label>
                                    <select class="form-control flareeditor-input-orange" id="progressoRastreamento" name="progressoRastreamento">
                                        @php
                                            //Utilizando PHP para gerar as options ficar menos poluído e ser mais facil de adicionar o "selected"
                                            $opcoes = ["Aguardando Pagamento","Aguandando Envio Do Vendedor","Objeto Enviado",
                                            "Objeto Em Trânsito","Objeto Foi Entrege Ao Destinatário","Aguardando Retirada Na Transportadora",
                                            "Entrada Na Fiscalização Aduaneira","Saida Da Fiscalização Aduaneira","Objeto Devolvido Ao Remetente",
                                            "Objeto Saiu Para Entrega Ao Destinatário"];
                                        @endphp
                                        @foreach ($opcoes as $opcao)
                                        <option value='{{ $opcao }}'>{{ $opcao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="servicoId" value="{{ $servico->id }}">
                        <!-- /.card-body -->
                        <span><code>*</code> Campos Obrigatórios</span>
                        <br><br>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
