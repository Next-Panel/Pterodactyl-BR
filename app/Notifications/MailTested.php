<?php

namespace Pterodactyl\Notifications;

use Pterodactyl\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MailTested extends Notification
{
    public function __construct(private User $user)
    {
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject('Mensagem de Teste de Pterodactyl')
            ->line('Este é um teste do sistema de e-mail do Pterodactyl. Você está pronto para ir!');
            ->greeting('Hello ' . $this->user->username . '!')
    }
}
