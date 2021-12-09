<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'parent'
    ];


    public static function AllParent($catid)
    {

        $parents = array();
        $parent = $catid;

       
        do {
            $cat = Cat::whereId($parent)->first();

            $parent = $cat->parent;

            if ($parent > 0) {
                $parents[] = $parent;
            }
            
     
        } while ($parent != 0);

        return $parents;
    }





}
