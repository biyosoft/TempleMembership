<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [];

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

    public function getReceiptNoAttribute()
    {
        if ($this->receipt_id == null) return "";

        $payment_year = Carbon::parse($this->payment_date)->format('Y');

        $receipt_id = str_pad($this->receipt_id, 5, '0', STR_PAD_LEFT);

        return "$payment_year-$receipt_id";
    }
}
