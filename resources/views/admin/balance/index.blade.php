@extends('adminlte::page')


@section('content_header')
    <h1>Saldo</h1>
@stop

@section('title') {{ __('Saldo') }} @stop


@section('content')

@include('admin.includes.alerts')

<div class="small-box bg-gray">
    <div class="inner">
        <h3>R$ {{ Str::number_format($balance) }}</h3>
        <a href="{{ route('admin.balance.deposit.index') }}" class='btn btn-primary btn-sm'>
            <i class="fas fa-cart-plus"></i>
            Recarregar
        </a>
        @if($balance > 0)
            <a href="{{ route('admin.balance.withdraw.index') }}" class='btn btn-danger btn-sm'>
                <i class="fas fa-cart-arrow-down"></i>
                Sacar
            </a>

            <a href="{{ route('admin.balance.transfer.index') }}" class='btn btn-info btn-sm'>
                <i class="fas fa-exchange-alt"></i>
                Transferir
            </a>
        @endif
    </div>
    <div class="icon">
        <i class="fas fa-money-check-alt "></i>
    </div>
    <a href="{{ route('admin.transaction.index') }}" class="small-box-footer">
        {{ __('Histórico de transações') }} <i class="fa fa-arrow-circle-right"></i>
    </a>
</div>
@stop