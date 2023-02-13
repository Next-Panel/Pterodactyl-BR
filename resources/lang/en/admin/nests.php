<?php

return [
    'notices' => [
        'created' => 'Um novo nest, :name, foi criado com sucesso.',
        'deleted' => 'Eliminou com sucesso o nest solicitado do Painel.',
        'updated' => 'Atualizou com sucesso as opções de configuração dos nest.',
    ],
    'eggs' => [
        'notices' => [
            'imported' => 'Importou com sucesso este egg e suas variáveis associadas.',
            'updated_via_import' => 'Este egg foi atualizado utilizando o arquivo fornecido.',
            'deleted' => 'Eliminou com sucesso o egg solicitado do Painel.',
            'updated' => 'A configuração dos egg foi atualizada com sucesso.',
            'script_updated' => 'O script de instalação do egg foi atualizado e será executado sempre que os servidores forem instalados.',
            'egg_created' => 'Um novo egg foi posto com sucesso. Você precisará reiniciar qualquer daemons em funcionamento para aplicar este novo egg.',
        ],
    ],
    'variables' => [
        'notices' => [
            'variable_deleted' => 'A variável ":variable" foi eliminada e não estará mais disponível para os servidores uma vez reconstruída.',
            'variable_updated' => 'A variável ":variable" foi atualizada. Você precisará reconstruir qualquer servidor usando esta variável a fim de aplicar as mudanças.',
            'variable_created' => 'Nova variável foi criada e atribuída com sucesso a este egg.',
        ],
    ],
];
