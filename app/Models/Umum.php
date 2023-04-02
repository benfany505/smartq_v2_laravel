<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umum extends Model
{
    use HasFactory;
    protected $fillable = [
        'perusahaan',
        'alamat1',
        'alamat2',
        'telp',
        'logoUrl',
        'volume',
        'mute',
        'text',
        'kecepatan',
        'folder_video',
        'mode_printer',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

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
