<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_date',
        'amount',
        'member_id',
        'admin_id',
    ];

    public function member()
    {
        return $this->belongsTo(membership::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class);
    }

    public function getPaymentDateAttribute($value)
    {
        return  Carbon::parse($value)->format('d/m/Y');
    }
}
