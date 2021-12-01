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

        if ($_COOKIE['base_address'] && $_COOKIE['x_address']) {
            $baseaddress = $_COOKIE['base_address'];
            $xaddress = $_COOKIE['x_address'];
        } else if (isset($_POST['me'])) {
          $rx = explode(":",$_POST['me']);
          $baseaddress = $rx[0];
          $xaddress = $rx[1];
        }
        $id =  base_convert($baseaddress,33,10);

  
       
        $whoiam = liteauth::where([["id",'=',$id],['hash','=',$xaddress]]);

       
        return $whoiam->first();
    }



    public function orders()
    {
        return $this->hasMany('App\Models\Order')->orderBy('id','desc');
    }

    public function userdatas()
    {
        return $this->hasMany('App\Models\Userdata')->orderBy('id','desc');
    }

    
}
