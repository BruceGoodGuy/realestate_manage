<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $guard = 'clients';
    // protected $primaryKey = 'phone';
    protected $fillable = [
        'lastname', 'firstname', 'phone', 'password', 'email',
        'birthday', 'address', 'province', 'district', 'ward',
        'referral_code', 'note', 'status', 'created_from', 'created_by',
    ];

    protected $hidden = [
        'password',
    ];
}
