@extends('adminlte::page')


@section('content_header')
    <h1>{{ __('TransferĂȘncia') }}</h1>
@stop

@section('title') {{ __('TransferĂȘncia') }} @stop

@section('content')
@include('admin.includes.alerts')

<div class='card'>
    <h5 class='card-header'>Realizar transferĂȘncia</h5>
    <div class='card-body'>
        <p><b>Recebedor:</b> {{ $user->name }}</p>
        <p><b>Seu saldo:</b> {{ Str::number_format($balance) }}</p>
        {!! form($form) !!}
    </div>
</div>
@stop