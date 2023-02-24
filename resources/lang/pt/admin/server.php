<?php

return [
    'exceptions' => [
        'no_new_default_allocation' => 'Você está tentando excluir a alocação padrão para este servidor, mas não há nenhuma alocação de recurso a ser usada.',
        'marked_as_failed' => 'Este servidor foi marcado como tendo falhado uma instalação anterior. O status atual não pode ser alternado neste estado.',
        'bad_variable' => 'Houve um erro de validação com a variável :name.',
        'daemon_exception' => 'Houve uma exceção ao tentar se comunicar com o daemon, resultando em um código de resposta HTTP/:code. Esta exceção foi registrada. (id do pedido: :request_id)',
        'default_allocation_not_found' => 'A alocação padrão solicitada não foi encontrada nas alocações deste servidor.',
    ],
    'alerts' => [
        'startup_changed' => 'A configuração de inicialização para este servidor foi atualizada. Se o nest ou o egg deste servidor for alterado, uma reinstalação estará ocorrendo agora.',
        'server_deleted' => 'O servidor foi excluído com sucesso do sistema.',
        'server_created' => 'O servidor foi criado com sucesso no painel. Por favor, aguarde alguns minutos para que o daemon instale completamente este servidor.',
        'build_updated' => 'Os detalhes de construção para este servidor foram atualizados. Algumas mudanças podem exigir um reinício para ter efeito.',
        'suspension_toggled' => 'O status de suspensão do servidor foi alterado para :status.',
        'rebuild_on_boot' => 'Este servidor foi marcado como exigindo a reconstrução de um Docker Container. Isto acontecerá na próxima vez em que o servidor for iniciado.',
        'install_toggled' => 'O status de instalação deste servidor foi alternado.',
        'server_reinstalled' => 'Este servidor foi enfileirado para uma reinstalação que começa agora.',
        'details_updated' => 'Os detalhes do servidor foram atualizados com sucesso.',
        'docker_image_updated' => 'Mudou com sucesso a imagem padrão do Docker para usar para este servidor. Uma reinicialização é necessária para aplicar esta mudança.',
        'node_required' => 'Você deve ter pelo menos um node configurado antes de poder adicionar um servidor a este painel.',
        'transfer_nodes_required' => 'Você deve ter pelo menos dois nodes configurados antes de poder transferir servidores.',
        'transfer_started' => 'A transferência do servidor foi iniciada.',
        'transfer_not_viable' => 'O node que você selecionou não tem o espaço em disco ou a memória necessária disponível para acomodar este servidor.',
    ],
];
