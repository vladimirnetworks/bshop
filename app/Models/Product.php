<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $photo;
 
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

}
