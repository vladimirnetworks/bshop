<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitor extends Model
{
    use HasFactory;

    protected $table = 'monitor';

    protected $fillable = ['url','useragent','cookie','get_param','post_param','referer','ip','phpinput','terminate_response','liteauth_id'];


}
