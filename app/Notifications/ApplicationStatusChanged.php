<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Application;

class ApplicationStatusChanged extends Notification
{
    use Queueable;

    public function __construct(protected Application $application) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'message' => "Your application for {$this->application->job->title} has been {$this->application->status}",
            'link' => route('applications.show', $this->application),
            'application_id' => $this->application->id
        ];
    }
}
