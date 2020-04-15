<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="cs">
    <meta name="description" content="">
    
    <link  rel="stylesheet" type="text/css" href="<?= $basePth ?>public/css/testQuickF.css" > 
    <link  rel="stylesheet" type="text/css" href="<?= $basePth ?>public/css/vvFormular.css" > 

    <title>   <?= $nazevTestu ?>    </title>                  
  </head>
  <body>      
      
      <input type='image' src = "<?= $basePth ?>public/obrazky/Grafia100.jpg" /> 
      <span class='nadpisTestu' >&nbsp; <?= $nazevTestu ?>  
                                        <?= $textyTesteruArr['vstupni_formular']['doplneni_nazvu']['active'] ?> 
      </span>                              
                        
        <p><?= $textyTesteruArr['vstupni_formular']['uvodni_text']['napis_p1']['active']  ?></p>
        <p><?= $textyTesteruArr['vstupni_formular']['uvodni_text']['napis_p2']['active']  ?></p>                           
                
        <?= 
        $vstupHtmlForm  
        ?> 
  </body>
</html>