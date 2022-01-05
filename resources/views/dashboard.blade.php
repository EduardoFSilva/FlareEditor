@extends('layouts.master')
@php
$usePreloader = true;
$noSidebarElevation = true;
$menuSelectPath = ['categ' => 'none', 'submenu' => 'none'];
@endphp
@section('pageTitle')
    Dashboard
@endsection
@section('headerLinks')
<style type="text/css">
    .flareeditor-bg-dash{
        //background: linear-gradient(45deg, rgba(31,31,31,1) 0%, rgba(51,51,51,1) 50%, rgba(31,31,31,1) 100%);
    }
</style>
@endsection
@section('bodyContentWrapped')

@endsection
