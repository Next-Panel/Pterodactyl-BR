<?php

return [
    'validation' => [
        'fqdn_not_resolvable' => 'O FQDN ou endereço IP fornecido não resolve para um endereço IP válido.',
        'fqdn_required_for_ssl' => 'Um nome de domínio totalmente qualificado que resolva para um endereço IP público é necessário para usar SSL para este node.',
    ],
    'notices' => [
        'allocations_added' => 'As alocações foram acrescentadas com sucesso a este node.',
        'node_deleted' => 'O node foi removido com sucesso do painel.',
        'location_required' => 'Você deve ter pelo menos um local configurado antes de poder adicionar um node a este painel.',
        'node_created' => 'Novo node criado com sucesso. Você pode configurar automaticamente o daemon nesta máquina visitando a guia \'Configuração\'. <strong>Antes de adicionar qualquer servidor, você deve primeiro alocar pelo menos um endereço IP e uma porta.</strong>',
        'node_updated' => 'As informações sobre os nodes foram atualizadas. Se alguma configuração do daemon for alterada, você precisará reiniciá-la para que essas alterações tenham efeito.',
        'unallocated_deleted' => 'Deletados todos os portos não alocados para <code>:ip</code>.',
    ],
];
