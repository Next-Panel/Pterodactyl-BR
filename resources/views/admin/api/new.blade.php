@extends('layouts.admin')

@section('title')
    Aplica&ccedil;&atilde;o de API
@endsection

@section('content-header')
    <h1>Aplica&ccedil;&atilde;o API<small>Criar uma nova chave de Applica&ccedil;&atilde;o API.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Administração</a></li>
        <li><a href="{{ route('admin.api.index') }}">Applica&ccedil;&atilde;o API</a></li>
        <li class="active">Novas Credenciais</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <form method="POST" action="{{ route('admin.api.new') }}">
            <div class="col-sm-8 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Selecione as permiss&otilde;es</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            @foreach($resources as $resource)
                                <tr>
                                    <td class="col-sm-3 strong">{{ str_replace('_', ' ', title_case($resource)) }}</td>
                                    <td class="col-sm-3 radio radio-primary text-center">
                                        <input type="radio" id="r_{{ $resource }}" name="r_{{ $resource }}" value="{{ $permissions['r'] }}">
                                        <label for="r_{{ $resource }}">Ler</label>
                                    </td>
                                    <td class="col-sm-3 radio radio-primary text-center">
                                        <input type="radio" id="rw_{{ $resource }}" name="r_{{ $resource }}" value="{{ $permissions['rw'] }}">
                                        <label for="rw_{{ $resource }}">Ler &amp; Escrever</label>
                                    </td>
                                    <td class="col-sm-3 radio text-center">
                                        <input type="radio" id="n_{{ $resource }}" name="r_{{ $resource }}" value="{{ $permissions['n'] }}" checked>
                                        <label for="n_{{ $resource }}">Nenhum</label>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label" for="memoField">Descri&ccedil;&atilde;o <span class="field-required"></span></label>
                            <input id="memoField" type="text" name="memo" class="form-control">
                        </div>
                        <p class="text-muted">Uma vez que voc&ecirc; tenha atribu&aacute;do permiss&otilde;es e criado este conjunto de credenciais, voc&ecirc; n&atilde;o poder&aacute; voltar e edit&aacute;-lo. Se voc&ecirc; precisar fazer mudan&ccedil;as ao longo do caminho, voc&ecirc; precisar&aacute; criar um novo conjunto de credenciais.</p>
                    </div>
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success btn-sm pull-right">Criar Credenciais</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    </script>
@endsection
