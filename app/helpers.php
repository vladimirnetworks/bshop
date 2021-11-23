
   <?php
   
    function encode_id($inp)
    {

        $begin = rand(1,9);
        $end = rand(1,9);      
        $xr = $begin.strrev($inp+$end+$begin).$end;

        return $xr;
    }

    ?>
