<?php

namespace Pterodactyl\Console\Commands;

use Illuminate\Console\Command;
use Pterodactyl\Services\Helpers\SoftwareVersionService;
use Illuminate\Contracts\Config\Repository as ConfigRepository;

class InfoCommand extends Command
{
    protected $description = 'Displays the application, database, and email configurations along with the panel version.';

    protected $signature = 'p:info';

    /**
     * VersionCommand constructor.
     */
    public function __construct(private ConfigRepository $config, private SoftwareVersionService $versionService)
    {
        parent::__construct();
    }

    /**
     * Handle execution of command.
     */
    public function handle()
    {
        $this->output->title('Informações da Versão');
        $this->table([], [
            ['Versão do Painel', $this->config->get('app.version')],
            ['Última Versão', $this->versionService->getPanel()],
            ['Atualizado', $this->versionService->isLatestPanel() ? 'Sim' : $this->formatText('Não', 'bg=red')],
            ['Identificador Único', $this->config->get('pterodactyl.service.author')],
        ], 'compact');

        $this->output->title('Configuração do Aplicativo');
        $this->table([], [
            ['Ambiente', $this->formatText($this->config->get('app.env'), $this->config->get('app.env') === 'production' ?: 'bg=red')],
            ['Modo de Depuração', $this->formatText($this->config->get('app.debug') ? 'Sim' : 'Não', !$this->config->get('app.debug') ?: 'bg=red')],
            ['URL de Instalação', $this->config->get('app.url')],
            ['Diretório de Instalação', base_path()],
            ['Fuso Horário', $this->config->get('app.timezone')],
            ['Driver de Cache', $this->config->get('cache.default')],
            ['Driver de Fila', $this->config->get('queue.default')],
            ['Driver de Sessão', $this->config->get('session.driver')],
            ['Driver do Sistema de Arquivos', $this->config->get('filesystems.default')],
            ['Tema Padrão', $this->config->get('themes.active')],
            ['Proxies', $this->config->get('trustedproxies.proxies')],
        ], 'compact');

        $this->output->title('Configuração do Banco de Dados');
        $driver = $this->config->get('database.default');
        $this->table([], [
            ['Driver', $driver],
            ['Host', $this->config->get("database.connections.$driver.host")],
            ['Porta', $this->config->get("database.connections.$driver.port")],
            ['Banco de Dados', $this->config->get("database.connections.$driver.database")],
            ['Nome de Usuário', $this->config->get("database.connections.$driver.username")],
        ], 'compact');

        // TODO: Update this to handle other mail drivers
        $this->output->title('Configuração de E-mail');
        $this->table([], [
            ['Driver', $this->config->get('mail.default')],
            ['Host', $this->config->get('mail.mailers.smtp.host')],
            ['Porta', $this->config->get('mail.mailers.smtp.port')],
            ['Nome de Usuário', $this->config->get('mail.mailers.smtp.username')],
            ['Endereço do Remetente', $this->config->get('mail.from.address')],
            ['Nome do Remetente', $this->config->get('mail.from.name')],
            ['Criptografia', $this->config->get('mail.mailers.smtp.encryption')],
        ], 'compact');
    }

    /**
     * Format output in a Name: Value manner.
     */
    private function formatText(string $value, string $opts = ''): string
    {
        return sprintf('<%s>%s</>', $opts, $value);
    }
}
