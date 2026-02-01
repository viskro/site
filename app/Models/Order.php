<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'stripe_payment_intent_id',
        'amount',
        'currency',
        'status',
        'customer_email',
        'customer_data',
        'shipping_address',
        'billing_address',
        'cart_data',
        'summary_data',
        'email_sent',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'customer_data' => 'array',
        'shipping_address' => 'array',
        'billing_address' => 'array',
        'cart_data' => 'array',
        'summary_data' => 'array',
        'email_sent' => 'boolean',
    ];

    // Statuts de commande
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_REFUNDED = 'refunded';

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'En attente',
            self::STATUS_COMPLETED => 'Complétée',
            self::STATUS_CANCELLED => 'Annulée',
            self::STATUS_REFUNDED => 'Remboursée',
            default => $this->status
        };
    }

    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2) . ' €';
    }
}
