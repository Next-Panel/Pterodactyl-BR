<?php

namespace Pterodactyl\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\VarDumper\VarDumper;
use Pterodactyl\Services\Telemetry\TelemetryCollectionService;

class TelemetryCommand extends Command
{
    protected $description = 'Exibe todos os dados que seriam enviados ao Pterodactyl Telemetry Service se a coleta de telemetria estiver habilitada.';

    protected $signature = 'p:telemetry';

    /**
     * TelemetryCommand constructor.
     */
    public function __construct(private TelemetryCollectionService $telemetryCollectionService)
    {
        parent::__construct();
    }

    /**
     * Handle execution of command.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    public function handle()
    {
        $this->output->info('Coletando dados de telemetria, isso pode demorar um pouco...');

        VarDumper::dump($this->telemetryCollectionService->collect());
    }
}
