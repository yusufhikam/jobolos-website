<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RentalCameraBookingShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingData;
    public $user;
    public $camera;
    public $lens;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bookingData, $user, $camera, $lens)
    {
        $this->bookingData = $bookingData;
        $this->user = $user;
        $this->camera = $camera;
        $this->lens = $lens;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Rental Camera Booking Received',
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
            view: 'mail.emailNewRentalBooking',
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