@extends('adminlte::page')


@section('content_header')
    <h1>{{ __('Transferência') }}</h1>
@stop

@section('title') {{ __('Transferência') }} @stop

@section('content')
@include('admin.includes.alerts')

<div class='card'>
    <h5 class='card-header'>Usuários encontrados ({{$data->count()}})</h5>
    <div class='card-body'>
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>{!! __('Nome') !!}</th>
                    <th>{!! __('E-mail') !!}</th>
                    <th style='width:1px'></th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $rs)
                <tr>
                    <td>{!! $rs->name !!}</td>
                    <td>{!! $rs->email !!}</td>
                    <td>
                        <a href="{{ route('admin.balance.transfer.create.get', $rs->uuid) }}"><i class="fas fa-exchange-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop