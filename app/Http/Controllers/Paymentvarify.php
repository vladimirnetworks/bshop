<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Paymentvarify extends Controller
{
    public function zarinpal($paymentid): void
    {
        echo decode_id($paymentid);
    }
}
