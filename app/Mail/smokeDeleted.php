<?php

namespace App\Mail;

use App\Smoke;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class smokeDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $smoke;

    public function __construct($smoke)
    {
      $this->smoke = $smoke;
    }

    public function build()
    {
      return $this->view('emails.smokeDeleted');
    }
}
