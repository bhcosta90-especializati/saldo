@extends('adminlte::page')


@section('content_header')
    <h1>{{ __('Recarga') }}</h1>
@stop

@section('title') {{ __('Recarga') }} @stop

@section('content')
@include('admin.includes.alerts')

<div class='card'>
    <h5 class='card-header'>Cadastrar nova recarga</h5>
    <div class='card-body'>
        {!! form($form) !!}
    </div>
</div>
@stop