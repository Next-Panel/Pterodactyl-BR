@extends('layouts.admin')

@section('title')
    Hosts de Banco de Dados &rarr; Visualizar &rarr; {{ $host->name }}
@endsection

@section('content-header')
    <h1>{{ $host->name }}<small>Visualizando bancos de dados associados e detalhes para este host de banco de dados.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administrador</a></li>
        <li><a href="{{ route('admin.databases') }}">Hosts de Banco de Dados</a></li>
        <li class="active">{{ $host->name }}</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.databases.view', $host->id) }}" method="POST">
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalhes do Host</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">Nome</label>
                        <input type="text" id="pName" name="name" class="form-control" value="{{ old('name', $host->name) }}" />
                    </div>
                    <div class="form-group">
                        <label for="pHost" class="form-label">Host</label>
                        <input type="text" id="pHost" name="host" class="form-control" value="{{ old('host', $host->host) }}" />
                        <p class="text-muted small">O endereço IP ou FQDN que deve ser usado ao tentar se conectar a este host MySQL <em>do painel</em> para adicionar nEggs bancos de dados.</p>
                    </div>
                    <div class="form-group">
                        <label for="pPort" class="form-label">Porta</label>
                        <input type="text" id="pPort" name="port" class="form-control" value="{{ old('port', $host->port) }}" />
                        <p class="text-muted small">A porta em que o MySQL está sendo executado para este host.</p>
                    </div>
                    <div class="form-group">
                        <label for="pNodeId" class="form-label">Node Vinculado</label>
                        <select name="node_id" id="pNodeId" class="form-control">
                            <option value="">Nenhum</option>
                            @foreach($locations as $location)
                                <optgroup label="{{ $location->short }}">
                                    @foreach($location->nodes as $node)
                                        <option value="{{ $node->id }}" {{ $host->node_id !== $node->id ?: 'selected' }}>{{ $node->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <p class="text-muted small">Esta configuração não faz nada além de padronizar para este host de banco de dados ao adicionar um banco de dados a um servidor no Node selecionado.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalhes do Usuário</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pUsername" class="form-label">Usuário</label>
                        <input type="text" name="username" id="pUsername" class="form-control" value="{{ old('username', $host->username) }}" />
                        <p class="text-muted small">O nome de usuário de uma conta que tenha permissões suficientes para criar nEggs usuários e bancos de dados no sistema.</p>
                    </div>
                    <div class="form-group">
                        <label for="pPassword" class="form-label">Senha</label>
                        <input type="password" name="password" id="pPassword" class="form-control" />
                        <p class="text-muted small">A senha da conta definida. Deixe em branco para continuar usando a senha atribuída.</p>
                    </div>
                    <hr />
                    <p class="text-danger small text-left">A conta definida para este host de banco de dados <strong>deve</strong> ter a permissão <code>WITH GRANT OPTION</code>. Se a conta definida não tiver essa permissão, as solicitações para criar bancos de dados <em>falharão</em>. <strong>Não use os mesmos detalhes de conta para o MySQL que você definiu para este painel.</strong></p>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">Salvar</button>
                    <button name="_method" value="DELETE" class="btn btn-sm btn-danger pull-left muted muted-hover"><i class="fa fa-trash-o"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Bancos de Dados</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Servidor</th>
                        <th>Nome do Banco de Dados</th>
                        <th>Usuário</th>
                        <th>Conexões de</th>
                        <th>Máx. Conexões</th>
                        <th></th>
                    </tr>
                    @foreach($databases as $database)
                        <tr>
                            <td class="middle"><a href="{{ route('admin.servers.view', $database->getRelation('server')->id) }}">{{ $database->getRelation('server')->name }}</a></td>
                            <td class="middle">{{ $database->database }}</td>
                            <td class="middle">{{ $database->username }}</td>
                            <td class="middle">{{ $database->remote }}</td>
                            @if($database->max_connections != null)
                                <td class="middle">{{ $database->max_connections }}</td>
                            @else
                                <td class="middle">Ilimitado</td>
                            @endif
                            <td class="text-center">
                                <a href="{{ route('admin.servers.view.database', $database->getRelation('server')->id) }}">
                                    <button class="btn btn-xs btn-primary">Gerenciar</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @if($databases->hasPages())
                <div class="box-footer with-border">
                    <div class="col-md-12 text-center">{!! $databases->render() !!}</div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $('#pNodeId').select2();
    </script>
@endsection