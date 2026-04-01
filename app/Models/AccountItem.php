<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountItem extends Model
{
    protected $table = 'account_items';
    protected $primaryKey = 'account_id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'site',
        'account_username',
        'account_password',
        'account_image',
    ];
}