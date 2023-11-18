<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['cashier_id', 'customer_id', 'invoice', 'cash', 'change', 'discount', 'grand_total'];

    /**
     * 1 transaction bisa memiliki banyak transaksi detail
     * @return HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    /**
     * agar bisa memanggil data customer melalui transaksi
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * memanggil data user dari data transaction
     * @return BelongsTo
     */
    public function cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    /**
     * 1 data transaksi bisa memiliki banyak profit
     * @return HasMany
     */
    public function profit(): HasMany
    {
        return $this->hasMany(Profit::class);
    }
}
