<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'fullname',
        'email',
        'password',
        'profile_image',
        'token',
        'is_verified',
        'verification_token',
        'reset_token',
        'reset_token_expires',
    ];

    protected $hidden = [
        'password',
        'token',
        'verification_token',
        'reset_token',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'reset_token_expires' => 'datetime',
    ];
}