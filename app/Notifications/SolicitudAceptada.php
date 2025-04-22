<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Solicitud;

class SolicitudAceptada extends Notification
{
    use Queueable;

    protected $solicitud;


    /**
     * Create a new notification instance.
     */
    public function __construct(Solicitud $solicitud)
    {
        $this->solicitud = $solicitud;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('¡Tu solicitud ha sido aceptada!')
            ->greeting('Hola ' . $notifiable->name . '!')
            ->line('Nos alegra informarte que tu solicitud de adopción ha sido aceptada.')
            ->line('Fecha: ' . $this->solicitud->created_at->format('d/m/Y'))
            ->line('¡Gracias por ser parte de esta noble causa!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
