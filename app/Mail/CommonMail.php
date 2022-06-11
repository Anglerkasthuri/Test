<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Blade;

use App\Models\MailTemplate;
use DbView;



class CommonMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mail;
    public $template;
    public $record;
    /**
     * Create a new message instance.
     *
     * @return void
     */


    public function __construct($template, $record)
    {
        //
        $this->template = $template;
        $this->record = $record;
    }    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = Blade::render(
            $this->template->subject,
            ['record' => $this->record],
            deleteCachedView: true
        );
        $content = Blade::render(
            $this->template->content,
            ['record' => $this->record],
            deleteCachedView: true
        );
        
        return $this->subject($subject)->view('emails.common_mail', ['content'=> $content]);
    }
}
