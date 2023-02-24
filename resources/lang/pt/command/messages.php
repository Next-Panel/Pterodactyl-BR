<?php

return [
    'location' => [
        'no_location_found' => 'Não foi possível localizar um registro que correspondesse ao código curto fornecido.',
        'ask_short' => 'Localização Código curto',
        'ask_long' => 'Localização Descrição',
        'created' => 'Um nova localização (:name) foi criado com sucesso com um ID de :id.',
        'deleted' => 'Eliminou com sucesso a localização solicitada.',
    ],
    'user' => [
        'search_users' => 'Digite um nome de usuário, ID de usuário ou endereço de e-mail',
        'select_search_user' => 'ID do usuário a ser excluído (Digite "0" para pesquisar novamente)',
        'deleted' => 'O usuário foi excluído com sucesso do Painel.',
        'confirm_delete' => 'Você tem certeza de que quer excluir este usuário do Painel?',
        'no_users_found' => 'Nenhum usuário foi encontrado para o termo de busca fornecido.',
        'multiple_found' => 'Foram encontradas várias contas para o usuário fornecido, incapaz de excluir um usuário por causa da bandeira --no-interação.',
        'ask_admin' => 'Este usuário é um administrador?',
        'ask_email' => 'Endereço de e-mail',
        'ask_username' => 'Nome de usuário',
        'ask_name_first' => 'Primeiro nome',
        'ask_name_last' => 'Sobrenome',
        'ask_password' => 'Senha',
        'ask_password_tip' => 'Se você gostaria de criar uma conta com uma senha aleatória enviada por e-mail ao usuário, execute novamente este comando (CTRL+C) e adicione "--no-password" no codigo.',
        'ask_password_help' => 'As senhas devem ter pelo menos 8 caracteres e conter pelo menos uma letra maiúscula e um número.',
        '2fa_help_text' => [
            'Este comando desativará a autenticação de 2 fatores para a conta de um usuário se ela estiver habilitada. Isto só deve ser usado como um comando de recuperação de conta se o usuário estiver bloqueado fora de sua conta.',
            'Se não era isto que você queria fazer, pressione CTRL+C para sair deste processo.',
        ],
        '2fa_disabled' => 'A autenticação do 2-Factor foi desativada para :email.',
    ],
    'schedule' => [
        'output_line' => 'Despacho para a primeira tarefa em `:schedule` (:hash).',
    ],
    'maintenance' => [
        'deleting_service_backup' => 'Eliminação do arquivo de backup do serviço :file.',
    ],
    'server' => [
        'rebuild_failed' => 'Pedido de reconstrução para ":name" (#:id) no node ":node" falhou com erro: :message',
        'reinstall' => [
            'failed' => 'O pedido de reinstalação de ":name" (#:id) no node ":node" falhou com erro: :message',
            'confirm' => 'Você está prestes a reinstalar-se contra um grupo de servidores. Você deseja continuar?',
        ],
        'power' => [
            'confirm' => 'Você está prestes a realizar uma :action contra :count servidores. Você deseja continuar?',
            'action_failed' => 'A solicitação de ação de energia para ":name" (#:id) no node ":node" falhou com o erro: :message',
        ],
    ],
    'environment' => [
        'mail' => [
            'ask_smtp_host' => 'Host do SMTP (e.g. smtp.gmail.com)',
            'ask_smtp_port' => 'Porta do SMTP',
            'ask_smtp_username' => 'Usuário do SMTP',
            'ask_smtp_password' => 'Senha do SMTP',
            'ask_mailgun_domain' => 'Domínio do Mailgun',
            'ask_mailgun_endpoint' => 'Endpoint do Mailgun',
            'ask_mailgun_secret' => 'Segredo do Mailgun',
            'ask_mandrill_secret' => 'Segredo do Mandrill',
            'ask_postmark_username' => 'Chave API do Postmark',
            'ask_driver' => 'Qual Driver deve ser utilizado para o envio de e-mails?',
            'ask_mail_from' => 'Os e-mails de endereços de e-mail devem ter origem em',
            'ask_mail_name' => 'Nome do qual os e-mails devem aparecer',
            'ask_encryption' => 'Método de encriptação a ser usado',
        ],
    ],
];
