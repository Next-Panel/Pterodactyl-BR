@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'basic'])

@section('title')
    Contribuidores
@endsection

@section('content-header')
    <h1>Contribuidores<small>Uma lista das pessoas que tornarão o projeto possível.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Contribuidores</li>
    </ol>
@endsection


@section('content')
    @yield('settings::nav')
    <div class="row">
        @foreach ($contribuidores as $contribuidor)
        <div class="col-md-4">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header">
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ $contribuidor['foto'] }}" alt="{{ $contribuidor['nome'] }}">
                    </div>
                    <h3 class="widget-user-username">{{ $contribuidor['nome'] }}</h3>
                    <h5 class="widget-user-desc">{{ $contribuidor['ajudou'] }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>