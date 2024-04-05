<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailToOwner extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //get data from incoming requests

        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //Set Log for data checking
        \Log::info('Contact Mail is sent');

        //Create view and passing Mail Data
        return $this->from($this->data->email, $this->data->name)
        ->subject('Contact Mail')
        ->view('contact.mail');
    }
}
