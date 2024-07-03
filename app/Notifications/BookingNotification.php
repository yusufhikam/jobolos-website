<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingNotification extends Notification
{
    use Queueable;
    protected $booking; // data yg akan di kirim ke notification


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        // ->subject('Booking Baru Masuk')
        // ->line('Ada booking baru dengan detail sebagai berikut:')
        // ->line('Nama Customer: ' . $this->booking->users->name)
        // ->line('Tanggal Booking: ' . $this->booking->tanggal)
        // ->action('Lihat Detail Booking', url('/admin_panel/adminManageBookingConfirmation'))
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
            'booking_id' => $this->booking->id,
            'message' => 'Booking Photoshoot baru telah dibuat oleh ' . $this->booking->users->name,

        ];
    }
}