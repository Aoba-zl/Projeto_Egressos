<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailController extends Mailable
{
    use Queueable, SerializesModels;

    private $ulr_token;
    private $mail_type;

    private $from_address;
    private $from_name;

    private $a;

    public function __construct($ulr_token, $mail_type)
    {
        $this->ulr_token = $ulr_token;
        $this->mail_type = $mail_type;

        $this->from_address = config('mail.from.address');
        $this->from_name = config('mail.from.name');
    }

    public function build()
    {
        switch ($this->mail_type)
        {
            case 'reset_mail':
                return $this->get_body_reset_mail();
            case 'rejected_profile':
                return $this->get_body_rejected_profile_mail();
            default:
                return $this->get_body_approved_profile_mail();
        }
    }

    // TODO: Corpo email redefinir senha
    private function get_body_reset_mail()
    {
        return $this->view('emails.mail_reset_password')
                    ->from($this->from_address, $this->from_name)
                    ->cc($this->from_address, $this->from_name)
                    ->bcc($this->from_address, $this->from_name)
                    ->replyTo($this->from_address, $this->from_name)
                    ->subject("Redefinir Senha")
                    ->with([ 'mail_url' => $this->ulr_token['url_token'] ]);
                    // ->with([ 'variavel no blade' => token ]);
                    // ->with([ 'test_message' => $this->ulr_token['url_token'] ]);
    }

    // TODO: Corpo email perfil reprovado
    private function get_body_rejected_profile_mail()
    {
        // return $this->view('emails.mail_rejected_profile')
        //             ->from($this->from_address, $this->from_name)
        //             ->cc($this->from_address, $this->from_name)
        //             ->bcc($this->from_address, $this->from_name)
        //             ->replyTo($this->from_address, $this->from_name)
        //             ->subject("Perfil Reprovado")
        //             ->with([ 'test_message' => $this->ulr_token['url_token'] ]);
    }

    // TODO: Corpo email perfil aprovado
    private function get_body_approved_profile_mail()
    {
        // return $this->view('emails.mail_approved_profile')
        //             ->from($this->from_address, $this->from_name)
        //             ->cc($this->from_address, $this->from_name)
        //             ->bcc($this->from_address, $this->from_name)
        //             ->replyTo($this->from_address, $this->from_name)
        //             ->subject("Perfil Aprovado")
        //             ->with([ 'test_message' => $this->ulr_token['url_token'] ]);
    }
}
