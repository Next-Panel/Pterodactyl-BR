<?php

namespace Pterodactyl\Http\Controllers\Admin\Settings;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Traits\Helpers\AvailableLanguages;
use Pterodactyl\Services\Helpers\SoftwareVersionService;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;
use Pterodactyl\Http\Requests\Admin\Settings\BaseSettingsFormRequest;

class ContribuidoresController extends Controller
{
    public function index()
    {
        $response = Http::get('https://raw.githubusercontent.com/Ptero-Brasil/Ptero-Brasil/main/contribuidores.txt');
        $contribuidores = collect(explode("\n", $response->body()))
            ->filter()
            ->map(function ($contribuidor) {
                $info = explode(' | ', $contribuidor);
                return [
                    'nome' => $info[0],
                    'foto' => $info[1],
                    'ajudou' => $info[2],
                ];
            });

        return view('admin.settings.contribuidores', compact('contribuidores'));
    }
}