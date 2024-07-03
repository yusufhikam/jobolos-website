<?php

namespace App\Mail;

use App\Models\Invoice;
use App\Models\RentalInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RentalInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rentalInvoice;
    public $filePath;
    public $rentalBooking;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RentalInvoice $rentalInvoice, $filePath, $rentalBooking)
    {
        $this->rentalInvoice = $rentalInvoice;
        $this->filePath = $filePath;
        $this->rentalBooking = $rentalBooking;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Rental Camera Invoice',
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
            view: 'mail.rentalInvoiceBooking',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromPath(storage_path('app/public/' . $this->filePath))->as('invoice.pdf')->withMime('application/pdf'),
        ];
    }
}