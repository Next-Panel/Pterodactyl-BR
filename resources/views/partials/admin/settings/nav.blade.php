@include('partials/admin.settings.notice')

@section('settings::nav')
    @yield('settings::notice')
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom nav-tabs-floating">
                <ul class="nav nav-tabs">
                    <li @if($activeTab === 'basic')class="active"@endif><a href="{{ route('admin.settings') }}">Geral</a></li>
                    <li @if($activeTab === 'mail')class="active"@endif><a href="{{ route('admin.settings.mail') }}">E-mail</a></li>
                    <li @if($activeTab === 'advanced')class="active"@endif><a href="{{ route('admin.settings.advanced') }}">Avançado</a></li>
                    <li @if($activeTab === 'contribuidores')class="active"@endif><a href="{{ route('admin.settings.contribuidores') }}">Contribuidores</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
