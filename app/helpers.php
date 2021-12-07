<?php

function encode_id($inp)
{

    $begin = rand(1, 9);
    $end = rand(1, 9);

    $makhfil = $inp + $end + $begin;


    if ($begin * $end % 2 == 0) {

        $makhfil = strrev($makhfil);
    }

    $xr = $begin . (($makhfil)) . $end;

    return $xr;
}



function decode_id($inp)
{
    $begin = substr($inp, 0, 1);
    $end = substr($inp, strlen($inp) - 1, 1);


    $makhfil = substr($inp, 1, strlen($inp) - 2);
   
    if ($begin * $end % 2 == 0) {

        $makhfil = strrev($makhfil);
    }

    $number = $makhfil-$begin-$end;
    return   $number;
}



function lize($i) {
    $bits = explode("\n", trim($i));

    $lines = "";
    foreach($bits as $bit)
    {
      $lines .= "<li>" . $bit . "</li>";
    }

    return  $lines;

}

function persiannumber($i) {
 $nums = ["0","1","2","3","4","5","6","7","8","9"];
 $repl = ["۰","۱","۲","۳","۴","۵","۶","۷","۸","۹"];

 return str_replace($nums,$repl, $i);
}


function arabicToPersian($string)
    {
        $characters = [
            'ك' => 'ک',
            'دِ' => 'د',
            'بِ' => 'ب',
            'زِ' => 'ز',
            'ذِ' => 'ذ',
            'شِ' => 'ش',
            'سِ' => 'س',
            'ى' => 'ی',
            'ي' => 'ی',
            '١' => '۱',
            '٢' => '۲',
            '٣' => '۳',
            '٤' => '۴',
            '٥' => '۵',
            '٦' => '۶',
            '٧' => '۷',
            '٨' => '۸',
            '٩' => '۹',
            '٠' => '۰',
        ];
        return str_replace(array_keys($characters), array_values($characters),$string);
    }

    function real_ip() {
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
           return $_SERVER['HTTP_CF_CONNECTING_IP'];
        } else {
           return $_SERVER['REMOTE_ADDR'];
        }
    }

?>