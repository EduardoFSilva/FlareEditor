@extends('layouts.master')
@php
$menuSelectPath = ['categ' => 'registros', 'submenu' => 'vendedor'];
@endphp
@section('headerLinks')
    <link rel="stylesheet" href="{{ asset('css/flareeditor/forminput.css') }}">
@endsection
@section('pageTitle')
    Atualizar Dados de Vendedor
@endsection
@section('bodyTitle')
    Atualizar Dados de Vendedor
@endsection
@section('bodyContent')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <form method="POST" action="{{ route('vendedor.update',$vendedor->id) }}">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome <code>*</code><span></label>
                            <input type="text" class="form-control flareeditor-input-orange" id="nome"
                                placeholder="Nome do Vendedor" name="nome" value="{{ $vendedor->nome }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="telefone"
                                        placeholder="Telefone Do Vendedor" name="telefone" value="@if ($vendedor->telefone != null){{ $vendedor->telefone }}@endif">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pais">País <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="pais"
                                        placeholder="País do Vendedor" name="pais" value="{{ $vendedor->pais }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <code>*</code></label>
                            <input type="email" class="form-control flareeditor-input-orange" id="email"
                                placeholder="Email Do Vendedor" name="email" value="{{ $vendedor->email }}">
                        </div>
                        <input type="hidden" name="servicoId" value="{{ $servico->id }}">
                        <!-- /.card-body -->
                        <span><code>*</code> Campos Obrigatórios</span>
                        <br><br>
                        <button type="submit" class="btn btn-primary">Atualizar Dados</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
