<?php

namespace Threads\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreateNotificationReplied extends Notification
{
    use Queueable;
    protected $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reply)
    {
        $this->reply=$reply;    }

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
        $route=$this->reply->post->slug;
        return (new MailMessage)
                    ->subject('Regarding Answer for your Question')
                    ->line($this->reply->user->name.' answered your question on '.$this->reply->post->title)
                    ->action('See Answer', url('question/'.$route))
                    ->line('Thank you!');
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
}
