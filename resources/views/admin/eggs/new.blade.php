@extends('layouts.admin')

@section('title')
    Nests &rarr; Novo Egg
@endsection

@section('content-header')
    <h1>Novo Egg<small>Crie um novo Egg para atribuir a servidores.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administrador</a></li>
        <li><a href="{{ route('admin.nests') }}">Nests</a></li>
        <li class="active">Novo Egg</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.nests.egg.new') }}" method="POST">
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
                                <label for="pNestId" class="form-label">Nest Associado</label>
                                <div>
                                    <select name="nest_id" id="pNestId">
                                        @foreach($nests as $nest)
                                            <option value="{{ $nest->id }}" {{ old('nest_id') != $nest->id ?: 'selected' }}>{{ $nest->name }} &lt;{{ $nest->author }}&gt;</option>
                                        @endforeach
                                    </select>
                                    <p class="text-muted small">Pense em um Nest como uma categoria. Você pode colocar vários Eggs em um Nest, mas considere colocar apenas Eggs que estão relacionados entre si em cada Nest.</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pName" class="form-label">Nome</label>
                                <input type="text" id="pName" name="name" value="{{ old('name') }}" class="form-control" />
                                <p class="text-muted small">Um nome simples e legível para ser usado como um identificador para este Egg. Isso é o que os usuários verão como o tipo de servidor de jogo deles.</p>
                            </div>
                            <div class="form-group">
                                <label for="pDescription" class="form-label">Descrição</label>
                                <textarea id="pDescription" name="description" class="form-control" rows="8">{{ old('description') }}</textarea>
                                <p class="text-muted small">Uma descrição para este Egg.</p>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-primary no-margin-bottom">
                                    <input id="pForceOutgoingIp" name="force_outgoing_ip" type="checkbox" value="1" {{ \Pterodactyl\Helpers\Utilities::checked('force_outgoing_ip', 0) }} />
                                    <label for="pForceOutgoingIp" class="strong">Forçar IP de Saída</label>
                                    <p class="text-muted small">
                                        Força todo o tráfego de rede de saída a ter seu IP de Origem NATed para o IP da alocação primária do servidor.
                                        Necessário para que certos jogos funcionem corretamente quando o Node tem vários endereços IP públicos.
                                        <br>
                                        <strong>
                                            Ativar esta opção desabilitará a rede interna para qualquer servidor que use este egg,
                                            fazendo com que eles não consigam acessar internamente outros servidores no mesmo node.
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pDockerImage" class="control-label">Imagens Docker</label>
                                <textarea id="pDockerImages" name="docker_images" rows="4" placeholder="quay.io/pterodactyl/service" class="form-control">{{ old('docker_images') }}</textarea>
                                <p class="text-muted small">As imagens Docker disponíveis para os servidores que usam este egg. Insira uma por linha. Os usuários poderão selecionar desta lista de imagens se mais de um valor for fornecido.</p>
                            </div>
                            <div class="form-group">
                                <label for="pStartup" class="control-label">Comando de Inicialização</label>
                                <textarea id="pStartup" name="startup" class="form-control" rows="10">{{ old('startup') }}</textarea>
                                <p class="text-muted small">O comando de inicialização padrão que deve ser usado para nEggs servidores criados com este Egg. Você pode alterá-lo por servidor, conforme necessário.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigFeatures" class="control-label">Recursos</label>
                                <div>
                                    <select class="form-control" name="features[]" id="pConfigFeatures" multiple>
                                    </select>
                                    <p class="text-muted small">Recursos adicionais pertencentes ao egg. Útil para configurar modificações adicionais no painel.</p>
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
                                <p>Todos os campos são obrigatórios, a menos que você selecione uma opção separada no menu 'Copiar Configurações De', neste caso, os campos podem ser deixados em branco para usar os valores daquela opção.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFrom" class="form-label">Copiar Configurações De</label>
                                <select name="config_from" id="pConfigFrom" class="form-control">
                                    <option value="">Nenhum</option>
                                </select>
                                <p class="text-muted small">Se você deseja usar as configurações padrão de outro Egg, selecione-o no menu acima.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStop" class="form-label">Comando de Parada</label>
                                <input type="text" id="pConfigStop" name="config_stop" class="form-control" value="{{ old('config_stop') }}" />
                                <p class="text-muted small">O comando que deve ser enviado aos processos do servidor para pará-los graciosamente. Se você precisa enviar um <code>SIGINT</code>, digite <code>^C</code> aqui.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigLogs" class="form-label">Configuração de Logs</label>
                                <textarea data-action="handle-tabs" id="pConfigLogs" name="config_logs" class="form-control" rows="6">{{ old('config_logs') }}</textarea>
                                <p class="text-muted small">Isso deve ser uma representação JSON de onde os arquivos de log são armazenados e se o daemon deve criar logs personalizados.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFiles" class="form-label">Arquivos de Configuração</label>
                                <textarea data-action="handle-tabs" id="pConfigFiles" name="config_files" class="form-control" rows="6">{{ old('config_files') }}</textarea>
                                <p class="text-muted small">Isso deve ser uma representação JSON dos arquivos de configuração a serem modificados e quais partes devem ser alteradas.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStartup" class="form-label">Configuração de Inicialização</label>
                                <textarea data-action="handle-tabs" id="pConfigStartup" name="config_startup" class="form-control" rows="6">{{ old('config_startup') }}</textarea>
                                <p class="text-muted small">Isso deve ser uma representação JSON dos valores que o daemon deve procurar ao iniciar um servidor para determinar a conclusão.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-success btn-sm pull-right">Criar</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/lodash/lodash.js') !!}
    <script>
    $(document).ready(function() {
        $('#pNestId').select2().change();
        $('#pConfigFrom').select2();
    });
    $('#pNestId').on('change', function (event) {
        $('#pConfigFrom').html('<option value="">Nenhum</option>').select2({
            data: $.map(_.get(Pterodactyl.nests, $(this).val() + '.eggs', []), function (item) {
                return {
                    id: item.id,
                    text: item.name + ' <' + item.author + '>',
                };
            }),
        });
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