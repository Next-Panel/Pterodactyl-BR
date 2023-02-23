@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'basic'])

@section('title')
    Configurações
@endsection

@section('content-header')
    <h1>Configurações do Pterodactyl<small>Defina as configurações específicas do Pterodactyl para o Painel.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administração</a></li>
        <li class="active">Configurações</li>
    </ol>
@endsection

@section('content')
    @yield('settings::nav')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Ajustes do Painel</h3>
                </div>
                <form action="{{ route('admin.settings') }}" method="POST">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Nome da empresa</label>
                                <div>
                                    <input type="text" class="form-control" name="app:name" value="{{ old('app:name', config('app.name')) }}" />
                                    <p class="text-muted"><small>Este é o nome usado em todo o painel e nos E-mails enviados aos clientes.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Exigir autenticação de 2 fatores</label>
                                <div>
                                    <div class="btn-group" data-toggle="buttons">
                                        @php
                                            $level = old('pterodactyl:auth:2fa_required', config('pterodactyl.auth.2fa_required'));
                                        @endphp
                                        <label class="btn btn-primary @if ($level == 0) active @endif">
                                            <input type="radio" name="pterodactyl:auth:2fa_required" autocomplete="off" value="0" @if ($level == 0) checked @endif> Não é obrigatório
                                        </label>
                                        <label class="btn btn-primary @if ($level == 1) active @endif">
                                            <input type="radio" name="pterodactyl:auth:2fa_required" autocomplete="off" value="1" @if ($level == 1) checked @endif> Somente Administrador
                                        </label>
                                        <label class="btn btn-primary @if ($level == 2) active @endif">
                                            <input type="radio" name="pterodactyl:auth:2fa_required" autocomplete="off" value="2" @if ($level == 2) checked @endif> Todos os usuários
                                        </label>
                                    </div>
                                    <p class="text-muted"><small>Se ativado, qualquer conta que pertencer ao grupo selecionado deverá ter a autenticação de 2 fatores habilitada para usar o Painel.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Idioma padrão</label>
                                <div>
                                    <select name="app:locale" class="form-control">
                                        @foreach($languages as $key => $value)
                                            <option value="{{ $key }}" @if(config('app.locale') === $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-muted"><small>A linguagem padrão a ser usada na renderização de componentes de IU.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! csrf_field() !!}
                        <button type="submit" name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
