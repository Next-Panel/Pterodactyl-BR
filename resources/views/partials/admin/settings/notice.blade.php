@section('settings::notice')
    @if(config('pterodactyl.load_environment_only', false))
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger">
                    Seu Painel está atualmente configurado para ler as configurações apenas do ambiente. Você precisará definir <code>APP_ENVIRONMENT_ONLY=false</code> em seu arquivo de ambiente para carregar as configurações dinamicamente.
                </div>
            </div>
        </div>
    @endif
@endsection