@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'advanced'])

@section('title')
    Configurações Avançadas
@endsection

@section('content-header')
    <h1>Configurações Avançadas<small>Configure as configurações avançadas do Pterodactyl.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administrador</a></li>
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
                                        <option value="true">Ativado</option>
                                        <option value="false" @if(old('recaptcha:enabled', config('recaptcha.enabled')) == '0') selected @endif>Desativado</option>
                                    </select>
                                    <p class="text-muted small">Se ativado, os formulários de login e redefinição de senha farão uma verificação de captcha silenciosa e exibirão um captcha visível, se necessário.</p>
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
                                    <p class="text-muted small">Usado para comunicação entre seu site e o Google. Certifique-se de mantê-lo em segredo.</p>
                                </div>
                            </div>
                        </div>
                        @if($showRecaptchaWarning)
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="alert alert-warning no-margin">
                                        Você está usando atualmente as chaves reCAPTCHA que foram enviadas com este Painel. Para maior segurança, é recomendável <a href="https://www.google.com/recaptcha/admin">gerar novas chaves reCAPTCHA invisíveis</a> que estejam vinculadas especificamente ao seu site.
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
                                <label class="control-label">Tempo Limite de Conexão</label>
                                <div>
                                    <input type="number" required class="form-control" name="pterodactyl:guzzle:connect_timeout" value="{{ old('pterodactyl:guzzle:connect_timeout', config('pterodactyl.guzzle.connect_timeout')) }}">
                                    <p class="text-muted small">O tempo em segundos a aguardar a abertura de uma conexão antes de lançar um erro.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Tempo Limite da Solicitação</label>
                                <div>
                                    <input type="number" required class="form-control" name="pterodactyl:guzzle:timeout" value="{{ old('pterodactyl:guzzle:timeout', config('pterodactyl.guzzle.timeout')) }}">
                                    <p class="text-muted small">O tempo em segundos a aguardar a conclusão de uma solicitação antes de lançar um erro.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Criação Automática de Alocação</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Status</label>
                                <div>
                                    <select class="form-control" name="pterodactyl:client_features:allocations:enabled">
                                        <option value="false">Desativado</option>
                                        <option value="true" @if(old('pterodactyl:client_features:allocations:enabled', config('pterodactyl.client_features.allocations.enabled'))) selected @endif>Ativado</option>
                                    </select>
                                    <p class="text-muted small">Se ativado, os usuários terão a opção de criar automaticamente novas alocações para seu servidor através do frontend.</p>
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