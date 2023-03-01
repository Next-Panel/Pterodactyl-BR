<?php

return [
    'sign_in' => 'Entrar',
    'go_to_login' => 'Ir para Login',
    'failed' => 'Não foi possível encontrar uma conta que correspondesse a essas credenciais.',

    'forgot_password' => [
        'label' => 'Esqueceu a senha?',
        'label_help' => 'Digite o endereço de e-mail de sua conta para receber instruções sobre como redefinir sua senha.',
        'button' => 'Recuperar conta',
    ],

    'reset_password' => [
        'button' => 'Resetar e Entrar',
    ],

    'two_factor' => [
        'label' => 'Token de 2 fatores',
        'label_help' => 'Esta conta requer uma segunda camada de autenticação para poder continuar. Por favor, insira o código gerado pelo seu dispositivo para completar este login.',
        'checkpoint_failed' => 'O token de autenticação de dois fatores era inválido.',
    ],

    'throttle' => 'Muitas tentativas de login. Tente novamente em :seconds segundos.',
    'password_requirements' => 'A senha deve ter pelo menos 8 caracteres e deve ser exclusiva para este site.',
    '2fa_must_be_enabled' => 'O administrador solicitou que a autenticação de 2 fatores seja ativada para sua conta para usar o painel.',
];
