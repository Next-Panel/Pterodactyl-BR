@extends('layouts.admin')

@section('title')
    Servidor — {{ $server->name }}: Gerenciar
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Ações adicionais para controlar este servidor.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administrador</a></li>
        <li><a href="{{ route('admin.servers') }}">Servidores</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Gerenciar</li>
    </ol>
@endsection

@section('content')
    @include('admin.servers.partials.navigation')
    <div class="row">
        <div class="col-sm-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Reinstalar Servidor</h3>
                </div>
                <div class="box-body">
                    <p>Isso reinstalará o servidor com os scripts de serviço atribuídos. <strong>Perigo!</strong> Isso pode sobrescrever os dados do servidor.</p>
                </div>
                <div class="box-footer">
                    @if($server->isInstalled())
                        <form action="{{ route('admin.servers.view.manage.reinstall', $server->id) }}" method="POST">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger">Reinstalar Servidor</button>
                        </form>
                    @else
                        <button class="btn btn-danger disabled">O Servidor Deve Ser Instalado Corretamente para Reinstalar</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Status da Instalação</h3>
                </div>
                <div class="box-body">
                    <p>Se você precisar alterar o status da instalação de desinstalado para instalado, ou vice-versa, pode fazê-lo com o botão abaixo.</p>
                </div>
                <div class="box-footer">
                    <form action="{{ route('admin.servers.view.manage.toggle', $server->id) }}" method="POST">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-primary">Alternar Status da Instalação</button>
                    </form>
                </div>
            </div>
        </div>

        @if(! $server->isSuspended())
            <div class="col-sm-4">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Suspender Servidor</h3>
                    </div>
                    <div class="box-body">
                        <p>Isso suspenderá o servidor, interromperá quaisquer processos em execução e bloqueará imediatamente o acesso do usuário aos seus arquivos ou o gerenciamento do servidor através do painel ou da API.</p>
                    </div>
                    <div class="box-footer">
                        <form action="{{ route('admin.servers.view.manage.suspension', $server->id) }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="action" value="suspend" />
                            <button type="submit" class="btn btn-warning @if(! is_null($server->transfer)) disabled @endif">Suspender Servidor</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reativar Servidor</h3>
                    </div>
                    <div class="box-body">
                        <p>Isso reativará o servidor e restaurará o acesso normal do usuário.</p>
                    </div>
                    <div class="box-footer">
                        <form action="{{ route('admin.servers.view.manage.suspension', $server->id) }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="action" value="unsuspend" />
                            <button type="submit" class="btn btn-success">Reativar Servidor</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        @if(is_null($server->transfer))
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transferir Servidor</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            Transfira este servidor para outro Node conectado a este painel.
                            <strong>Aviso!</strong> Este recurso não foi totalmente testado e pode conter bugs.
                        </p>
                    </div>

                    <div class="box-footer">
                        @if($canTransfer)
                            <button class="btn btn-success" data-toggle="modal" data-target="#transferServerModal">Transferir Servidor</button>
                        @else
                            <button class="btn btn-success disabled">Transferir Servidor</button>
                            <p style="padding-top: 1rem;">A transferência de um servidor requer mais de um Node configurado em seu painel.</p>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transferir Servidor</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            Este servidor está sendo transferido para outro Node.
                            A transferência foi iniciada em <strong>{{ $server->transfer->created_at }}</strong>
                        </p>
                    </div>

                    <div class="box-footer">
                        <button class="btn btn-success disabled">Transferir Servidor</button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="transferServerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.servers.view.manage.transfer', $server->id) }}" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Transferir Servidor</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="pNodeId">Node</label>
                                <select name="node_id" id="pNodeId" class="form-control">
                                    @foreach($locations as $location)
                                        <optgroup label="{{ $location->long }} ({{ $location->short }})">
                                            @foreach($location->nodes as $node)

                                                @if($node->id != $server->node_id)
                                                    <option value="{{ $node->id }}"
                                                            @if($location->id === old('location_id')) selected @endif
                                                    >{{ $node->name }}</option>
                                                @endif

                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <p class="small text-muted no-margin">O Node para o qual este servidor será transferido.</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="pAllocation">Alocação Padrão</label>
                                <select name="allocation_id" id="pAllocation" class="form-control"></select>
                                <p class="small text-muted no-margin">A alocação principal que será atribuída a este servidor.</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="pAllocationAdditional">Alocação(ões) Adicional(is)</label>
                                <select name="allocation_additional[]" id="pAllocationAdditional" class="form-control" multiple></select>
                                <p class="small text-muted no-margin">Alocações adicionais a serem atribuídas a este servidor na criação.</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        {!! csrf_field() !!}
                        <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success btn-sm">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/lodash/lodash.js') !!}

    @if($canTransfer)
        {!! Theme::js('js/admin/server/transfer.js') !!}
    @endif
@endsection