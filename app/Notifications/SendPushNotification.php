<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Illuminate\Notifications\Notification;

class SendPushNotification extends Notification
{
    use Queueable;
    protected $title;
    protected $message;
    protected $fcmTokens;

    /**
     * Create a new notification instance.
     */
    public function __construct($title,$message,$fcmTokens)
    {
        $this->title = $title;
        $this->message = $message;
        $this->fcmTokens = $fcmTokens;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable)
    {
        return ['firebase'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toFirebase($notifiable)
    {
        return (new FirebaseMessage)
            ->withTitle($this->title)
            ->withBody($this->message)
            ->withPriority('high')->asMessage($this->fcmTokens);
    }

   
}
