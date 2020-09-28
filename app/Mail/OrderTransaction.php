<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderTransaction extends Mailable
{
    use Queueable, SerializesModels;


    public $carts;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($carts,Order $order)
    {
        $this->carts = $carts;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Transaksi berhasil dilakukan')->markdown('emails.orders.transaction');
    }
}
