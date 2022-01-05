@extends('layouts.master')
@php
$menuSelectPath = ['categ' => 'registros', 'submenu' => 'cliente'];
@endphp
@section('headerLinks')
    <link rel="stylesheet" href="{{ asset('css/flareeditor/forminput.css') }}">
@endsection
@section('pageTitle')
    Atualizar Dados de Cliente
@endsection
@section('bodyTitle')
    Atualizar Dados de Cliente
@endsection
@section('bodyContent')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <form method="POST" action="{{ route('cliente.update', $cliente->id) }}">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome">Nome <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="nome"
                                        placeholder="Nome Do Cliente" name="nome" value="{{ $cliente->nome }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sobrenome">Sobrenome <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="sobrenome"
                                        placeholder="Sobrenome do Cliente" name="sobrenome"
                                        value="{{ $cliente->sobrenome }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <code>*</code></label>
                            <input type="email" class="form-control flareeditor-input-orange" id="email"
                                placeholder="Email Do Cliente" name="email" value="{{ $cliente->email }}">
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço <code>*</code></label>
                            <input type="text" class="form-control flareeditor-input-orange" id="endereco"
                                placeholder="Endereço Do Cliente" name="endereco" value="{{ $cliente->endereco }}">
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
