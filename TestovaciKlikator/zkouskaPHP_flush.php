<?php
//ob_end_clean();


$str = "first=value&arr[]=foo+bar&arr[]=baz";

parse_str($str, $output);
print_r($output['first'] . "<br>");  // value

echo $output['arr'][0] ."<br>"; // foo bar

echo $output['arr'][1] ."<br>"; // baz


for ($i = 0; $i<5; $i++){

        echo "<br> Line to show.";
        echo str_pad('-',80,'*')."\n";   
 $cojetam = ob_get_contents();
        ob_flush();  //  flushne z phpbufferu
        flush();  // vyflusne systemovy??apacheovy?? buffer
        sleep(2);
}

$locale = setlocale(LC_ALL, '0');

$i++;


