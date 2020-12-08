<?php

namespace App\Notifications;

use App\Dossier;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DossierNotification extends Notification
{
    use Queueable;
    protected $dossier;
    protected $user;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Dossier $dossier, User $user)
    {
        $this->dossier = $dossier;
        $this->user = $user;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'SDP' => $this->dossier->num_sdp,
            'DRH' => $this->dossier->num_dra,
            'Date_entre' => $this->dossier->date_entre,
            'Personne' => $this->dossier->nom,
            'Type' => $this->dossier->type->name,
            'user' => $this->user->name
        ];
    }
}
