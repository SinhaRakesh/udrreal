<?php

namespace App\Mail;

use App\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PropertyEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $property;

    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Property $property, $request)
    {
        $this->property = $property;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.property.enquiry')
            ->cc('info@udaipurrealtors.com')
            ->subject('New Enquiry at UdaipurRealtors.com');
    }
}
