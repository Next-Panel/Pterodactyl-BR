<?php

namespace Pterodactyl\Console\Commands\Node;

use Illuminate\Console\Command;
use Pterodactyl\Services\Nodes\NodeCreationService;

class MakeNodeCommand extends Command
{
    protected $signature = 'p:node:make
                            {--name= : A name to identify the node.}
                            {--description= : A description to identify the node.}
                            {--locationId= : A valid locationId.}
                            {--fqdn= : The domain name (e.g node.example.com) to be used for connecting to the daemon. An IP address may only be used if you are not using SSL for this node.}
                            {--public= : Should the node be public or private? (public=1 / private=0).}
                            {--scheme= : Which scheme should be used? (Enable SSL=https / Disable SSL=http).}
                            {--proxy= : Is the daemon behind a proxy? (Yes=1 / No=0).}
                            {--maintenance= : Should maintenance mode be enabled? (Enable Maintenance mode=1 / Disable Maintenance mode=0).}
                            {--maxMemory= : Set the max memory amount.}
                            {--overallocateMemory= : Enter the amount of ram to overallocate (% or -1 to overallocate the maximum).}
                            {--maxDisk= : Set the max disk amount.}
                            {--overallocateDisk= : Enter the amount of disk to overallocate (% or -1 to overallocate the maximum).}
                            {--uploadSize= : Enter the maximum upload filesize.}
                            {--daemonListeningPort= : Enter the wings listening port.}
                            {--daemonSFTPPort= : Enter the wings SFTP listening port.}
                            {--daemonBase= : Enter the base folder.}';

    protected $description = 'Creates a new node on the system via the CLI.';

    /**
     * MakeNodeCommand constructor.
     */
    public function __construct(private NodeCreationService $creationService)
    {
        parent::__construct();
    }

    /**
     * Handle the command execution process.
     *
     * @throws \Pterodactyl\Exceptions\Model\DataValidationException
     */
    public function handle()
    {
        $data['name'] = $this->option('name') ?? $this->ask('Digite um identificador curto usado para distinguir este Node de outros');
        $data['description'] = $this->option('description') ?? $this->ask('Digite uma descrição para identificar o Node');
        $data['location_id'] = $this->option('locationId') ?? $this->ask('Digite um id de localização válido');
        $data['scheme'] = $this->option('scheme') ?? $this->anticipate(
            'Por favor, insira https para SSL ou http para uma conexão não-ssl',
            ['https', 'http'],
            'https'
        );
        $data['fqdn'] = $this->option('fqdn') ?? $this->ask('Digite um nome de domínio (ex: node.example.com) a ser usado para conectar ao daemon. Um endereço IP só pode ser usado se você não estiver usando SSL para este Node');
        $data['public'] = $this->option('public') ?? $this->confirm('Este Node deve ser público? Como observação, definir um Node como privado negará a capacidade de implantação automática neste Node.', true);
        $data['behind_proxy'] = $this->option('proxy') ?? $this->confirm('Seu FQDN está atrás de um proxy?');
        $data['maintenance_mode'] = $this->option('maintenance') ?? $this->confirm('O modo de manutenção deve ser ativado?');
        $data['memory'] = $this->option('maxMemory') ?? $this->ask('Insira a quantidade máxima de memória');
        $data['memory_overallocate'] = $this->option('overallocateMemory') ?? $this->ask('Insira a quantidade de memória para superalocar, -1 desativará a verificação e 0 impedirá a criação de novos servidores');
        $data['disk'] = $this->option('maxDisk') ?? $this->ask('Insira a quantidade máxima de espaço em disco');
        $data['disk_overallocate'] = $this->option('overallocateDisk') ?? $this->ask('Insira a quantidade de memória para superalocar, -1 desativará a verificação e 0 impedirá a criação de novos servidores');
        $data['upload_size'] = $this->option('uploadSize') ?? $this->ask('Insira o tamanho máximo de upload de arquivo', '100');
        $data['daemonListen'] = $this->option('daemonListeningPort') ?? $this->ask('Insira a porta de escuta do wings', '8080');
        $data['daemonSFTP'] = $this->option('daemonSFTPPort') ?? $this->ask('Insira a porta de escuta SFTP do wings', '2022');
        $data['daemonBase'] = $this->option('daemonBase') ?? $this->ask('Insira a pasta base', '/var/lib/pterodactyl/volumes');

        $node = $this->creationService->handle($data);
        $this->line('Novo Node criado com sucesso na localização ' . $data['location_id'] . ' com o nome ' . $data['name'] . ' e tem um id de ' . $node->id . '.');
    }
}
