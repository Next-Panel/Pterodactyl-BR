<?php

namespace Pterodactyl\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendPasswordReset extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $token)
    {
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
    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Redefinir Senha')
            ->line('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.')
            ->action('Redefinir Senha', url('/auth/password/reset/' . $this->token . '?email=' . urlencode($notifiable->email)))
            ->line('Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.');
    }
}
