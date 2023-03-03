<?php

namespace Pterodactyl\Console\Commands\Node;

use Illuminate\Console\Command;
use Pterodactyl\Services\Nodes\NodeCreationService;

class MakeNodeCommand extends Command
{
    protected $signature = 'p:node:make
                            {--name= : Um nome para identificar o node.}
                            {--description= : Uma descrição para identificar o node.}
                            {--locationId= : Uma id de localização válida.}
                            {--fqdn= : O nome de domínio (por exemplo, node.example.com) a ser usado para conectar ao daemon. Um endereço IP só pode ser usado se você não estiver usando SSL para este node.}
                            {--public= : O node deve ser publico ou privado? (público=1 / privado=0).}
                            {--scheme= : Qual esquema deve ser usado? (Ativar SSL=https / Desativar SSL=http).}
                            {--proxy= : O daemon usa serviço CDN? (Yes=1 / No=0).}
                            {--maintenance= : O modo de manutenção deve ser ativado? (Ativar modo de manutenção=1 / Desativar modo de manutenção=0).}
                            {--maxMemory= : Definir a quantidade máxima de memória.}
                            {--overallocateMemory= : Digite a quantidade de ram para superalocar (% or -1 para superalocar o máximo).}
                            {--maxDisk= : Definir a quantidade máxima de disco.}
                            {--overallocateDisk= : Insira a quantidade de disco para superalocar (% or -1 para superalocar o máximo).}
                            {--uploadSize= : Insira o tamanho máximo do arquivo de upload.}
                            {--daemonListeningPort= : Entre na porta de escuta das Wings.}
                            {--daemonSFTPPort= : Entre na porta de escuta SFTP das Wings.}
                            {--daemonBase= : Entre na pasta base.}';

    protected $description = 'Cria um novo node no sistema por meio da CLI.';

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
        $data['name'] = $this->option('name') ?? $this->ask('Enter a short identifier used to distinguish this node from others');
        $data['description'] = $this->option('description') ?? $this->ask('Enter a description to identify the node');
        $data['location_id'] = $this->option('locationId') ?? $this->ask('Enter a valid location id');
        $data['scheme'] = $this->option('scheme') ?? $this->anticipate(
            'Digite https para SSL ou http para uma conexão não-ssl',
            ['https', 'http'],
            'https'
        );
        $data['fqdn'] = $this->option('fqdn') ?? $this->ask('Insira um nome de domínio (por exemplo, node.example.com) a ser usado para conectar-se ao daemon. Um endereço IP só pode ser usado se você não estiver usando SSL para este node');
        $data['public'] = $this->option('public') ?? $this->confirm('Esse node deve ser público? Como observação, ao definir um node como privado, você negará a capacidade de implantação automática para esse node.', true);
        $data['behind_proxy'] = $this->option('proxy') ?? $this->confirm('O seu FQDN está usando serviço CDN?');
        $data['maintenance_mode'] = $this->option('maintenance') ?? $this->confirm('O modo de manutenção deve ser ativado?');
        $data['memory'] = $this->option('maxMemory') ?? $this->ask('Digite a quantidade máxima de memória');
        $data['memory_overallocate'] = $this->option('overallocateMemory') ?? $this->ask('Digite a quantidade de memória para superalocar, -1 desativará a verificação e 0 impedirá a criação de novos servidores');
        $data['disk'] = $this->option('maxDisk') ?? $this->ask('Digite a quantidade máxima de espaço em disco');
        $data['disk_overallocate'] = $this->option('overallocateDisk') ?? $this->ask('Digite a quantidade de memória para superalocar, -1 desativará a verificação e 0 impedirá a criação de um novo servidor');
        $data['upload_size'] = $this->option('uploadSize') ?? $this->ask('Insira o tamanho máximo de upload de arquivo', '100');
        $data['daemonListen'] = $this->option('daemonListeningPort') ?? $this->ask('Insira a porta de escuta das Wings', '8080');
        $data['daemonSFTP'] = $this->option('daemonSFTPPort') ?? $this->ask('Insira a porta de escuta SFTP das Wings', '2022');
        $data['daemonBase'] = $this->option('daemonBase') ?? $this->ask('Insira a pasta base das Wings', '/var/lib/pterodactyl/volumes');

        $node = $this->creationService->handle($data);
        $this->line('Um novo node foi criado com sucesso na localização ' . $data['location_id'] . ' com o nome ' . $data['name'] . ' e tem um id de ' . $node->id . '.');
    }
}
