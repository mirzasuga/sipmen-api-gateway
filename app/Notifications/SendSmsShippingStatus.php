<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Notifications\Messages\NexmoMessage;
use App\Resi;
use App\ShippingStatus;

class SendSmsShippingStatus extends Notification
{
    use Queueable;
    protected $resi;
    protected $shippingStatus;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( Resi $resi, ShippingStatus $shippingStatus )
    {
        $this->resi = $resi;
        $this->shippingStatus = $shippingStatus;
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
            //
        ];
    }
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content($this->shippingStatus->name);
    }
}
