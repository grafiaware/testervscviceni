<!DOCTYPE html>
 <html>
    <head>
        <title>Rekapitulace testu</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">       
        
        <link  rel="stylesheet" type="text/css" href="<?= $basePath ?>/public/css/testQuickF.css" >
        <link  rel="stylesheet" type="text/css" href="<?= $basePath ?>/public/css/vvFormular.css" > 
                               
    </head>
    <body>
        <br>                       
        
      <input type='image' src = "<?= $basePath ?>/public/obrazky/Grafia100.jpg" /> 
                <span class='nadpisTestu' >&nbsp;    <?= $nazevTestu ?>  </span>
                
    
        <?= $uvodniText ?>  
               
                VYSTUPNI FORMULAR
           
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