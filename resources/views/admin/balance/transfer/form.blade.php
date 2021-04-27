@extends('adminlte::page')


@section('content_header')
    <h1>{{ __('Transferência') }}</h1>
@stop

@section('title') {{ __('Transferência') }} @stop

@section('content')
@include('admin.includes.alerts')

<div class='card'>
    <h5 class='card-header'>Realizar transferência</h5>
    <div class='card-body'>
        {!! form($form) !!}
    </div>
</div>
@stop