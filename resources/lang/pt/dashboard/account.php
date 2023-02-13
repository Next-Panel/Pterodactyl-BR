<?php

return [
    'email' => [
        'title' => 'Atualize seu e-mail',
        'updated' => 'Seu endereço de e-mail foi atualizado.',
    ],
    'password' => [
        'title' => 'Altere sua senha',
        'requirements' => 'Sua nova senha deve ter pelo menos 8 caracteres de comprimento.',
        'updated' => 'Sua senha foi atualizada.',
    ],
    'two_factor' => [
        'button' => 'Configurar Autenticação de 2 Fatores',
        'disabled' => 'A autenticação de dois fatores foi desativada em sua conta. Você não será mais solicitado a fornecer um token ao fazer o login.',
        'enabled' => 'A autenticação de dois fatores foi habilitada em sua conta! De agora em diante, ao fazer o login, você será solicitado a fornecer o código gerado por seu dispositivo.',
        'invalid' => 'A ficha fornecida era inválida.',
        'setup' => [
            'title' => 'Configuração de autenticação de dois fatores',
            'help' => 'Não pode digitalizar o código? Digite o código abaixo em sua aplicação:',
            'field' => 'Digite o token',
        ],
        'disable' => [
            'title' => 'Desativar a autenticação de dois fatores',
            'field' => 'Digite o token',
        ],
    ],
];
