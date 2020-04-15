<?php
namespace Tester\View\Factory;

/**
 * 
 */
class DekujemeViewFactory {
  
    
      public function getView(KonfiguraceTestu  $konfiguraceTestu,
                            $htmlFormular,
                            $basePath,
                            $testUkoncen,
                            PrubehTestu $prubehTestu, 
                            Odpoved $odpoved = NULL) {
        
        $poleProTemplate ['basePath'] = $basePath;
        $poleProTemplate ['nazevTestu']  = $konfiguraceTestu->nazevTestu;
        /* @var  $prubehTestu->casSpusteni \DateTime */            
        $poleProTemplate ['casSpusteni'] = $prubehTestu->casSpusteni->format('Y-m-d H:i:s'); //datetime
        $poleProTemplate ['idPrubehTestu'] = $prubehTestu->idPrubehTestu;
        /* @var $odpoved->inserted \DateTime */
        $poleProTemplate ['odpovedInserted']  = ( ($odpoved) ? $odpoved->inserted : ''); //timestamp
        $poleProTemplate ['vstupHtmlForm'] = $htmlFormular;
        
        
        if ($testUkoncen ) {
            $poleProTemplate ['nazevTestu'] .= " - prohlížení ";
            $poleProTemplate ['uvodniText'] =
               "<h2> Tento test již byl ukončen. Zobrazují se uložené odpovědi.</h2> <h5>(Test byl spuštěn: " .  $poleProTemplate['casSpusteni'] . 
                " a uložen " . $poleProTemplate['odpovedInserted'] . "). (idPrubehTestu " . $poleProTemplate['idPrubehTestu'] .  ") </h5>
                <p>Na zvolené a správné odpovědi se můžete podívat překlikáváním mezi jednotlivými úlohami. (Tlačítka s čísly úloh  nad formulářem)
                <br>Prohlížení skončíte uzavřením prohlížeče.
                </p>" ;
        }
        else {
            $poleProTemplate ['uvodniText'] =
               "<p>
               Tento test nelze spouštět opakovaně.  Proto nezavírejte prohlížeč dokud test nedokončíte!<br>
               Vyplňujte v libovolném pořadí všechny úlohy. Mezi úlohami se pohybujte pomocí tlačítka Pokračuj, popřípadě tlačítky s čísly úloh nad formulářem. <br>
               Po stisku tlačítka Pokračuj Vás formulář  vždy navede k první nevyplněné úloze. <br></p>
               <p>Až budou označeny odpovědi u všech úloh, bude po stlačení tlačítka Pokračuj uložen celý test najednou. - O této skutečnosti budete na závěr informováni.<br>
               Poslední úlohu vyplňte skutečně až naposled, až si budete jisti, že nechcete žádnou odpověď opravit!
               </p>" ;
        }        
 
        $template = new PhpTemplate('templates/templateVstupniFormular.php');  //vytvori objekt Template a nastavi mu jmenosouboru s templatou
        
        $view = new View();
        $view->setTemplate($template)->setData($poleProTemplate);
             // pouzije v sobe nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi napr.echem       
               
        return $view;                
    }
    
    
    
    
}
