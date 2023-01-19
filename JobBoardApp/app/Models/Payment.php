<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function paymentdetail()
    {
        return $this->hasOne(PaymentDetail::class, 'payment_id', 'id');
    }

    public function subcription()
    {
        return $this->hasOne(Subcription::class, 'payment_id', 'id');
    }
}
