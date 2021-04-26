@extends('adminlte::page')


@section('content_header')
    <h1>Saque</h1>
@stop

@section('title') {{ __('Saque') }} @stop

@section('content')
<div class='card'>
    <h5 class='card-header'>Realizar saque</h5>
    <div class='card-body'>
        {!! form($form) !!}
    </div>
</div>
@stop