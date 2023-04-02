<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

class InvoiceDetail extends Model implements JWTSubject
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'invoice_number',
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

    protected $table = 'invoice_details';
    protected $dates = ['deleted_at'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
