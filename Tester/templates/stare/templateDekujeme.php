<!DOCTYPE html>

<html>
    <head>
        <title>Děkujeme!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">            
        
        <link rel="stylesheet" href="<?= $basePath ?>public/css/zaverFormular.css">                            
    </head>
    <body>
        <br><br>
        <span class="vsCervena">&hearts; Gratulujeme! &hearts;</span> 

        <H2><br> Vaše data byla uložena. <br> Děkujeme Vám za  vyplnění testu. <br>Zavřete prosím prohlížeč. <br><br> </H2>                 
        
        <form>
        <button  type="submit" formmethod="get" 
                 formaction= "<?= $basePath ?>vysledky/"> Chcete něco vidět???? </button> 
                <button  type="" formmethod="get" 
                 formaction= "<?= $basePath ?>uloha/<?= $prvniKlic ?>/"> ...prohlidka vyplneneho testu..</button>     <!--  na cislo, ktere existuje -->
        <br/>   <br/>    <br/>         
        
<!--        <button  type="submit" formmethod="get"          
                 formaction= " <>     ulohaFull/11/"> ...prohlidka vyplneneho testu s volbami(zelene, cervene)...(ulohaFull) </button>   
                 na cislo, ktere existuje -->
        </form>        
        
    </body>
</html>



<!-- TODO  vyber cisla ulohy ne natvrdo 11   -->

<!-- TODO  pro test z historie do klikatka vstup na takovy test ...asi v jine route jina template a jinde   -->
=
<!-- <button  type="submit" formmethod="get" 
                 formaction= " = $basePath   ulohaHistory/11/.."> ...prohlidka vyplneneho testu nekdy v minulosti... </button>    
-->