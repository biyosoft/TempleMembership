<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'item_code_id',
        'amount'
    ];

    public function payment()
    {
        return $this->belongsTo(payment::class);
    }
}
