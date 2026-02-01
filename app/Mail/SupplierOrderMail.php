<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupplierOrderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Order $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: [env('MAIL_SELLER')],
            subject: 'New Sound Tags Order',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.supplier-order',
            with: [
                'order' => $this->order,
                'customerData' => $this->order->customer_data,
                'shippingAddress' => $this->order->shipping_address,
                'billingAddress' => $this->order->billing_address,
                'cartItems' => $this->order->cart_data,
                'summary' => $this->order->summary_data,
            ]
        );
    }
}
