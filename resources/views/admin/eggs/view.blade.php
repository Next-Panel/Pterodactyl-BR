@extends('layouts.admin')

@section('title')
    Nests &rarr; Egg: {{ $egg->name }}
@endsection

@section('content-header')
    <h1>{{ $egg->name }}<small>{{ str_limit($egg->description, 50) }}</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administrador</a></li>
        <li><a href="{{ route('admin.nests') }}">Nests</a></li>
        <li><a href="{{ route('admin.nests.view', $egg->nest->id) }}">{{ $egg->nest->name }}</a></li>
        <li class="active">{{ $egg->name }}</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{ route('admin.nests.egg.view', $egg->id) }}">Configuração</a></li>
                <li><a href="{{ route('admin.nests.egg.variables', $egg->id) }}">Variáveis</a></li>
                <li><a href="{{ route('admin.nests.egg.scripts', $egg->id) }}">Script de Instalação</a></li>
            </ul>
        </div>
    </div>
</div>
<form action="{{ route('admin.nests.egg.view', $egg->id) }}" enctype="multipart/form-data" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="form-group no-margin-bottom">
                                <label for="pName" class="control-label">Arquivo do Egg</label>
                                <div>
                                    <input type="file" name="import_file" class="form-control" style="border: 0;margin-left:-10px;" />
                                    <p class="text-muted small no-margin-bottom">Se você deseja substituir as configurações deste Egg enviando um Novo arquivo JSON, basta selecioná-lo aqui e pressionar "Atualizar Egg". Isso não alterará nenhuma string de inicialização ou imagem do Docker existente para servidores existentes.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            {!! csrf_field() !!}
                            <button type="submit" name="_method" value="PUT" class="btn btn-sm btn-danger pull-right">Atualizar Egg</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{ route('admin.nests.egg.view', $egg->id) }}" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Configuração</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pName" class="control-label">Nome <span class="field-required"></span></label>
                                <input type="text" id="pName" name="name" value="{{ $egg->name }}" class="form-control" />
                                <p class="text-muted small">Um nome simples e legível para usar como identificador para este Egg.</p>
                            </div>
                            <div class="form-group">
                                <label for="pUuid" class="control-label">UUID</label>
                                <input type="text" id="pUuid" readonly value="{{ $egg->uuid }}" class="form-control" />
                                <p class="text-muted small">Este é o identificador globalmente exclusivo para este Egg que o Daemon usa como identificador.</p>
                            </div>
                            <div class="form-group">
                                <label for="pAuthor" class="control-label">Autor</label>
                                <input type="text" id="pAuthor" readonly value="{{ $egg->author }}" class="form-control" />
                                <p class="text-muted small">O autor desta versão do Egg. O upload de uma nova configuração de Egg de um autor diferente mudará isso.</p>
                            </div>
                            <div class="form-group">
                                <label for="pDockerImage" class="control-label">Imagens Docker <span class="field-required"></span></label>
                                <textarea id="pDockerImages" name="docker_images" class="form-control" rows="4">{{ implode(PHP_EOL, $images) }}</textarea>
                                <p class="text-muted small">
                                    As imagens docker disponíveis para os servidores que usam este Egg. Insira uma por linha. Os usuários
                                    poderão selecionar desta lista de imagens se mais de um valor for fornecido.
                                    Opcionalmente, um nome de exibição pode ser fornecido prefixando a imagem com o nome
                                    seguido por um caractere de barra vertical e, em seguida, o URL da imagem. Exemplo: <code>Nome de Exibição|ghcr.io/my/egg</code>
                                </p>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-primary no-margin-bottom">
                                    <input id="pForceOutgoingIp" name="force_outgoing_ip" type="checkbox" value="1" @if($egg->force_outgoing_ip) checked @endif />
                                    <label for="pForceOutgoingIp" class="strong">Forçar IP de Saída</label>
                                    <p class="text-muted small">
                                        Força todo o tráfego de rede de saída a ter seu IP de origem NATado para o IP da alocação primária do servidor.
                                        Necessário para que certos jogos funcionem corretamente quando o Node tem vários endereços IP públicos.
                                        <br>
                                        <strong>
                                            Ativar esta opção desativará a rede interna para quaisquer servidores que usem este Egg,
                                            fazendo com que eles não consigam acessar internamente outros servidores no mesmo Node.
                                        </strong>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pDescription" class="control-label">Descrição</label>
                                <textarea id="pDescription" name="description" class="form-control" rows="8">{{ $egg->description }}</textarea>
                                <p class="text-muted small">Uma descrição deste Egg que será exibida em todo o Painel, conforme necessário.</p>
                            </div>
                            <div class="form-group">
                                <label for="pStartup" class="control-label">Comando de Inicialização <span class="field-required"></span></label>
                                <textarea id="pStartup" name="startup" class="form-control" rows="8">{{ $egg->startup }}</textarea>
                                <p class="text-muted small">O comando de inicialização padrão que deve ser usado para nEggs servidores que usam este Egg.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigFeatures" class="control-label">Recursos</label>
                                <div>
                                    <select class="form-control" name="features[]" id="pConfigFeatures" multiple>
                                        @foreach(($egg->features ?? []) as $feature)
                                            <option value="{{ $feature }}" selected>{{ $feature }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-muted small">Recursos adicionais pertencentes ao Egg. Útil para configurar modificações adicionais do painel.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Gerenciamento de Processos</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="alert alert-warning">
                                <p>As seguintes opções de configuração não devem ser editadas a menos que você entenda como este sistema funciona. Se modificadas incorretamente, é possível que o daemon quebre.</p>
                                <p>Todos os campos são obrigatórios, a menos que você selecione uma opção separada no menu suspenso 'Copiar Configurações de', nesse caso, os campos podem ser deixados em branco para usar os valores desse Egg.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFrom" class="form-label">Copiar Configurações de</label>
                                <select name="config_from" id="pConfigFrom" class="form-control">
                                    <option value="">Nenhum</option>
                                    @foreach($egg->nest->eggs as $o)
                                        <option value="{{ $o->id }}" {{ ($egg->config_from !== $o->id) ?: 'selected' }}>{{ $o->name }} &lt;{{ $o->author }}&gt;</option>
                                    @endforeach
                                </select>
                                <p class="text-muted small">Se você gostaria de usar as configurações padrão de outro Egg, selecione-o no menu acima.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStop" class="form-label">Comando de Parada</label>
                                <input type="text" id="pConfigStop" name="config_stop" class="form-control" value="{{ $egg->config_stop }}" />
                                <p class="text-muted small">O comando que deve ser enviado aos processos do servidor para pará-los graciosamente. Se você precisar enviar um <code>SIGINT</code>, você deve inserir <code>^C</code> aqui.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigLogs" class="form-label">Configuração de Log</label>
                                <textarea data-action="handle-tabs" id="pConfigLogs" name="config_logs" class="form-control" rows="6">{{ ! is_null($egg->config_logs) ? json_encode(json_decode($egg->config_logs), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">Isso deve ser uma representação JSON de onde os arquivos de log são armazenados e se o daemon deve ou não criar logs personalizados.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFiles" class="form-label">Arquivos de Configuração</label>
                                <textarea data-action="handle-tabs" id="pConfigFiles" name="config_files" class="form-control" rows="6">{{ ! is_null($egg->config_files) ? json_encode(json_decode($egg->config_files), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">Isso deve ser uma representação JSON dos arquivos de configuração a serem modificados e quais partes devem ser alteradas.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStartup" class="form-label">Configuração de Inicialização</label>
                                <textarea data-action="handle-tabs" id="pConfigStartup" name="config_startup" class="form-control" rows="6">{{ ! is_null($egg->config_startup) ? json_encode(json_decode($egg->config_startup), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">Isso deve ser uma representação JSON de quais valores o daemon deve procurar ao iniciar um servidor para determinar a conclusão.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" name="_method" value="PATCH" class="btn btn-primary btn-sm pull-right">Salvar</button>
                    <a href="{{ route('admin.nests.egg.export', $egg->id) }}" class="btn btn-sm btn-info pull-right" style="margin-right:10px;">Exportar</a>
                    <button id="deleteButton" type="submit" name="_method" value="DELETE" class="btn btn-danger btn-sm muted muted-hover">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#pConfigFrom').select2();
    $('#deleteButton').on('mouseenter', function (event) {
        $(this).find('i').html(' Excluir Egg');
    }).on('mouseleave', function (event) {
        $(this).find('i').html('');
    });
    $('textarea[data-action="handle-tabs"]').on('keydown', function(event) {
        if (event.keyCode === 9) {
            event.preventDefault();

            var curPos = $(this)[0].selectionStart;
            var prepend = $(this).val().substr(0, curPos);
            var append = $(this).val().substr(curPos);

            $(this).val(prepend + '    ' + append);
        }
    });
    $('#pConfigFeatures').select2({
        tags: true,
        selectOnClose: false,
        tokenSeparators: [',', ' '],
    });
    </script>
@endsection