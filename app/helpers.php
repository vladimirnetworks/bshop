
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

?>