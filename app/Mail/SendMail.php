<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     * @throws \Swift_DependencyException
     */
    public function build()
    {
        $this->details['qr'] = QrCode::format('png')->size(100)->generate(Arr::get($this->details, 'domain'));
        $this->details['imageCID'] = \Swift_DependencyContainer::getInstance()
                                                               ->lookup('mime.idgenerator')
                                                               ->generateId();
        $this->withSwiftMessage(function (\Swift_Message $swift) {
            $image = new \Swift_Image($this->details['qr'], "qr_code.png", 'image/png');
            $swift->embed($image->setId($this->details['imageCID']));
        });

        return $this->subject($this->details['title'])
                    ->markdown('emails.QRMail', $this->details);
    }
}
