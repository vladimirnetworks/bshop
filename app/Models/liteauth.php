<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class liteauth extends Model
{
    use HasFactory;
    protected $fillable = ['hash'];

    public static function me()
    {
        $id =  base_convert($_COOKIE['base_address'],33,10);
        $whoiam = liteauth::where([["id",'=',$id],['hash','=',$_COOKIE['x_address']]]);

        dd($whoiam);
        return $whoiam->first();
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order')->orderBy('id','desc');
    }

}
