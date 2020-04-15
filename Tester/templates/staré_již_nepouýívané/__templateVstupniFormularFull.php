<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="cs">
    <meta name="description" content="">
    
    <link  rel="stylesheet" type="text/css" href="<?= $basePath ?>/public/css/testQuickF.css" > 
    <link  rel="stylesheet" type="text/css" href="<?= $basePath ?>/public/css/vvFormular.css" > 

    <title>   <?= $nazevTestu ?>    </title>                  
  </head>
  <body>
      <input type='image' src = "<?= $basePath ?>/public/obrazky/Grafia100.jpg" /> 
                <span class='nadpisTestu' >&nbsp;    <?= $nazevTestu ?>  </span>
                
    
        <?= $uvodniText ?>  
               
                VSTUPNI FULL FORMULAR
           
        <?= $vstupHtmlForm  ?> 
  </body>
</html>

 <?php
        //foreach( $poleProTemplate as  $key => $value): 
        ?>

        <?php
        // '*otazka ' . $value['identifikatorOdpovedi'] . '*&nbsp;&nbsp;odpoved &nbsp;' . $value['odpoved'] . '&nbsp;
         //                                 *spravna odpoved &nbsp;' .
         //                                  $value['spravnaOdpoved'] . '*&nbsp;' 
        ?>
          <?php 
        //$value['spravneY/N'] === \TRUE ? '<span class="vsZelena"> DOBŘE! </span><br>' : '<span class="vsCervena"> CHYBA! </span><br>' //?>                         
        <?php 
        //endforeach //?>