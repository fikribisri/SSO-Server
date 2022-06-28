<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crendential extends Model
{
    protected $table = 'oauth_clients';

    protected $fillable = [
        'name', 'secret', 'redirect','deleted_at','personal_access_client','password_client','revoked','trusted'
    ];
}
