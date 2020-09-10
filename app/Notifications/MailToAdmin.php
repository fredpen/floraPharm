<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class MailToAdmin extends Notification
{
    protected $title;
    protected $body;
    protected $from;
    protected $phone;
    protected $name;
    protected $other;

    public function __construct($title, $body, $from, $phone, $name, $other = false)
    {
        $this->title = $title;
        $this->body = $body;
        $this->from = $from;
        $this->phone = $phone;
        $this->name = $name;
        $this->other = $other;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $baseUrl = Config::get('constants.url') . "/admin/notifications";
        return (new MailMessage)
            ->greeting("Hi Florax")
            ->line("How are you doing today? this is to notify you that, ")
            ->line("An email was just sent to you from " . $this->name . " with the following details")
            ->line("Name: " . $this->name)
            ->line("Email: " . $this->from)
            ->line("Phone: " . $this->phone)
            ->line("Title: " . $this->title)
            ->line("Message body: " . $this->body)
            ->action("Read more", $baseUrl);
    }

    public function toDatabase($notifiable)
    {
        return [
            "title" => $this->title,
            "body" => $this->body,
            "from" => $this->from,
            "phone" => $this->phone,
            "name" => $this->name,
            'order' =>  $this->other ? $this->$this->other : ""
        ];
    }
}
