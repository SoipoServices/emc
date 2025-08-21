<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEventCreated extends Notification implements ShouldQueue
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
            ->subject('New Event Created: '.$this->event->title)
            ->line('A new event has been created.')
            ->line('Event Title: '.$this->event->title)
            ->line('Event Date: '.$this->event->start_date->format('F j, Y, g:i a'))
            ->line('Event Location: '.$this->event->address)
            ->action('View Event', route('public.event.show', ['slug' => $this->event->slug]))
            ->line('Thank you for using our application!');
    }
}
