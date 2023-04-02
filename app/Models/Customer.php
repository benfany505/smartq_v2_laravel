<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'name',
        'company',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'currency',
        'password',
        'enabled',
        'photo',
        'user_id',
    ];
}
