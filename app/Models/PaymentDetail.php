<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'payment_id',
        'item_code_id',
        'amount'
    ];

    public function payment()
    {
        return $this->belongsTo(payment::class);
    }

    public function parentItem()
    {
        return $this->belongsTo(item::class, "item_code_id")->withTrashed();
    }
}
