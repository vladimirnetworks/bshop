<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $photo ="test";
 
    protected $fillable = [
        'title',
        'price',
        'photos',
        'photo'
    ];

    public function cartnfo()
    {
        return str_replace('','',json_encode(["id"=>$this->id,"title"=>$this->title,"price"=>$this->price]));
    }

}
