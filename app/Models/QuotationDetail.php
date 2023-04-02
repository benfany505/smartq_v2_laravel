<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationDetail extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'quotation_number',
        'type',
        'subid',
        'sub_title',
        'id_item',
        'desc',
        'name',
        'brand',
        'qty',
        'price',
        'unit',
        'ammount',
        'is_tax',
        'tax_ammount',
        'user_id',
    ];

    protected $casts = array(
        "qty" => "float",
        "price" => "float",
        "ammount" => "float",
        "discount_value" => "float",

    );

    protected $table = 'quotation_details';
    protected $dates = ['deleted_at'];

}
