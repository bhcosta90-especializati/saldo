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
        {!! form($form) !!}
    </div>
</div>
@stop