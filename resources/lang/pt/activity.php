<?php

/**
 * Contains all of the translation strings for different activity log
 * events. These should be keyed by the value in front of the colon (:)
 * in the event name. If there is no colon present, they should live at
 * the top level.
 */
return [
    'auth' => [
        'fail' => 'Falha no login',
        'success' => 'Efetuou Login.',
        'password-reset' => 'Redefinição de senha',
        'reset-password' => 'Reinicialização da senha solicitada',
        'checkpoint' => 'Autenticação de dois fatores solicitada',
        'recovery-token' => 'Usou o token de recuperação de dois fatores',
        'token' => 'Resolveu o desafio de dois fatores',
        'ip-blocked' => 'Pedido bloqueado de endereço IP não listado para :identifier',
        'sftp' => [
            'fail' => 'Falha no login SFTP',
        ],
    ],
    'user' => [
        'account' => [
            'email-changed' => 'E-mail alterado de :old para :new',
            'password-changed' => 'Senha alterada',
        ],
        'api-key' => [
            'create' => 'Criada nova chave API :identifier',
            'delete' => 'Chave API deletada :identifier',
        ],
        'ssh-key' => [
            'create' => 'Adicionada a chave SSH :fingerprint à conta',
            'delete' => 'Removida a chave SHH :fingerprint da conta ',
        ],
        'two-factor' => [
            'create' => 'Ativado o auth de dois fatores',
            'delete' => 'Deficiente com dois fatores auth',
        ],
    ],
    'server' => [
        'reinstall' => 'Servidor reinstalado',
        'console' => [
            'command' => 'Executado ":command" no servidor',
        ],
        'power' => [
            'start' => 'Iniciou o servidor',
            'stop' => 'Parou o servidor',
            'restart' => 'Reinicializou o servidor',
            'kill' => 'Matou o processo do servidor',
        ],
        'backup' => [
            'download' => 'Baixado o backup ":name"',
            'delete' => 'Deletado o backup ":name"',
            'restore' => 'Restaurado o backup ":name" (arquivos excluídos: :truncate)',
            'restore-complete' => 'Concluída a restauração do backup ":name"',
            'restore-failed' => 'Falha na restauração completa do backup ":name"',
            'start' => 'Iniciou um novo backup ":name"',
            'complete' => 'Iniciou um novo backup :name backup as complete',
            'fail' => 'Marcou o backup ":name" como falhado',
            'lock' => 'Bloqueou o backup ":name"',
            'unlock' => 'Desbloqueou o backup ":name"',
        ],
        'database' => [
            'create' => 'Criado novo banco de dados ":name"',
            'rotate-password' => 'Senha rotacionada para banco de dados ":name".',
            'delete' => 'Banco de dados deletado ":name"',
        ],
        'file' => [
            'compress_one' => 'Comprimido o arquivo ":directory:"',
            'compress_other' => 'Comprimido :count arquivos em ":directory"',
            'read' => 'Visualizou o conteúdo de :file',
            'copy' => 'Criou uma cópia do :file',
            'create-directory' => 'Criado o diretório :directory:name',
            'decompress' => 'Descomprimido :files no :directory',
            'delete_one' => 'Deletado :directory:files.0',
            'delete_other' => 'Deletado :count arquivos no :directory',
            'download' => 'Baixado :file',
            'pull' => 'Baixado um arquivo remoto de :url para :directory',
            'rename_one' => 'Renomeado o :directory:files.0.from para :directory:files.0.to',
            'rename_other' => 'Renomeado :count arquivos no :directory',
            'write' => 'Escreveu novo conteúdo para :file',
            'upload' => 'Iniciou o upload de um arquivo.',
            'uploaded' => 'Enviado para :directory:file',
        ],
        'sftp' => [
            'denied' => 'Acesso bloqueado ao SFTP devido a permissões',
            'create_one' => 'Criado o :files.0',
            'create_other' => 'Criado :count novos arquivos',
            'write_one' => 'Modificou o conteúdo de :files.0',
            'write_other' => 'Modificou os conteúdos de :count arquivos',
            'delete_one' => 'Deletado :files.0',
            'delete_other' => 'Deletados :count arquivos',
            'create-directory_one' => 'Criado o diretório ":files.0"',
            'create-directory_other' => 'Criados :count diretórios',
            'rename_one' => 'Renomeado :files.0.from para :files.0.to',
            'rename_other' => 'Renomeados ou movidos :count arquivos',
        ],
        'allocation' => [
            'create' => 'Adicionada a alocação ":allocation" para o servidor',
            'notes' => 'Atualizadas as notas para ":allocation" de ":old" para ":new"',
            'primary' => 'Setado a alocação ":allocation" como a alocação primária do servidor',
            'delete' => 'Apagada a alocação ":allocation"',
        ],
        'schedule' => [
            'create' => 'Criado novo cronograma ":name"',
            'update' => 'Atualizada o cronograma ":name"',
            'execute' => 'Manualmente executado o cronograma ":name"',
            'delete' => 'Deletado o cronograma ":name"',
        ],
        'task' => [
            'create' => 'Criado nova tarefa ":action" no cronograma ":name"',
            'update' => 'Updated the ":action" task no cronograma ":name"',
            'delete' => 'A tarefa ":name" foi deletada do cronograma',
        ],
        'settings' => [
            'rename' => 'Renomeou o servidor de :old para :new',
            'description' => 'Mudou a descrição do servidor de :old para :new',
        ],
        'startup' => [
            'edit' => 'Mudou a variável ":variable" de ":old" para ":new"',
            'image' => 'Atualização da imagem do Docker para o servidor a partir de :old para :new',
        ],
        'subuser' => [
            'create' => 'Adicionado o :email como um subusuário',
            'update' => 'Atualizadas as permissões de subusuário do :email',
            'delete' => 'Removido :email como subusuário',
        ],
    ],
];
