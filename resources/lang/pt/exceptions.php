<?php

return [
    'daemon_connection_failed' => 'Houve uma exceção ao tentar se comunicar com o daemon resultando em um código de resposta HTTP/:code. Esta exceção foi registrada.',
    'node' => [
        'servers_attached' => 'Um node não deve ter servidores ligados a ele para que possa ser excluído.',
        'daemon_off_config_updated' => 'A configuração do daemon <strong>foi atualizada</strong>, porém ocorreu um erro ao tentar atualizar automaticamente o arquivo de configuração no Daemon. Você precisará atualizar manualmente o arquivo de configuração (config.yml) para o daemon aplicar essas alterações.',
    ],
    'allocations' => [
        'server_using' => 'Um servidor está atualmente atribuído a esta alocação. Uma alocação só pode ser excluída se nenhum servidor estiver atribuído no momento.',
        'too_many_ports' => 'A adição de mais de 1000 portos em uma única faixa de uma vez não é suportada.',
        'invalid_mapping' => 'O mapeamento previsto para :porto era inválido e não podia ser processado.',
        'cidr_out_of_range' => 'A notação CIDR só permite máscaras entre /25 e /32.',
        'port_out_of_range' => 'Os portos em uma alocação devem ser maiores que 1024 e menores ou iguais a 65535.',
    ],
    'nest' => [
        'delete_has_servers' => 'Um nest com servidores ativos anexados a ele não pode ser excluído do Painel.',
        'egg' => [
            'delete_has_servers' => 'Um Egg com servidores ativos anexados a ele não pode ser excluído do Painel.',
            'invalid_copy_id' => 'O Egg selecionado para copiar um roteiro não existe, ou está copiando um roteiro em si.',
            'must_be_child' => 'A diretiva "Copiar configurações de" para este egg deve ser uma opção secundária para o nest selecionado.',
            'has_children' => 'Este egg é um pai para um ou mais eggs.Por Favor apagar estes eggs antes de apagar este egg.',
        ],
        'variables' => [
            'env_not_unique' => 'A variável de environment(ambiente) :name deve ser exclusiva para este Egg.',
            'reserved_name' => 'A variável de environment(ambiente) :name é protegida e não pode ser atribuída a uma variável.',
            'bad_validation_rule' => 'A regra de validação ":rule" não é uma regra válida para esta aplicação.',
        ],
        'importer' => [
            'json_error' => 'Houve um erro durante a tentativa de analisar o arquivo JSON: :error.',
            'file_error' => 'O arquivo JSON fornecido não era válido.',
            'invalid_json_provided' => 'O arquivo JSON fornecido não está em um formato que possa ser reconhecido.',
        ],
    ],
    'subusers' => [
        'editing_self' => 'A edição de sua própria conta de subusuário não é permitida.',
        'user_is_owner' => 'Você não pode adicionar o proprietário do servidor como um subusuário para este servidor.',
        'subuser_exists' => 'Um usuário com esse endereço de e-mail já está designado como subusuário para este servidor.',
    ],
    'databases' => [
        'delete_has_databases' => 'Não é possível excluir um servidor host de banco de dados que tenha bancos de dados ativos ligados a ele.',
    ],
    'tasks' => [
        'chain_interval_too_long' => 'O tempo máximo de intervalo para uma tarefa encadeada é de 15 minutos.',
    ],
    'locations' => [
        'has_nodes' => 'Não é possível excluir um local que tenha nodes ativos anexados a ele.',
    ],
    'users' => [
        'node_revocation_failed' => 'Falha em revogar chaves em <a href=":link">Node #:node</a>. :error',
    ],
    'deployment' => [
        'no_viable_nodes' => 'Não foi possível encontrar nodes que satisfizessem os requisitos especificados para a implantação automática.',
        'no_viable_allocations' => 'Não foram encontradas alocações que satisfizessem os requisitos para a implantação automática.',
    ],
    'api' => [
        'resource_not_found' => 'O recurso solicitado não existe neste servidor.',
    ],
];
