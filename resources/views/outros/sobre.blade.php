@extends('layouts.master')
@php
$menuSelectPath = ['categ' => 'informacoes', 'submenu' => 'sobre'];
@endphp
@section('pageTitle')
    Sobre O Flare Editor
@endsection
@section('bodyTitle')
    Sobre
@endsection
@section('bodyContent')
    <div class="card">
        <div class="card-header">
            <img src="{{ asset('img/logo-flare.png') }}" style="width: 25%">
        </div>
        <div class="card-body">
            <p>Criado Por Eduardo F Silva no fim de 2021 e inicio de 2022</p>
            <p>O Projeto Flare Editor foi desenvolvido no intervalo de aproximadamente um semana e meia como um desafio para
                poder se saber a experiencia em tecnologias como Laravel, PHP, Bootstraps, HTML, CSS, JS, dentre outras</p>
            <p>Para sua criação foram utilizadas diversas bibliotecas de código aberto como Summernote, DataTables, Code
                Mirror detre muitas outras</p>
                <p>O Flare é para ser um gerador de emails de comunicação de empresas de E-Commerce e clientes e ainda está em fase experimental</p>
        </div>
    </div>
@endsection
