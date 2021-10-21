<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class Logger extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected $user, $params, $template;

    /**
     * Create a new message instance.
     *
     * @param $template
     * @param $params
     */
    public function __construct($template, $params)
    {
        $this->user = Auth::user();
        $this->params = $params;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->template)
                    ->with($this->params);
    }
}
