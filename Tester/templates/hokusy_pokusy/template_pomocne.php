

           
 //----------------------------priklad na foreach if ----------------------           
    <?php foreach($friends as $friend): ?>
        <li>
            <a href="/profile/<?=$this->e($friend->id)?>">
                <?=$this->e($friend->name)?>
            </a>
        </li>
    <?php endforeach ?>


    <?php if ($invitations): ?>
        <h2>Invitations</h2>
        <p>You have some friend invites!</p>
    <?php endif ?> 
//-----------------------------------------------------------------------------------    
<?php
       //    print_r($page->getController()->getValue());     
        ?>     
<span class="vsCervenaSrdce">&hearts;</span> 
 <style type="text/css">            
            body {
                margin-left: 10px;
                font-family: Arial,sans-serif;
                font-size: small;

                background-color: #DDD;
            }
            </style>

            
            
//-----------------------------------------------------------
   <?php $i=0; ?>
    <?php foreach($poleODPovedi as  $key => $value): ?>       
            <br>
    <?php 
     ++$i; 
     $indexSpravnychOdpovedi = $i-1; ?>    
            <?= $key ?> -- Vaše odpověď:  <?= $value ?> &nbsp;&nbsp;&nbsp;
            Správná odpověď; <?= $poleSpravnychOdpovedi[$indexSpravnychOdpovedi]['odpoved'] ?>
            &nbsp;&nbsp;&nbsp;      
            <?php if ($value == $poleSpravnychOdpovedi[$indexSpravnychOdpovedi]['odpoved']): ?>
                        <span class="vsCervena"> CHYBA </span>                        
            <?php endif ?> 
            
            *poleSpravnychOdpovedi <?= "[" . $indexSpravnychOdpovedi . "]"  ?>  
            idéčko   <?= $poleSpravnychOdpovedi[$indexSpravnychOdpovedi]['id']  ?> 
            odpoved  <?= $poleSpravnychOdpovedi[$indexSpravnychOdpovedi]['odpoved'] ?> -----
            pozn.:__index i++ = <?= $i . " =".  str_pad($i, 2, '0', STR_PAD_LEFT) ?> 
            
 <?php endforeach ?>
            