<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['data','liteauth_id','shipping_status','payment_status','shipping','selected_shipping'];


    public function getTotalAmountAttribute()
    {

        $cart = json_decode($this->data, true);

        $totamount = 0;

        

        foreach ($cart as $item) {
            $prod = Product::whereId($item['id'])->first();
            $totamount = $totamount + ($prod->price * $item['count']);
        }


        return $totamount;
    }


}
