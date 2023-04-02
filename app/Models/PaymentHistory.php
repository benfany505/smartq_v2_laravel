<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'payer_id',
        'account',
        'date',
        'description',
        'ammount',
        'transaction_id',
        'method',
        'status',
        'category',
    ];

    protected $casts = array(

        "ammount" => "float",

    );

}
