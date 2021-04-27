@extends('adminlte::page')


@section('content_header')
    <h1>{{ __('Histórico de Transações') }}</h1>
@stop

@section('title') {{ __('Histórico de Transações') }} @stop

@section('content')
@include('admin.includes.alerts')

<div class='card'>
    <div class='card-header'>
        <form class='form-inline' method='get' action="{{ route('admin.transaction.index') }}">
            <input type="text" name="id" placeholder="ID" class='form-control' value="{{ $form['id'] ?? '' }}">
            <input type="email" name="email" placeholder="E-mail de quem enviou" value="{{ $form['email'] ?? '' }}" class='form-control'>
            <input type="date" name="date" placeholder="Data da transação" value="{{ $form['date'] ?? '' }}" class='form-control'>
            <select class='form-control' name='type'>
                <option value="">Selecione...</option>
                @foreach($types as $id => $rs)
                    <option value="{{ $id }}" {{ $id == ($form['type'] ?? '') ? "selected" : ""}}>{{ $rs }}</option>
                @endforeach
            </select>
            <button class='btn btn-secondary'>Buscar</button>
        </form>
    </div>
    <table class='table table-striped table-bordered table-hover' style='margin:0'>
        <thead>
            <tr>
                <th style='width:300px'></th>
                <th style='width:1px'>Valor</th>
                <th style='width:1px'>Saldo</th>
                <th style='width:140px'>Tipo</th>
                <th style='width:1px'>Data</th>
                <th>Quem enviou</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $rs)
            <tr>
                <td><pre style='padding:3px 0 0 0; margin:0'>{{ $rs->uuid }}</pre></td>
                <td>{{ Str::number_format($rs->amount) }}</td>
                <td>{{ Str::number_format($rs->total_after) }}</td>
                <td>{{ $rs->type($rs->type)}}</td>
                <td>{{ $rs->date->format('d/m/Y')}}</td>
                <td>{{ empty($rs->transaction_to) ? '-' : $rs->transaction_to->name}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($data->total() > $data->perPage())
        <div style='margin-left:20px;margin-top:15px'>{!! $data->appends($form)->links() !!}</div>
    @endif
</div>
@stop