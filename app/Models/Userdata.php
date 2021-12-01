<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userdata extends Model
{
    use HasFactory;

    protected $fillable = [
        'liteauth_id',
        'type',
        'data',
        'order_id'
    ];


}
