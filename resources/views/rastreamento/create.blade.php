@extends('layouts.master')
@php
$menuSelectPath = ['categ' => 'registros', 'submenu' => 'rastreamento'];
@endphp
@section('headerLinks')
    <link rel="stylesheet" href="{{ asset('css/flareeditor/forminput.css') }}">
@endsection
@section('pageTitle')
    Adicionar Empresa de Entregas
@endsection
@section('bodyTitle')
    Adicionar Empresa de Entregas
@endsection
@section('bodyContent')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <form method="POST" action="{{ route('rastreamento.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomeEmpresa">Nome <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="nomeEmpresa"
                                        placeholder="Nome Da Empresa De Entregas" name="nomeEmpresa">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site">Site <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="site"
                                        placeholder="Link Do Site Da Empresa" name="site">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefone">Telefone <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="telefone"
                                        placeholder="Telefone Da Empresa De Entregas" name="telefone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="email"
                                        placeholder="Email Da Empresa De Entregas" name="email">
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
