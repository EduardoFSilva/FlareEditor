@extends('layouts.master')
@php
$menuSelectPath = ['categ' => 'registros', 'submenu' => 'cliente'];
@endphp
@section('headerLinks')
    <link rel="stylesheet" href="{{ asset('css/flareeditor/forminput.css') }}">
@endsection
@section('pageTitle')
    Adicionar Cliente
@endsection
@section('bodyTitle')
    Adicionar Cliente
@endsection
@section('bodyContent')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <form method="POST" action="{{ route('cliente.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome">Nome <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="nome"
                                        placeholder="Nome Do Cliente" name="nome">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sobrenome">Sobrenome <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="sobrenome"
                                        placeholder="Sobrenome do Cliente" name="sobrenome">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <code>*</code></label>
                            <input type="email" class="form-control flareeditor-input-orange" id="email"
                                placeholder="Email Do Cliente" name="email">
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço <code>*</code><span></label>
                            <input type="text" class="form-control flareeditor-input-orange" id="endereco"
                                placeholder="Endereço Do Cliente" name="endereco">
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
