@extends('layouts.admin')

@section('title')
    Administração
@endsection

@section('content-header')
    <h1>Visão Geral do Sistema<small>Uma rápida olhada em seu sistema.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administração</a></li>
        <li class="active">Índice</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box
            @if($version->isLatestPanel())
                box-success
            @else
                box-danger
            @endif
        ">
            <div class="box-header with-border">
                <h3 class="box-title">Informações do sistema</h3>
            </div>
            <div class="box-body">
                @if ($version->isLatestPanel())
                    Você está executando o Painel Pterodactyl na versão <code>{{ config('app.version') }}</code>. Seu painel está atualizado!
                @else
                    Seu painel <strong>não está atualizado!</strong> A versão mais recente é a: <a href="https://github.com/Next-Panel/Pterodactyl-BR/releases/v{{ $version->getPanel() }}" target="_blank"><code>{{ $version->getPanel() }}</code></a> e você está atualmente executando a versão: <code>{{ config('app.version') }}</code>.
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="{{ $version->getDiscord() }}"><button class="btn btn-warning" style="width:100%;"><i class="fa fa-fw fa-support"></i> Obter ajuda <small>(via Discord)</small></button></a>
    </div>
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="https://nextpanel.com.br"><button class="btn btn-primary" style="width:100%;"><i class="fa fa-fw fa-link"></i> Documentação</button></a>
    </div>
    <div class="clearfix visible-xs-block">&nbsp;</div>
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="https://github.com/Next-Panel/Pterodactyl-BR"><button class="btn btn-primary" style="width:100%;"><i class="fa fa-fw fa-support"></i> Github</button></a>
    </div>
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="{{ $version->getDonations() }}"><button class="btn btn-success" style="width:100%;"><i class="fa fa-fw fa-money"></i> Apoiar o Projeto</button></a>
    </div>
</div>
@endsection
