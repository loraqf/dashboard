<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['counterparty_id', 'product_id', 'amount', 'price', 'total_amount'];

    public function counterparty()
    {
        return $this->belongsTo(Counterparty::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
