@extends('layouts.admin')

@section('title')
    Servidor — {{ $server->name }}: Detalhes da Build
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>Controle as alocações e os recursos do sistema para este servidor.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administrador</a></li>
        <li><a href="{{ route('admin.servers') }}">Servidores</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">Configuração da Build</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<div class="row">
    <form action="{{ route('admin.servers.view.build', $server->id) }}" method="POST">
        <div class="col-sm-5">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Gerenciamento de Recursos</h3>
                </div>
                <div class="box-body">
                <div class="form-group">
                        <label for="cpu" class="control-label">Limite de CPU</label>
                        <div class="input-group">
                            <input type="text" name="cpu" class="form-control" value="{{ old('cpu', $server->cpu) }}"/>
                            <span class="input-group-addon">%</span>
                        </div>
                        <p class="text-muted small">Cada núcleo <em>virtual</em> (thread) no sistema é considerado <code>100%</code>. Definir este valor como <code>0</code> permitirá que um servidor use o tempo da CPU sem restrições.</p>
                    </div>
                    <div class="form-group">
                        <label for="threads" class="control-label">Fixação de CPU</label>
                        <div>
                            <input type="text" name="threads" class="form-control" value="{{ old('threads', $server->threads) }}"/>
                        </div>
                        <p class="text-muted small"><strong>Avançado:</strong> Insira os núcleos de CPU específicos nos quais este processo pode ser executado ou deixe em branco para permitir todos os núcleos. Pode ser um único número ou uma lista separada por vírgulas. Exemplo: <code>0</code>, <code>0-1,3</code> ou <code>0,1,3,4</code>.</p>
                    </div>
                    <div class="form-group">
                        <label for="memory" class="control-label">Memória Alocada</label>
                        <div class="input-group">
                            <input type="text" name="memory" data-multiplicator="true" class="form-control" value="{{ old('memory', $server->memory) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">A quantidade máxima de memória permitida para este contêiner. Definir como <code>0</code> permitirá memória ilimitada em um contêiner.</p>
                    </div>
                    <div class="form-group">
                        <label for="swap" class="control-label">Swap Alocado</label>
                        <div class="input-group">
                            <input type="text" name="swap" data-multiplicator="true" class="form-control" value="{{ old('swap', $server->swap) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">Definir como <code>0</code> desativará o espaço de troca neste servidor. Definir como <code>-1</code> permitirá troca ilimitada.</p>
                    </div>
                    <div class="form-group">
                        <label for="cpu" class="control-label">Limite de Espaço em Disco</label>
                        <div class="input-group">
                            <input type="text" name="disk" class="form-control" value="{{ old('disk', $server->disk) }}"/>
                            <span class="input-group-addon">MiB</span>
                        </div>
                        <p class="text-muted small">Este servidor não terá permissão para inicializar se estiver usando mais do que essa quantidade de espaço. Se um servidor ultrapassar esse limite durante a execução, ele será interrompido com segurança e bloqueado até que haja espaço suficiente disponível. Defina como <code>0</code> para permitir o uso ilimitado de disco.</p>
                    </div>
                    <div class="form-group">
                        <label for="io" class="control-label">Proporção de E/S de Bloco</label>
                        <div>
                            <input type="text" name="io" class="form-control" value="{{ old('io', $server->io) }}"/>
                        </div>
                        <p class="text-muted small"><strong>Avançado</strong>: O desempenho de E/S deste servidor em relação a outros contêineres <em>em execução</em> no sistema. O valor deve estar entre <code>10</code> e <code>1000</code>.</code></p>
                    </div>
                    <div class="form-group">
                        <label for="cpu" class="control-label">OOM Killer</label>
                        <div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pOomKillerEnabled" value="0" name="oom_disabled" @if(!$server->oom_disabled)checked @endif>
                                <label for="pOomKillerEnabled">Ativado</label>
                            </div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pOomKillerDisabled" value="1" name="oom_disabled" @if($server->oom_disabled)checked @endif>
                                <label for="pOomKillerDisabled">Desativado</label>
                            </div>
                            <p class="text-muted small">
                                Ativar o OOM killer pode fazer com que os processos do servidor saiam inesperadamente.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Limites de Recursos do Aplicativo</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-xs-6">
                                    <label for="database_limit" class="control-label">Limite de Banco de Dados</label>
                                    <div>
                                        <input type="text" name="database_limit" class="form-control" value="{{ old('database_limit', $server->database_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">O número total de bancos de dados que um usuário pode criar para este servidor.</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="allocation_limit" class="control-label">Limite de Alocação</label>
                                    <div>
                                        <input type="text" name="allocation_limit" class="form-control" value="{{ old('allocation_limit', $server->allocation_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">O número total de alocações que um usuário pode criar para este servidor.</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="backup_limit" class="control-label">Limite de Backup</label>
                                    <div>
                                        <input type="text" name="backup_limit" class="form-control" value="{{ old('backup_limit', $server->backup_limit) }}"/>
                                    </div>
                                    <p class="text-muted small">O número total de backups que podem ser criados para este servidor.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Gerenciamento de Alocação</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="pAllocation" class="control-label">Porta do Jogo</label>
                                <select id="pAllocation" name="allocation_id" class="form-control">
                                    @foreach ($assigned as $assignment)
                                        <option value="{{ $assignment->id }}"
                                            @if($assignment->id === $server->allocation_id)
                                                selected="selected"
                                            @endif
                                        >{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                    @endforeach
                                </select>
                                <p class="text-muted small">O endereço de conexão padrão que será usado para este servidor de jogo.</p>
                            </div>
                            <div class="form-group">
                                <label for="pAddAllocations" class="control-label">Atribuir Portas Adicionais</label>
                                <div>
                                    <select name="add_allocations[]" class="form-control" multiple id="pAddAllocations">
                                        @foreach ($unassigned as $assignment)
                                            <option value="{{ $assignment->id }}">{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="text-muted small">Observe que, devido a limitações de software, você não pode atribuir portas idênticas em IPs diferentes ao mesmo servidor.</p>
                            </div>
                            <div class="form-group">
                                <label for="pRemoveAllocations" class="control-label">Remover Portas Adicionais</label>
                                <div>
                                    <select name="remove_allocations[]" class="form-control" multiple id="pRemoveAllocations">
                                        @foreach ($assigned as $assignment)
                                            <option value="{{ $assignment->id }}">{{ $assignment->alias }}:{{ $assignment->port }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="text-muted small">Basta selecionar quais portas você gostaria de remover da lista acima. Se você quiser atribuir uma porta em um IP diferente que já esteja em uso, pode selecioná-la à esquerda e excluí-la aqui.</p>
                            </div>
                        </div>
                        <div class="box-footer">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary pull-right">Atualizar Configuração da Build</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#pAddAllocations').select2();
    $('#pRemoveAllocations').select2();
    $('#pAllocation').select2();
    </script>
@endsection