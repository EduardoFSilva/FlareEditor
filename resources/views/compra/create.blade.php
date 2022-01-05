@extends('layouts.master')
@php
$menuSelectPath = ['categ' => 'registros', 'submenu' => 'compra'];
@endphp
@section('headerLinks')
    <link rel="stylesheet" href="{{ asset('css/flareeditor/forminput.css') }}">
@endsection
@section('pageTitle')
    Adicionar Compra
@endsection
@section('bodyTitle')
    Adicionar Compra
@endsection
@section('bodyContent')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <form method="POST" action="{{ route('compra.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="clienteId">Código De Rastreamento <code>*</code></label>
                                    <select class="form-control flareeditor-input-orange" id="clienteId" name="clienteId">
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nome." ".$cliente->sobrenome }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="remessaId">Tipo <code>*</code></label>
                                    <select class="form-control flareeditor-input-orange" id="remessaId" name="remessaId">
                                        @foreach ($remessas as $remessa)
                                            <option value="{{ $remessa->id }}">{{ $remessa->codigoRastreamento."  (".$remessa->rastreamento->nomeEmpresa.")" }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="produtoId">Produto <code>*</code></label>
                                    <select class="form-control flareeditor-input-orange" id="produtoId" name="produtoId">
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->descricao." (".$produto->vendedor->nome.")" }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantidade">Quantidade <code>*</code></label>
                                    <input type="number" class="form-control flareeditor-input-orange" id="quantidade"
                                        placeholder="Quantidade De Produtos" name="quantidade" min="1" value="1">
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
