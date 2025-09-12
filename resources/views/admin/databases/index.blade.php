@extends('layouts.admin')

@section('title')
    Hosts de Banco de Dados
@endsection

@section('content-header')
    <h1>Hosts de Banco de Dados<small>Hosts de banco de dados nos quais os servidores podem ter bancos de dados criados.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administrador</a></li>
        <li class="active">Hosts de Banco de Dados</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de Hosts</h3>
                <div class="box-tools">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newHostModal">Criar Novo</button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Host</th>
                            <th>Porta</th>
                            <th>Usuário</th>
                            <th class="text-center">Bancos de Dados</th>
                            <th class="text-center">Node</th>
                        </tr>
                        @foreach ($hosts as $host)
                            <tr>
                                <td><code>{{ $host->id }}</code></td>
                                <td><a href="{{ route('admin.databases.view', $host->id) }}">{{ $host->name }}</a></td>
                                <td><code>{{ $host->host }}</code></td>
                                <td><code>{{ $host->port }}</code></td>
                                <td>{{ $host->username }}</td>
                                <td class="text-center">{{ $host->databases_count }}</td>
                                <td class="text-center">
                                    @if(! is_null($host->node))
                                        <a href="{{ route('admin.nodes.view', $host->node->id) }}">{{ $host->node->name }}</a>
                                    @else
                                        <span class="label label-default">Nenhum</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newHostModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.databases') }}" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Criar novo Host de Banco de Dados</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">Nome</label>
                        <input type="text" name="name" id="pName" class="form-control" />
                        <p class="text-muted small">Um identificador curto usado para distinguir esta localização das outras. Deve ter entre 1 e 60 caracteres, por exemplo, <code>us.nyc.lvl3</code>.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pHost" class="form-label">Host</label>
                            <input type="text" name="host" id="pHost" class="form-control" />
                            <p class="text-muted small">O endereço IP ou FQDN que deve ser usado ao tentar se conectar a este host MySQL <em>do painel</em> para adicionar nEggs bancos de dados.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPort" class="form-label">Porta</label>
                            <input type="text" name="port" id="pPort" class="form-control" value="3306"/>
                            <p class="text-muted small">A porta em que o MySQL está sendo executado para este host.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pUsername" class="form-label">Usuário</label>
                            <input type="text" name="username" id="pUsername" class="form-control" />
                            <p class="text-muted small">O nome de usuário de uma conta que tenha permissões suficientes para criar nEggs usuários e bancos de dados no sistema.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPassword" class="form-label">Senha</label>
                            <input type="password" name="password" id="pPassword" class="form-control" />
                            <p class="text-muted small">A senha da conta definida.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pNodeId" class="form-label">Node Vinculado</label>
                        <select name="node_id" id="pNodeId" class="form-control">
                            <option value="">Nenhum</option>
                            @foreach($locations as $location)
                                <optgroup label="{{ $location->short }}">
                                    @foreach($location->nodes as $node)
                                        <option value="{{ $node->id }}">{{ $node->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <p class="text-muted small">Esta configuração não faz nada além de padronizar para este host de banco de dados ao adicionar um banco de dados a um servidor no Node selecionado.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="text-danger small text-left">A conta definida para este host de banco de dados <strong>deve</strong> ter a permissão <code>WITH GRANT OPTION</code>. Se a conta definida não tiver essa permissão, as solicitações para criar bancos de dados <em>falharão</em>. <strong>Não use os mesmos detalhes de conta para o MySQL que você definiu para este painel.</strong></p>
                    {!! csrf_field() !!}
                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm">Criar</button>
                </div>
            </form>
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