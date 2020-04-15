<?php
use Pes\Container\Container;



/**
 * Po odeslani .
 */
class __Tester_Tabbed_Handler_Process implements HTML_QuickForm2_Controller_Action
{  
    protected $container;
   
    public function __construct( /*Container $container*/) {
  //      $this->container = $container;
    }
    
    /**
     * Tato metoda nastává po odeslání submitem(button) v případě, že data ve formuláři jsou kompletní.
     * tzn.  jsou : 'All pages are valid'  ( $tabbed->isValid(), $page->getController()->isValid() ) - volane z Tester_Tabbed_Handler_Submit->perform() )    
     * Vrací data vsech odpovedi z formulare. 
     *          
     * @return array
     */
    public function perform( HTML_QuickForm2_Controller_Page   $pageController, $name)  {          
//        
//        $C = $pageController->getController(); //pozn. na zjisteni , co je controller - controller je tabbed                   
//        return $vsechnyOdpovedi = $C->getValue(); 
    }
    
}        
    



//
//       
//         /* @var $odpovedAggRepo AggRepo\OdpovedAggregateRepository */
//            $odpovedAggRepo = $this->container->get(AggRepo\OdpovedAggregateRepository::class);            
//                                    
//            /* @var  $repoSessionTestu  SessionRepo\SessionTestu  */     
//            $repoSessionTestu = $this->container->get(  SessionRepo\SessionTestu::class ) ;
//            $sessionTestuEntity = $repoSessionTestu->get();  
//            $idPrubehTestu =  $sessionTestuEntity->idDbEntityPrubehTestu;
//
//            if ( $vsechnyOdpovedi AND $idPrubehTestu ) {                                   
//                $odpovediNaOtazkuColl = array();
//                //v key jsou identifikatory
//                foreach ($vsechnyOdpovedi as $key=>$value) { 
//                    $odpovedNaOtazku = new DbEntity\OdpovedNaOtazku();  
//                    $odpovedNaOtazku->identifikatorOdpovedi = $key ;
//                    $odpovedNaOtazku->hodnota = $value ;
//                    $odpovedNaOtazku->idPrubehTestuFk = $idPrubehTestu;       
//                    $odpovediNaOtazkuColl[] = $odpovedNaOtazku;
//                }                                  
//                $odpovedE =  new DbEntity\Odpoved();           
//                $odpovedE->idPrubehTestuFk = $idPrubehTestu;
//
//                /* @var    $repoSessionTabbedu SessionRepo\SessionTabbedu */ 
//                $repoSessionTabbedu = $this->container->get( SessionRepo\SessionTabbedu::class ) ;
//                $sessionTabbeduE = $repoSessionTabbedu->get();            
//                $odpovedE->sessionTabbedu = $sessionTabbeduE;        
//
//                //--------------------------------------------------
//                $novaOdpovedAggregateE = new OdpovedAggregate();                                   
//                $novaOdpovedAggregateE->sessionTestu =  $sessionTestuEntity; 
//                $novaOdpovedAggregateE->odpoved = $odpovedE;
//                $novaOdpovedAggregateE->odpovediNaOtazky = $odpovediNaOtazkuColl;
//            }    
//            else {
//                 throw new \UnexpectedValueException( "Neplatné vstupní parametry (vsechnyOdpovedi/idPrubehTestu)." ); 
//            }             
//            $novaOdpovedAggregateE->sessionTestu->testUkoncen = true;    //   U K O N C E N I
//            $odpovedAggRepo->add( $novaOdpovedAggregateE );              //   U K L A D A M  odpoved, odpoved(i) na otazku, session  (z aggregatu $novaodpovedAggregatE)
//            //... muzu odhchytit vyjimku ...
//            
//            return ;
        
         
                // if ($tabbed->isValid()) {   //kompletni data uplne (tj vsechny odpovedi  a splnena pravidla )
                // throw new \LogicException("Nedošlo k přesměrování po tabbed->() v metodě ".__CLASS__."->".__METHOD__. "().v (->run).");
                // kdyz je treba zobrazit cerveny ramecek, neni valid = nechci ulozit,  to se sem vubec nedostanu              
// ukazka    try
//            /* @var   $C  Tester\Tabbed\Controller\TesterovyController */     // Tester_Tabbed_TesterovyController  */
//            $C = $pageController->getController(); //pozn. na zjisteni , co je controller
//            try {
//                $vsechnyOdpovedi = $C->getValue();    //<<<<<<<<<<<<<<<<<<<<?????????????????????????????????????
//            } catch ( Exception\NeuplnyTest  $e) {
//                throw new Exception\NelzeVratitData ('Process handler - nelze vratit data.' .  $e->getMessage() , 'kod-NeuplnyTest' , $e);                        
//            }
//            
//            try {
//                $ulohaJeValidni = $pageController->storeValues();
//            } catch ( Exception\NevalidniStranka $e ) {
//                throw new Exception\NelzeVratitData ('Process handler - nelze vratit data.' . $e->getMessage() , 'kod-NevalidniStranka' , $e);                     
//            }
            
            
          
            
            
//            //***********************  'vymazat' session data z repository session, pak se nelze vratit zpetitkem po ulozeni odpovedi          
//            /* @var   $sessionTestuRepo    SessionRepo\SessionTestu */              
//            $sessionTestuRepo =  $this->container->get( SessionRepo\SessionTestu::class );
//            $sessionTestuE = $sessionTestuRepo->get();
//            $sessionTestuRepo->remove($sessionTestuE);
//            /* @var   $sessionTabbeduRepo  SessionRepo\SessionTabbedu */
//            $sessionTabbeduRepo = $this->container->get( SessionRepo\SessionTabbedu::class );
//            $sessionTabbeduE = $sessionTabbeduRepo->get();
//            $sessionTabbeduRepo->remove( $sessionTabbeduE );
            
          

