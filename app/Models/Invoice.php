<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Invoice extends Model implements JWTSubject
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'title',
        'account',
        'date',
        'due_date',
        'date_paid',
        'discount',
        'discount_value',
        'sub_discount_value',
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
        "sub_discount_value" => "float",

    );

    protected $table = 'invoices';
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
