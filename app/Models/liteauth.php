<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class liteauth extends Model
{
    use HasFactory;
    protected $fillable = ['hash'];

    public function me()
    {
        $id =  base_convert($_COOKIE['base_address'],33,10);
        $whoiam = liteauth::where([["id",'=',$id],['hash','=',$_COOKIE['x_address']]]);
        return $whoiam;
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}
