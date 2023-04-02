<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'quotation_number',
        'title',
        'account',
        'date',
        'due_date',
        'date_paid',
        'discount',
        'discount_value',
        'tax',
        'subtotal',
        'total',
        'credit',
        'discount_type',
        'vtoken',
        'ptoken',
        'status',
        'header',
        'footer',
        'notes',
        'user_id',
    ];
    protected $casts = array(
        "subtotal" => "float",
        "total" => "float",
        "discount" => "float",
        "discount_value" => "float",

    );
    protected $table = 'quotations';
    protected $dates = ['deleted_at'];
}
