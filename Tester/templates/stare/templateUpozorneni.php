<!DOCTYPE html>
 <html>
    <head>
        <title>Test - Upozornění</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">            
         <link rel="stylesheet" href="css/zaverFormular.css">                            
    </head>
    <body>
        <br/>
        <span class="vsCervena">&hearts; Červená srdce &hearts;</span> 
               
        <?php if ($ok) : ?>       
           <span class="vsUpozorneniGreen">  *  <?= $upozorneni ?>  *&nbsp  </span>   
        <?php else :?>                   
            <span class="vsUpozorneniRed">  *  <?= $upozorneni ?>  *&nbsp;  </span>   
         <?php endif ?>     
        
        
        <span class="vsCervena">&hearts; Červená srdce &hearts;</span> 
        
        <br>                                   

    </body>                                                              
          
</html>
