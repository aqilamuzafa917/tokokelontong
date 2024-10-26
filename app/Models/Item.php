<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $fillable = [
        'item_category_id',
        'name',
        'price',
        'stock',
        'image'
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
    ];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }
}