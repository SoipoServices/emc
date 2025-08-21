<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
            ->line('Event Title: '.$this->event->title)
            ->action('Review Event', route('filament.admin.resources.events.edit', ['record' => $this->event->id]))
            ->line('Thank you for using our application!');
    }
}
