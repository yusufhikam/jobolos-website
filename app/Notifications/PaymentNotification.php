<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentNotification extends Notification
{
    use Queueable;

    protected $booking;
    protected $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($booking, $message)
    {
        $this->booking = $booking;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        // ->subject('Pembayaran Telah Disetujui')
        // ->line('Pembayaran Anda untuk booking dengan detail sebagai berikut telah disetujui:')
        // ->line('Tanggal Pembayaran: ' . $this->payment->created_at)
        // ->line('Jumlah Pembayaran: ' . $this->payment->bukti_pembayaran)
        // ->action('Lihat Detail Booking', url('/customer_dashboard/bookings'))
        // ->line('Terima kasih atas perhatiannya!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'booking' => $this->booking->id,
            'message' => $this->message,
            'created_at' => now(),
            'url' => '/admin_panel/adminManageBookingConfirmation',
            'type' => 'payment'
        ];
    }
}