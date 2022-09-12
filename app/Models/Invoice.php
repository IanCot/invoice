<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Casts\NipCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'date_of_issue',
        'seller_nip',
        'buyer_nip',
        'product',
        'amount'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'date_of_issue'=>'datetime:Y-m-d',
        'amount' => MoneyCast::class,
        'seller_nip' => NipCast::class,
        'buyer_nip' => NipCast::class
    ];
}
