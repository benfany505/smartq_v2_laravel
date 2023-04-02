<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_company',
        'name',
        'short_tag',
        'email',
        'phone',
        'logo_url',
        'user_id',
    ];
}
