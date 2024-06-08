<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCompletedNotification extends Notification
{
    use Queueable;
    
    protected $order;
    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order= $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {   
        $address= $this->order->billingAddress;
        return (new MailMessage)
                    ->subject("Order #{$this->order->number} Completed")
                    ->greeting("Hi {$notifiable->name}")
                    ->line("New Order #{$this->order->number} Created by {$address->name} from {$address->country_name}")
                    ->action('Notification Action', route('dashboard.dashboard'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable){
        $address= $this->order->billingAddress;
        return [
            'title'=> "Order #{$this->order->number} Completed",
            'body'=> "New Order #{$this->order->number} Created by {$address->name} from {$address->country_name}",
            'icon' => 'fas fa-file',
            'url' => route('dashboard.dashboard')
        ];

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
