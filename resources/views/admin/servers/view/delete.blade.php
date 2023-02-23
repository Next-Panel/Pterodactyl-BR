@extends('layouts.admin')

@section('title')
Servidor — {{ $server->name }}: Deletar
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Excluir este servidor do painel.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administração</a></li>
        <li><a href="{{ route('admin.servers') }}">Servidores</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Deletar</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Excluir servidor com segurança</h3>
            </div>
            <div class="box-body">
                <p>Esta ação tentará excluir o servidor tanto do painel quanto do daemon. Se qualquer um deles relatar um erro, a ação será cancelada.</p>
                <p class="text-danger small">A exclusão de um servidor é uma ação irreversível. <strong>Todos os dados do servidor</strong> (incluindo os arquivos dos usuários) serão removidos do sistema.</p>
            </div>
            <div class="box-footer">
                <form id="deleteform" action="{{ route('admin.servers.view.delete', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <button id="deletebtn" class="btn btn-danger">Apagar este servidor de forma segura</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Excluir à força o servidor</h3>
            </div>
            <div class="box-body">
                <p>Esta ação tentará excluir o servidor tanto do painel quanto do daemon. Se o daemon não responder, ou relatar um erro, a exclusão continuará.</p>
                <p class="text-danger small">A exclusão de um servidor é uma ação irreversível. <strong>Todos os dados do servidor</strong> (incluindo os arquivos dos usuários) serão removidos do sistema. Este método pode deixar arquivos soltos em seu daemon se ele relatar um erro.</p>
            </div>
            <div class="box-footer">
                <form id="forcedeleteform" action="{{ route('admin.servers.view.delete', $server->id) }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="force_delete" value="1" />
                    <button id="forcedeletebtn"" class="btn btn-danger">Excluir à força este servidor</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#deletebtn').click(function (event) {
        event.preventDefault();
        swal({
            title: '',
            type: 'warning',
            text: 'Você tem certeza de que quer excluir este servidor? Não há como voltar atrás, todos os dados serão imediatamente removidos.',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            confirmButtonColor: '#d9534f',
            closeOnConfirm: false
        }, function () {
            $('#deleteform').submit()
        });
    });

    $('#forcedeletebtn').click(function (event) {
        event.preventDefault();
        swal({
            title: '',
            type: 'warning',
            text: 'Você tem certeza de que quer excluir este servidor? Não há como voltar atrás, todos os dados serão imediatamente removidos.',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            confirmButtonColor: '#d9534f',
            closeOnConfirm: false
        }, function () {
            $('#forcedeleteform').submit()
        });
    });
    </script>
@endsection
