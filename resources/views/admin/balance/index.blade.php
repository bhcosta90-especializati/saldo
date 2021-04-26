@extends('adminlte::page')


@section('content_header')
    <h1>Saldo</h1>
@stop

@section('title') {{ __('Saldo') }} @stop


@section('content')
<div class="small-box bg-green">
    <div class="inner">
        <h3>R$ {{ $balance }}</h3>

        <a href="{{ route('admin.balance.deposit.index') }}" class='btn btn-primary btn-sm'>Recarregar</a>
        <a href="{{ route('admin.balance.withdraw.index') }}" class='btn btn-danger btn-sm'>Sacar</a>
    </div>
    <div class="icon">
        <i class="fas fa-money-check-alt "></i>
    </div>
    <a href="#" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
    </a>
</div>
@stop