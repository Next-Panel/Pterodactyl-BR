<?php

namespace Pterodactyl\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddedToServer extends Notification implements ShouldQueue
{
    use Queueable;

    public object $server;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $server)
    {
        $this->server = (object) $server;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject(config('app.name', 'Pterodactyl') . ' - Adicionado(a) a um Servidor - ' . $this->server->name)
            ->greeting('Olá ' . $this->server->user . '!')
            ->line('Você foi adicionado como um subusuário para o seguinte servidor, permitindo certo controle sobre o servidor.')
            ->line('Nome do servidor: ' . $this->server->name)
            ->action('Visite o servidor', url('/server/' . $this->server->uuidShort));
    }
}
