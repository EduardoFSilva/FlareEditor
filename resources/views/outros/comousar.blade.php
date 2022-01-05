@extends('layouts.master')
@php
$menuSelectPath = ['categ' => 'informacoes', 'submenu' => 'comoUsar'];
@endphp
@section('pageTitle')
    Como Usar
@endsection
@section('bodyTitle')
    Como Usar
@endsection
@section('bodyContent')
    <div class="card">
        <div class="card-header">
            <img src="{{ asset('img/logo-flare.png') }}" style="width: 25%">
        </div>
        <div class="card-body">
            <h3>Serviço</h3>
            <p>Para utilizar o Flare você precisa configurar o seu servico a partir do menu <a
                    href="{{ route('servico.index') }}" class="text-secondary"><b>Meu Serviço</b></a> onde você deve
                configurar os dados do seu serviço tais como a Razão Social, o nome fantasia e os contatos(email e telefone)
                do serviço de atendimento ao consumidor</p>
            <h3>Registros</h3>
            <p>Para que você possa gerar uma mensagem você terá de cadastrar alguns dados, dentre eles Cliente, Vendedor,
                Produto, Empresa De Entregas, Remessa e Compra</p>
            <p>É importante ressaltar que para se cadastrar um produto é necessario ja se ter vendedores cadastrados, para
                se cadastrar um remessa é necessario ja ter empresas de entrega cadastradas, e para se cadastrar compras é
                necessario já se ter clientes, remessas e produtos cadastrados</p>
            <h3>Editor De Modelos</h3>
            <p>No editor de modelos você tem tres telas diferentes disponiveis, Criar Modelo, Meus Modelos e Gerar Modelo
            </p>
            <p>Na tela Meus Modelos você tem acesso aos modelos que já criou e pode selecionar um deles para gerar a
                mensagem</p>
            <p>Na tela Criar Modelo você cria o modelo de mensagem. É importante ressaltar que as informações na guia
                "Informações Do Modelo" deve ser preenchida e a edição do modelo pode ser feita em "Editar Modelo"</p>
            <h5>Gerando A Mensagem</h5>
            <p <ul>
                <li>Para gerar a mensagem utilize o botão "Gerar" do modelo que você quer na tela Meus Modelos
                </li>
                <li>Selecione a compra na tabela abaixo e aperte o botão "Gerar Modelo"</li>
                <li>Selecione a aba "Código HTML" para pegar a mensagem gerada ou selecione a aba "Resultado" para ver o modelo processado</li>
                </ul>
            </p>
        </div>
    @endsection
