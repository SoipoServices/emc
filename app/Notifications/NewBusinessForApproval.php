<?php

namespace App\Notifications;

use App\Models\Business;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBusinessForApproval extends Notification
{
    use Queueable;

    protected $business;

    public function __construct(Business $business)
    {
        $this->business = $business;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new business has been created and requires your approval.')
                    ->line('Name: ' . $this->business->name)
                    ->action('Review Business', url('/admin/business/' . $this->business->id))
                    ->line('Thank you for using our application!');
    }
}
