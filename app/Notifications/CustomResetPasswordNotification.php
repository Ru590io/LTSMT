<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    public $callbackUrl;

    /**
     * Create a new notification instance.
     *
     * @param  string  $token
     * @param  string|null  $callbackUrl URL to redirect user for password reset
     */
    public function __construct($token, $callbackUrl = null)
    {
        $this->token = $token;
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        /*$url = $this->callbackUrl ?: url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject(Lang::get('Notificación de Restablecimiento de Contraseña'))
            ->greeting(Lang::get('¡Hola!'))
            ->line(Lang::get('Estás recibiendo este correo electrónico porque hemos recibido una solicitud de restablecimiento de contraseña para tu cuenta.'))
            ->action(Lang::get('Restablecer Contraseña'), $url)
            ->line(Lang::get('Este enlace para restablecer la contraseña expirará en :count minutos.', ['count' => config('auth.passwords.users.expire')]))
            ->line(Lang::get('Si no solicitaste un restablecimiento de contraseña, no se requiere ninguna acción adicional.'))
            ->salutation('Saludos, ByteGamers');*/
        $url = url('/password/reset', $this->token);

        return (new MailMessage)->subject(Lang::get('Notificación de Restablecimiento de Contraseña'))->view('auth.passwords.custom_password_reset', ['url' => $url]);

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
