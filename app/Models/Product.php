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
        'caption',
        'searchkey'

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
            $phott = ["small"=>$phot[0]['small']];
        }


        return $phott;
    }


    public function getCatAttribute()
    {
       
       $cats = Relish::whereProductId($this->id)->get();
       
       $ct = [];
       foreach ($cats as $cat) {
        $ct[] = $cat->cat_id;
       }
       return $ct;
       

       
    }
   


    public function getLicaptionAttribute()
    {


        return lize($this->caption);
    }



    public function getDvalAttribute()
    {


      //  return 'loadcat(".catmain","catload",{"type":"relateto","id":"'.$this->id.'"});';

        return '$(".loader").empty();setTimeout(function() {loadtoloader(".loader","relateto/'.$this->id.'");},1000);';

    }



    protected $appends = ['photo','licaption','cat','dval'];





}
