<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class EstadoEventoNotificacion extends Notification
{
    use Queueable;

    public $evento;
    public $estado;
    public $motivo;

    /**
     * Create a new notification instance.
     */
    public function __construct($evento, $estado, $motivo = null)
    {
        $this->evento = $evento;
        $this->estado = $estado;
        $this->motivo = $motivo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase($notifiable)
    {
        $mensaje = 'Tu evento "' . $this->evento->titulo . '" ha sido ' . $this->estado . '.';
        if ($this->estado === 'rechazado' && $this->motivo) {
            $mensaje .= ' Motivo: ' . $this->motivo;
        }
        return [
            'mensaje' => $mensaje,
            'evento_id' => $this->evento->id,
            'estado' => $this->estado,
            'motivo' => $this->motivo,
        ];
    }
}
