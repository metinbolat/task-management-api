<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendTaskCreatedEmail extends Notification
{
    use Queueable;

    protected Task $task;

    /**
     * Create a new notification instance.
     */
    public function __construct($task)
    {
        $this->task = $task;
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
                    ->greeting('Merhaba ' . $notifiable->name . ',')
                    ->line('Yeni bir göreviniz var')
                    ->action('Görevi Görüntüleyin', url('api/v1/tasks/'.$this->task->id))
                    ->line('Eğer "Görevi Görüntüleyin" butonunda bir sorun varsa, aşağıdaki URLyi web tarayıcınıza kopyalayıp yapıştırabilirsiniz:')
                    ->line(url('api/v1/tasks/'.$this->task->id))
                    ->salutation('İyi çalışmalar.');
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
