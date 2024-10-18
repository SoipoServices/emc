<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Event;

class NewEventForApproval extends Notification
{
    use Queueable;

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new event has been created and requires your approval.')
                    ->line('Event Title: ' . $this->event->title)
                    ->action('Review Event', route('filament.admin.resources.events.edit',['record'=>$this->event->id] ))
                    ->line('Thank you for using our application!');
    }
}
