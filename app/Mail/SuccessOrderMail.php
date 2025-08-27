<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuccessOrderMail extends Mailable implements ShouldQueue
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
            to: [$this->order->customer_email],
            subject: 'Confirmation de commande #' . $this->order->order_number . ' - Sound Tags',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.success-order',
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
