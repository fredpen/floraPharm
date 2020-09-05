<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
        return (new MailMessage)
            ->greeting("Dear Florax")
            ->line("An email was just sent to you from " . $this->from . " with the following details")
            ->line("Name: " . $this->name)
            ->line("Email: " . $this->from)
            ->line("Phone: " . $this->phone)
            ->line("Title: " . $this->title)
            ->line("Message body: " . $this->body);
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
