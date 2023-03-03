@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'advanced'])

@section('title')
    Ajustes avançados
@endsection

@section('content-header')
    <h1>Avançado<small>Configurar configurações avançadas para o Painel.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administração</a></li>
        <li class="active">Configurações</li>
    </ol>
@endsection

@section('content')
    @yield('settings::nav')
    <div class="row">
        <div class="col-xs-12">
            <form action="" method="POST">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">reCAPTCHA</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Status</label>
                                <div>
                                    <select class="form-control" name="recaptcha:enabled">
                                        <option value="true">Habilitado</option>
                                        <option value="false" @if(old('recaptcha:enabled', config('recaptcha.enabled')) == '0') selected @endif>Desabilitado</option>
                                    </select>
                                    <p class="text-muted small">Se ativado, os formulários de login e de redefinição de senha farão uma verificação silenciosa do captcha e exibirão um captcha visível, se necessário.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Chave do Site</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:website_key" value="{{ old('recaptcha:website_key', config('recaptcha.website_key')) }}">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Chave Secreta</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:secret_key" value="{{ old('recaptcha:secret_key', config('recaptcha.secret_key')) }}">
                                    <p class="text-muted small">Utilizado para a comunicação entre seu site e o Google. Não se esqueça de guardá-lo em segredo.</p>
                                </div>
                            </div>
                        </div>
                        @if($showRecaptchaWarning)
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="alert alert-warning no-margin">
                                    Atualmente você está usando as chaves reCAPTCHA que foram enviadas com este Painel. Para maior segurança, é recomendado <a href="https://www.google.com/recaptcha/admin"> gerar novas chaves reCAPTCHA invisíveis </a> que estejam especificamente ligados ao seu website.
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Conexões HTTP</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Tempo limite para conexão</label>
                                <div>
                                    <input type="number" required class="form-control" name="pterodactyl:guzzle:connect_timeout" value="{{ old('pterodactyl:guzzle:connect_timeout', config('pterodactyl.guzzle.connect_timeout')) }}">
                                    <p class="text-muted small">O tempo em segundos para esperar que uma conexão seja aberta antes de lançar um erro.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Solicitar tempo limite</label>
                                <div>
                                    <input type="number" required class="form-control" name="pterodactyl:guzzle:timeout" value="{{ old('pterodactyl:guzzle:timeout', config('pterodactyl.guzzle.timeout')) }}">
                                    <p class="text-muted small">A quantidade de tempo em segundos para esperar que um pedido seja concluído antes de lançar um erro.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Criação automática de alocações</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Status</label>
                                <div>
                                    <select class="form-control" name="pterodactyl:client_features:allocations:enabled">
                                        <option value="false">Desabilitado</option>
                                        <option value="true" @if(old('pterodactyl:client_features:allocations:enabled', config('pterodactyl.client_features.allocations.enabled'))) selected @endif>Habilitado</option>
                                    </select>
                                    <p class="text-muted small">Se habilitados, os usuários terão a opção de criar automaticamente novas alocações para seu servidor através do frontend.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Porta Inicial</label>
                                <div>
                                    <input type="number" class="form-control" name="pterodactyl:client_features:allocations:range_start" value="{{ old('pterodactyl:client_features:allocations:range_start', config('pterodactyl.client_features.allocations.range_start')) }}">
                                    <p class="text-muted small">A porta inicial no intervalo que pode ser alocada automaticamente.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Porta Final</label>
                                <div>
                                    <input type="number" class="form-control" name="pterodactyl:client_features:allocations:range_end" value="{{ old('pterodactyl:client_features:allocations:range_end', config('pterodactyl.client_features.allocations.range_end')) }}">
                                    <p class="text-muted small">A porta final no intervalo que pode ser alocada automaticamente.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
