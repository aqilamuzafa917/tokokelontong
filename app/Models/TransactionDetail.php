<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id',
        'item_id',
        'quantity',
        'subtotal',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'subtotal' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        // Ensure quantity does not exceed available stock
        static::saving(function ($detail) {
            if ($detail->quantity > $detail->item->stock) {
                throw new \Exception('Jumlah Quantity pembelian tidak boleh melebihi stock.');
            }

            // Calculate subtotal before saving
            $detail->subtotal = $detail->quantity * $detail->item->price;
        });

        // Update transaction total after saving
        static::saved(function ($detail) {
            $detail->transaction->save();
        });
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
