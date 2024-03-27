<?php

namespace App\Notifications;

use App\Models\DonationRequest;
use App\Models\Notification as ModelsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DonationRequestNotification extends Notification
{
    use Queueable;

   
    public function __construct(protected DonationRequest $donationRequest , protected $notification)
    {
       $this->donationRequest=$donationRequest;
       $this->notification=$notification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('new Request'. $this->notification->title)
                    // ->subject('new Request'.DonationRequest::with('notifications')->title)
                    ->greeting('hi'.$notifiable->name)
                    ->line('need to donate'. $this->notification->content)
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
