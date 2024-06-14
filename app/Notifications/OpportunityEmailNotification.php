<?php

namespace App\Notifications;

use App\Models\Opportunity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class OpportunityEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $opportunity;

    /**
     * Create a new notification instance.
     */
    // public function __construct(
    //     // public Opportunity $opportunity
    // ) {
    //     //
    // }

    public function __construct(Opportunity $opportunity)
    {
        $this->opportunity = $opportunity;
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
            ->line('New Opportunity Alert!')
            ->line("An opportunity titled  {$this->opportunity->title} that matches your registered category is now available.")
            ->line('Please take a look and consider applying if it interests you.')
            ->action('View more details here', route('opportunities.show', $this->opportunity->id))
            ->line('Thank you!');
    }



    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'opportunity_id' => $this->opportunity->id,
            'title' => $this->opportunity->title,
            'description' => $this->opportunity->description,
            'category' => $this->opportunity->category,
            'closing_date' => $this->opportunity->closing_date,
            'img_url' => $this->opportunity->img_url,
        ];
    }
}
