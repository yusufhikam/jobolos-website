<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingShipped extends Mailable
{
    use Queueable, SerializesModels;
    public $bookingData;
    public $user;
    public $package;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bookingData, $user, $package)
    {
        $this->bookingData = $bookingData;
        $this->user = $user;
        $this->package = $package;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'New Photoshoot Booking Notification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(

            view: 'mail.emailNewBooking',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}