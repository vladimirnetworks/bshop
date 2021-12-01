<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['data', 'liteauth_id', 'shipping_status', 'payment_status', 'shipping', 'selected_shipping', 'encoded_id'];


    public function getCartAttribute()
    {
        $cart = json_decode($this->data, true);
        $cart_with_amount = [];

        $totamount = 0;

        foreach ($cart as $item) {

            $hitmount = $item['price'] * $item['count'];

            $totamount = $totamount + $hitmount;
            $item['amount'] = $hitmount;

            $cart_with_amount[] = $item;
        }

        return ['cart' => $cart_with_amount, "amount" => $totamount];
    }

    public function getShowShippingAttribute()
    {
        $shippingx = json_decode($this->shipping, true);
        return $shippingx[$this->selected_shipping];
    }


    public function getAddressAttribute()
    {
        $addresss = $this->userdatas()->whereType("address")->first();
        return $addresss->data;
    }


    public function getPhoneAttribute()
    {
        $phonex = $this->userdatas()->whereType("phone")->first();
        return $phonex->data;
    }


    public function getTotalAmountAttribute()
    {

        $cart = json_decode($this->data, true);

        $totamount = 0;



        foreach ($cart as $item) {
            $prod = Product::whereId($item['id'])->first();
            $totamount = $totamount + ($prod->price * $item['count']);
        }


        $shipping = json_decode($this->shipping, true);




        return $totamount + $shipping[$this->selected_shipping]['cost'];
    }






    public function userdatas()
    {
        return $this->hasMany('App\Models\Userdata')->orderBy('id','desc');
    }


 


}
