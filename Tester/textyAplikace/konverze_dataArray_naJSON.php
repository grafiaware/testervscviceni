<?php

function stupidConvertToNewNotation($arr) {
    return str_replace(['array (', '),'], ['[', '],'], $arr);
}

// obsahuje $dataArray array
include './Texty_Testeru.php';

//                $pom = var_export($ulohy, TRUE );
//                echo $pom . '<br>';      // string - vypis pole souvisly -  s array(
$exportPole = stupidConvertToNewNotation(var_export( $dataArray, TRUE ));
        echo $exportPole .  '<br>';     // string - vypis pole souvisly - s []                
    echo "<H3>Původní pole --</H3>";
    echo '<pre style="color:red; font-size:8px"  >';  echo $exportPole;    echo '</pre>';                
    
                
$exportJson = json_encode($dataArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $exportJson .  '<br>';   // string - vypis pole json syntaxe
    echo "<H3>Převedený záznam json --</H3>";
    echo '<pre style="color:blue; font-size:8px" >'; echo $exportJson;    echo '</pre>';                

$fp = fopen('Texty_Testeru.json', 'w');
fwrite($fp, $exportJson);  //zapis do souboru
fclose($fp);

$readedJson = file_get_contents('Texty_Testeru.json');
        echo $readedJson .  '<br>' ;   // string - vypis pole json syntaxe - prectene ze souboru    
    echo "<H3>Přečtený záznam json souboru --</H3>";    echo '<pre style="color:green; font-size:8px">';    echo $readedJson;
    echo '</pre>';    
    
$readedArray = stupidConvertToNewNotation(var_export(json_decode($readedJson, TRUE), TRUE ));  
        echo $readedArray .  '<br>' ;   // decode generuje pole s s array(
    echo "<H3>Přečtený JSON převedený na pole --</H3>";   echo '<pre style="color:tomato; font-size:8px" >';   echo $readedArray;
    echo '</pre>';        


//echo "<H3>Puvodni pole --</H3>";
//    echo '<pre style="color:red">';
//        echo $exportPole;
//    echo '</pre>';
//echo "<H3>Prevedeny zaznam json --</H3>";
//    echo '<pre style="color:blue">';
//        echo $exportJson;
//    echo '</pre>';
//
//echo "<H3>Přečtený zaznam json --</H3>";
//    echo '<pre style="color:green">';
//        echo $readedJson;
//    echo '</pre>';
//echo "<H3>Přečtený JSON převedený na pole --</H3>";
//    echo '<pre style="color:orange">';
//        echo $readedArray;
//    echo '</pre>';