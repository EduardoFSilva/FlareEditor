@extends('layouts.master')
@php
$menuSelectPath = ['categ' => 'registros', 'submenu' => 'produto'];
@endphp
@section('headerLinks')
    <link rel="stylesheet" href="{{ asset('css/flareeditor/forminput.css') }}">
@endsection
@section('pageTitle')
    Adicionar Produto
@endsection
@section('bodyTitle')
    Adicionar Produto
@endsection
@section('bodyContent')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <form method="POST" action="{{ route('produto.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="descricao">Descricao <code>*</code><span></label>
                            <input type="text" class="form-control flareeditor-input-orange" id="descricao"
                                placeholder="Descrição Do Produto" name="descricao">
                        </div>
                        <div class="form-group">
                            <label for="email">Vendedor <code>*</code></label>
                            <select class="form-control flareeditor-input-orange" id="vendedor" name="vendedor">
                                @foreach ($vendedores as $vendedor)
                                <option value="{{ $vendedor->id }}">{{$vendedor->nome}}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome">Preço <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="preco"
                                        placeholder="Preco Do Produto" name="preco">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="link">Link <code>*</code></label>
                                    <input type="text" class="form-control flareeditor-input-orange" id="link"
                                        placeholder="Link Do Produto" name="link">
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
