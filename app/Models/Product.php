<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $photo;
    public $jsondata;
 
    protected $fillable = [
        'title',
        'tinytitle',
        'price',
        'photos',
        'photo',
        'caption'

    ];

    public function setd($i): void
    {
        $this->photo = $i;
    }
    public function cartnfo()
    {
        return str_replace('','',json_encode(["id"=>$this->id,"title"=>$this->title,"price"=>$this->price]));
    }



    public function getPhotoAttribute()
    {

        $phot = json_decode($this->photos, true);

        $phott = null;
        if (isset($phot[0])) {
            $phott = $phot[0]['medium'];
        }


        return $phott;
    }


    public function getCatAttribute()
    {
       
       /* $cats = Relish::whereProductId($this->id);
       
       $ct = [];
       foreach ($cats as $cat) {
        $ct[] = $cat->cat_id;
       }
       return $ct;
       */

       return [2,3,4];
    }
   


    public function getLicaptionAttribute()
    {


        return lize($this->caption);
    }


    protected $appends = ['photo','licaption'];





}
