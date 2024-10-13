<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Post;
use App\Models\User;

class PostInteractionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $post;
    protected $interactingUser;
    protected $interactionType;

    public function __construct(Post $post, User $interactingUser, string $interactionType)
    {
        $this->post = $post;
        $this->interactingUser = $interactingUser;
        $this->interactionType = $interactionType;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $interactionVerb = $this->interactionType === 'reaction' ? 'reacted to' : 'commented on';

        return (new MailMessage)
            ->subject("New {$this->interactionType} on your post")
            ->line("{$this->interactingUser->name} has {$interactionVerb} your post.")
            ->action('View Post', url("/billboard/{$this->post->id}"))
            ->line('Thank you for using our application!');
    }
}
