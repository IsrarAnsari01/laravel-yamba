<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VideoNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $videoDetails;

    public function __construct($data)
    {
        $this->videoDetails = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("israr46ansari@gmail.com")->subject("New Video Uploaded")->view("emails.VideoNotfication")->with([
            'username' => $this->videoDetails["username"],
            'title' => $this->videoDetails["title"],
        ]);
    }
}
