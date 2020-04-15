<?php
namespace Tester\Validator\Request;

use Tester\Validator\Request\ValidatorInterface;

use Tester\Service\ServiceInterface;

use Pes\View\Template\PhpTemplate;
use Pes\View\View;

/**
 * Description of Validator
 *
 * @author vlse2610
 */
class OOOValidatorPozadavekSpusteniTestu implements ValidatorInterface {      
    private $service ;
    
    
    public function __construct( ServiceInterface  $service ) {
        $this->service = $service ;
    }
    

    
    public function isValid() {   
        $zprava = "<br/>";
        
        if ($this->service->trvaTest()) { // SESSION_TEST_TRVA existuje
           // trva test 
           $zprava .= " Test trvá ( identifikator -test trva- je v session). "; 
                                             
           $jeMetodaRequestuGETzQuickformu = $this->service->jeMetodaRequestuGETzQuickformu();
           if ($jeMetodaRequestuGETzQuickformu) {  //$this->zaridVystup( $zprava, true ); 
               return TRUE;}
           else {$zprava .= "- Není to Metoda Requestu GET zQuickformu. ";}  //FALSE
           
           $jeMetodaRequestuPOSTzQuickformu = $this->service->jeMetodaRequestuPOSTzQuickformu();
           if ($jeMetodaRequestuPOSTzQuickformu) {  //$this->zaridVystup( $zprava, true ); 
               return TRUE;}  
           else {$zprava .= "- Není to Metoda Requestu POST zQuickformu. ";}  //FALSE
                     
           $jeMetodaRequestuGET = $this->service->jeMetodaRequestuGET();
           if ($jeMetodaRequestuGET) {$zprava .= "- Je to Metoda Requestu GET. "; }  
           else {$zprava .= "- Není to Metoda Requestu GET. ";}  //FALSE
           $jeMetodaRequestuPOST = $this->service->jeMetodaRequestuPOST();
           if ($jeMetodaRequestuPOST) { $zprava .= "- Je to Metoda Requestu POST. "; }  
           else {$zprava .= "- Není to Metoda Requestu POST. ";}  //FALSE
       
        } 
        else {  
            //netrva
            $zprava .= " Test netrvá (  identifikator -Test trva-  neni v session). ";
                        
            $jeIniGet =  $this->service->jeInicializacniGet();
            if ( isset($jeIniGet) and   ($jeIniGet===TRUE) ) { 
                $zprava .= "- Je to iniGET. "; //ma vsechny argumenty(parametry) behu
                //$this->zaridVystup( $zprava, true );
                return  TRUE;
            }
            else{
                $zprava .= "- a Není to iniGET. ";                
            }                                                  
        }    
        
        $zprava .= "<br/> T A K H L E &nbsp;&nbsp; SE TO  NEPOUSTI !! <br/>";
        $this->zaridVystup( $zprava, false );                                 
        return FALSE;        
        }
        
        
        private function zaridVystup ( string $zprava , bool $ok ) {
            
            $poleProTemplate['upozorneni'] = $zprava;
            $poleProTemplate['ok'] = $ok;
            $templateO = new PhpTemplate('templates/templateUpozorneni.php');  //vytvori objekt Template a nastavi mu jmenosouboru s templatou
            $view = new View();                   //vytvori objekt View (parametr objekt Renderer)        
            $vystupS = $view->setTemplate($templateO)->setData($poleProTemplate)->render();   // pouzije v sobe nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi echem       
            echo( $vystupS );      
            
        }
        
//        
//    //--------------- zahodit --------------------------------------------------------------------    
//           
//        if ($this->service->trvaTest()) { // SESSION_TEST_TRVA existuje
//           // trva test  - 
//            if ( isset($identifikatorTestu ) ) {
//               // zde dalsi runda (test trva) a  nasel identifikatorTestu (hledal v session)
//
//               //Toto netestovano :pokud zaroven je  identifikator v session  a i v request ---> pak je to opakovane spusteni bez zavreni prohlizece
//               //Toto netestovano :pokud zaroven je identifikator v session a neni v request ---> pak je to bezna dalsi runda
//
//                        $poleProTemplate['upozorneni'] =  "Test je spuštěn (v Session) a identifikatorTestu nalezen (v session). ";
//                        $poleProTemplate['ok'] = TRUE;
//                        $templateO = new TemplatePhp('templates/templateUpozorneni.php');  //vytvori objekt Template a nastavi mu jmenodouboru s templatou
//                        $renderer = new RendererPhp($templateO);           //vytvori objekt Renderer (pro html) a nastavi mu objekt Template
//                        $view = new View($renderer);                   //vytvori objekt View (parametr objekt Renderer)        
//                        $vystupS = $view->render( $poleProTemplate);      // pouzije v sobe nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi echem       
//                    echo( $vystupS );                        
//            }        
//            else {
//                // zde dalsi runda (test trva) a  nenasel identifikatorTestu (hledal v session)
//                //TODO vypis chybu ve strance
//                //throw new \UnexpectedValueException( "Chyba: Test je spuštěn (v Session) a identifikatorTestu nenalezen (v session) (není to pokracovaci runda). " ) ;
//                //mozna nebude zde chyba  volana---  
//
//                        $poleProTemplate['upozorneni'] = "Chyba logiky programu: Test je spuštěn (v Session) a identifikatorTestu nenalezen (v session).--NESMYSL";
//                        $poleProTemplate['ok'] = FALSE;
//                        $templateO = new TemplatePhp('templates/templateUpozorneni.php');  //vytvori objekt Template a nastavi mu jmenodouboru s templatou
//                        $renderer = new RendererPhp($templateO);           //vytvori objekt Renderer (pro html) a nastavi mu objekt Template
//                        $view = new View($renderer);                   //vytvori objekt View (parametr objekt Renderer)        
//                        $vystupS = $view->render( $poleProTemplate);      // pouzije v sobe nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi echem                           
//                    echo( $vystupS ); 
//                    exit;
//            }
//        }  
//        else { 
//            //netrva test  zde prvni runda            
//            if ( isset($identifikatorTestu ) ) {
//                 // zde prvni runda (test netrva) a  nasel identifikatorTestu (hledal v request)
//
//                        $poleProTemplate['upozorneni'] =  "Test není spuštěn (v Session) a identifikatorTestu nalezen (v request). ";
//                        $poleProTemplate['ok'] = TRUE;
//                        $templateO = new TemplatePhp('templates/templateUpozorneni.php');  //vytvori objekt Template a nastavi mu jmenodouboru s templatou
//                        $renderer = new RendererPhp($templateO);           //vytvori objekt Renderer (pro html) a nastavi mu objekt Template
//                        $view = new View($renderer);                   //vytvori objekt View (parametr objekt Renderer)        
//                        $vystupS = $view->render( $poleProTemplate);      // pouzije v sobe nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi echem       
//                    echo( $vystupS );      
//
//                //zapsat identifikator do session            
//                $it = $service->nastavTestTrva($identifikatorTestu);                       
//            }
//            else {                
//                // zde prvni runda (test netrva) a  nenasel identifikatorTestu (hledal v request) ----blbe spusteni testu(prvni runda a je bez parametru)
//                //prisel ze spoustece chybny request                  
//
//                        $poleProTemplate['upozorneni'] = "Chyba logiky programu: Test není spuštěn (v Session), a identifikatorTestu nenalezen (v Request).";
//                        $poleProTemplate['ok'] = FALSE;
//                        $templateO = new TemplatePhp('templates/templateUpozorneni.php');  //vytvori objekt Template a nastavi mu jmenodouboru s templatou
//                        $renderer = new RendererPhp($templateO);           //vytvori objekt Renderer (pro html) a nastavi mu objekt Template
//                        $view = new View($renderer);                   //vytvori objekt View (parametr objekt Renderer)        
//                        $vystupS = $view->render( $poleProTemplate);      // pouzije v sobe nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi echem                           
//                    echo( $vystupS );         
//                    exit;   
//
//            }
//        
//    }  
    //------------------------------------------------------------------------------
    
    
    
 
    
}
