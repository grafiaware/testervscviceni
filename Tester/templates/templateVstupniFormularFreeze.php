<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="cs">
    <meta name="description" content="">
    
    <link  rel="stylesheet" type="text/css" href="<?= $basePth ?>/public/css/testQuickF.css" > 
    <link  rel="stylesheet" type="text/css" href="<?= $basePth ?>/public/css/vvFormular.css" > 

    <title>   <?= $nazevTestu ?>    </title>                  
  </head>
  <body>
      <input type='image' src = "<?= $basePth ?>/public/obrazky/Grafia100.jpg" /> 
      <span class='nadpisTestu' >&nbsp; <?= $nazevTestu ?> 
                                        <?= $textyTesteruArr['vstupni_formular']['doplneni_nazvu']['freeze'] ?> </span>
                    
       
                
        <h2><?= $textyTesteruArr['vstupni_formular']['uvodni_text']['napis_h2']['freeze']  ?>  </h2>
        
        <h5>             
             <?= $textyTesteruArr['vstupni_formular']['uvodni_text']['napis_h5']['freeze']['spusten'] ?>    <?= $casSpusteni ?>  
             <?= $textyTesteruArr['vstupni_formular']['uvodni_text']['napis_h5']['freeze']['ulozen'] ?>     <?= $odpovedInserted ?> 
             <?= $textyTesteruArr['vstupni_formular']['uvodni_text']['napis_h5']['freeze']['ulozen-konec'] ?>  
             <?= $textyTesteruArr['vstupni_formular']['uvodni_text']['napis_h5']['freeze']['idPrubeh'] ?>   <?=  $idPrubehTestu ?>  
             <?= $textyTesteruArr['vstupni_formular']['uvodni_text']['napis_h5']['freeze']['idPrubeh-konec'] ?>    
         </h5>                 
        
        <p><?= $textyTesteruArr['vstupni_formular']['uvodni_text']['napis_p1']['freeze']  ?></p>
        <p><?= $textyTesteruArr['vstupni_formular']['uvodni_text']['napis_p2']['freeze']  ?></p>                    
                
        <?= $vstupHtmlForm  ?> 
  </body>
</html>