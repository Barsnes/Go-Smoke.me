<?php

namespace App\Mail;

use App\Smoke;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class smokeDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $smoke;

    public function __construct(Smoke $smoke)
    {
      $this->smoke = $smoke;
    }

    public function build()
    {
      return $this->view('emails.smokeDeleted');
    }
}
