<?php
namespace Tester\Router;

use Pes\Http\RequestInterface;
use Pes\Http\RequestStatus;

use Tester\Model\Handler\SessionInterface;

use Tester\Validator\Request\InicializacniSpustTestRequest;
use Tester\Validator\Request\InicializacniUkazTestRequest;
use Tester\Validator\Request\QuickformGetRequest;
use Tester\Validator\Request\QuickformSubmitRequest;
use Tester\Validator\Request\QuickformNavigationRequest;
use Tester\Validator\Request\DikGetRequest;

use Tester\Controler\Tester ;
use Tester\Controler\Chyber ;

use Tester\Model\Aggregate\Repository\SpustenyTestAggregateRepoFactory;
use Tester\Model\Aggregate\Repository\OdpovedAggregateRepoFactory;
use Tester\Service\SpustTestServiceInterface;
use Tester\Model\Aggregate\EntityFactory\TestAggregateEntityFactory;


/**
 * Description of Akce
 *
 * @author vlse2610
 */
class Akce {

    private $request;
    /**
     *
     * @var SessionInterface
     */
    private $sessionHandler;

    private $spustenyTestAggregateRepoFactory;
    private $odpovedAggregateRepoFactory;
    private $spustTestService;
    private $spustenyTestAgregateEntityFactory;
    


    public function __construct(
                            RequestInterface $request,
                            SessionInterface $sessionHandler,
            SpustenyTestAggregateRepoFactory $spustenyTestAggregateRepoFactory,
                 OdpovedAggregateRepoFactory $odpovedAggregateRepoFactory,
                   SpustTestServiceInterface $spustTestService,
           TestAggregateEntityFactory $spustenyTestAgregateEntityFactory
            ) {

        $this->request = $request;
        // do indexu
        $this->sessionHandler = $sessionHandler;
        $this->spustenyTestAggregateRepoFactory =  $spustenyTestAggregateRepoFactory;
        $this->odpovedAggregateRepoFactory = $odpovedAggregateRepoFactory;
        $this->spustenyTestAgregateEntityFactory = $spustenyTestAgregateEntityFactory;
        // nechat
        $this->spustTestService = $spustTestService;
        
    }

     /**
     * 
     * @return Pes\Http\Response;
     * @throws \LogicException
     */
    public function route() {
        // $testerControler = new Tester($this->request, $this->spustenyTestAggregateRepoFactory, $this->odpovedAggregateRepoFactory );//$response stale tentyz
        // do indexu
        $testerControler = function() {
            return new Tester($this->request, $this->sessionHandler,
                    $this->spustenyTestAggregateRepoFactory,  $this->odpovedAggregateRepoFactory,  
                    $this->spustenyTestAgregateEntityFactory);//$response stale tentyz
        };
        $chybovyControler = function() { return new Chyber(); };
        //---------------------------------------------------------------------------------------------------------------        
           
        //***************************** GET **************************************
        
        if ( (new RequestStatus())->isGet($this->request)) {
           
//            //??POZOR na pořadí BLBOST
//            if ( ( (new InicializacniSpustTestRequest())->isValid( $this->request )) and
//                 ( (new QuickformGetRequest())->isValid($this->request)) ) {
//                        $response = $chybovyControler()->chyba(' Spuštěn další (možná i stejný) test. - možná chceme  ošetřit jinak. ');  
//                        return  $response; 
//            }    
            
            
            if ( (new InicializacniSpustTestRequest())->isValid( $this->request )) {               
                      //*zacatek vseho* ----  GET inicializacni  spousteci                 
                        $response = $testerControler()->getNovyTest(  $this->spustTestService );                           
                        return  $response  ;
            }
            if ( (new InicializacniUkazTestRequest())->isValid( $this->request )) {               
                      //*zacatek vseho* ----  GET inicializacni ukazovaci                  
                        $response = $testerControler()->getTest(  );    
                        return  $response  ;
            }
            if ( (new QuickformGetRequest())->isValid($this->request)) { //get, neni inicializacni, a je q                                           
                        $response = $testerControler()->getUloha(  );       // bezna stranka     
                        return  $response  ;
            }                
                                              
                 // 'cizi' GET, get, neni inicializacni, a neni q, ale muze to byt ten z presmerovani na dekovaci stranku (tam neni q )  
                 //asi se uz nepouziva
            if (  (new DikGetRequest)->isValid( $this->request) ) { //dekovaci stranka                           
                        $response = $testerControler()->zobrazVysledky(  );
                        return  $response  ;
            }                
        }//GET               

        
        //******************* POST**********************************************
        elseif ( (new RequestStatus())->isPost($this->request)) {
            if ((new QuickformSubmitRequest())->isValid($this->request)) {              
                   // regulerni quickform,  eventuelne se ulozi anebo taky ne, ! podle tabbedIsValid !                                                         
                        $response = $testerControler()->saveOdpoved(  );  
                        return  $response  ;
                                                  
            } elseif ((new QuickformNavigationRequest())->isValid($this->request)) {  //qf submit                   
                        $response = $testerControler()->getUloha();
                        return  $response  ;
                   
            } else {
                    throw new \LogicException('ER1 Přišel neznámý POST request.');
            }
            
        //********************
        } //POST
        else {
                throw new \LogicException('ER2 To sem blázen ini get, ani post ');
        }        
        
        return  $response  ;
    }//route
    
}




//    else {                            
//        $response = $chybovyControler()->chyba( 'U3 - nekorektni, necekany (cizi) get. '
//                    . '(Je to GET, sezeni trva , neni q,  neni to dekovaci)'  );
//    }       
        
//        if ((new RequestStatus())->isGet($this->request)) {
//            if ( (new InicializacniSpustTestRequest())->isValid( $this->request )) {               
//                      //*zacatek vseho* ----  GET inicializacni                   
//                    $response = $testerControler()->spustTest(  );                
//           
//            }else {  //get, neni inicializacni                                                  
//                if ( (new QuickformGetRequest())->isValid($this->request)) { //get, neni inicializacni, a je q                                           
//                        $response = $testerControler()->zobrazOtazku(  );       // bezna sztanka                                                                   
//                                              
//                }else {  // 'cizi' GET, get, neni inicializacni, a neni q, ale muze to byt ten z presmerovani na dekovaci stranku (tam neni q )                   
//                        if (  (new DikGetRequest)->isValid( $this->request) ) { //dekovaci stranka                           
//                            $response = $testerControler()->zobrazVysledky(  );
//                           
//                        }else {                            
//                            $response = $chybovyControler()->chyba( 'U3 - nekorektni, necekany (cizi) get. '
//                                        . '(Je to GET, sezeni trva , neni q,  neni to dekovaci)'  );
//                        }
//                }
//            }                   
//        }

    
//
//    /**
//     * 
//     * @return Pes\Http\Response;
//     * @throws \LogicException
//     */
//    public function routeOOO() {
//        // $testerControler = new Tester($this->request, $this->spustenyTestAggregateRepoFactory, $this->odpovedAggregateRepoFactory );//$response stale tentyz
//        $testerControler = function() {
//            return new Tester($this->request, $this->sessionHandler, $this->spustenyTestAggregateRepoFactory,  $this->odpovedAggregateRepoFactory);//$response stale tentyz
//        };
//        $chybovyControler = function() { return new Chyber(); };
//        //---------------------------------------------------------------------------------------------------------------        
//   
//        
//        //***************************** GET **************************************
//        if ((new RequestStatus())->isGet($this->request)) {
//            if ( (new InicializacniRequest())->isValid( $this->request )) {
//                if ((new SezeniTrva())->isValid($this->sessionHandler)) {
//                    // --- podruhe pousti skript  GET inicializacni, sezeni trva  (podle sessTrva)                 
//                    $response = $chybovyControler()->chyba( 'U0a - podruhe volany inicializacni GET na zacaty a neukonceny/ukonceny test. '
//                                                            . '(Je to GETinic, sezeni trva .)  '  );                                          
//                }else {//*zacatek vseho* ----  GET inicializacni,sezeni netrva (podle sessTrva) 
//                    ##################################################
//                    $response = $testerControler()->spustTest(  ); 
//                    ##################################################
//                    $this->sessionHandler->setNejakyTestTrva();    // **#**  N A S T A V I  v session  sessTrva     
//                }            
//            }else {  //get, neni inicializacni                                                  
//                if ( (new QuickformGetRequest())->isValid($this->request)) { //get, neni inicializacni, a je q
//                    if ((new SezeniTrva())->isValid($this->sessionHandler)) { //get, neni inicializacni, a je q, trva 
//                        ################################################## bezna sztanka
//                        $response = $testerControler()->zobrazOtazku(  );                                                                          
//                        ##################################################
//                    }else {   //get, neni inicializacni, a je q, netrva 
//                        $response = $chybovyControler()->chyba( 'U1 -  chyba - Test jiz skoncil zavrenim okna prohlizece.'  );                           
//                    }                    
//                }else { // 'cizi' GET, get, neni inicializacni, a neni q, ale muze to byt ten z presmerovani na dekovaci stranku (tam neni q )
//                    if ((new SezeniTrva())->isValid( $this->sessionHandler ) ) {   //sezeni trva 
//                       
//                        if (  (new DikGetRequest)->isValid( $this->request) ) { //dekovaci stranka
//                            ##################################################
//                            $response = $testerControler()->zobrazVysledky(  );
//                            ##################################################
//                        }else {                            
//                            $response = $chybovyControler()->chyba( 'U3 - nekorektni, necekany (cizi) get. '
//                                        . '(Je to GET, sezeni trva , neni q,  neni to dekovaci)'  );
//                        }
//                    }else {
//                        $response = $chybovyControler()->chyba( 'U4 - nekorektni, necekany (cizi) get. '
//                                        . '(Je to GET, sezeni netrva , neni q,  a neni to ani dekovaci)'  );
//                    }
//                }
//                
//            }
//        }
//        //******************* POST**********************************************
//        elseif ( (new RequestStatus())->isPost($this->request)) {
//            if ((new QuickformSubmitRequest())->isValid($this->request)) {
//               if ((new SezeniTrva())->isValid($this->sessionHandler)) {
//                   // regulerni quickform,  eventuelne se ulozi anebo taky ne, ! podle tabbedIsValid !                                 
//                        ##################################################
//                        $response = $testerControler()->ulozVysledky(  );  
//                        ##################################################                  
//               }else {  // po zavrene session uz nic                  
//                   $response = $chybovyControler()->chyba( 'U5 - nelze pokračovat v testu - test byl již ukončen. je q '
//                                                           . 'Test je ukončen vyplněním celého testu nebo zavřením panelu prohlížeče.');
//               }
//            } elseif ((new QuickformNavigationRequest())->isValid($this->request)) {  //qf submit
//                ##################################################
//                $response = $testerControler()->zobrazOtazku();
//                ##################################################
//            } else {
//                    throw new \LogicException('ER1 Přišel neznámý POST request.');
//            }
//            
//        //********************
//        } else {
//                throw new \LogicException('ER2 To sem blázen ini get, ani post ');
//        }        
//        
//        return  $response  ;
//    }//route
//    
//}    



//  /**
//     * 
//     * @return Pes\Http\Response;
//     * @throws \LogicException
//     */
//    public function route() {
//        // $testerControler = new Tester($this->request, $this->spustenyTestAggregateRepoFactory, $this->odpovedAggregateRepoFactory );//$response stale tentyz
//        $testerControler = function() {
//            return new Tester($this->request, $this->spustenyTestAggregateRepoFactory,  $this->odpovedAggregateRepoFactory);//$response stale tentyz
//        };
//        $chybovyControler = function() { return new Chyber(); };
//        //---------------------------------------------------------------------------------------------------------------        
////#################        
////         /*****/  if ( (new ZobrazNeeditTestRequest())->isValid( $this->request )) { 
////                    $response = $testerControler()->zacniUkazovatTest();
////                  }
////         
////#################         
//        
//        //***************************** GET **************************************
//        if ((new RequestStatus())->isGet($this->request)) {
//             if ( (new InicializacniRequest())->isValid( $this->request )) {
//                 if ((new SezeniTrva())->isValid($this->sessionHandler)) {
//                     // --- podruhe pousti skript  GET inicializacni, sezeni trva  (podle sessTrva)
//                     //if  test ukoncen -----  jen cist 
//                     if  (( new TestUkoncen())->isValid($this->sessionHandler) ) {
////                           $response = $testerControler($this->request, $this->spustenyTestAggregateRepoFactory,
////                                                     $this->odpovedAggregateRepoFactory )->spustTest( \TRUE ); 
//                             //neumoznujeme
//                            $response = $chybovyControler()->chyba( 'U0a - podruhe volany inicializacni GET na zacaty a ukonceny test. '
//                                            . '(Je to GETinic, sezeni trva (v session sessTrva), neni q .)  '  );    
//                     }else //test neukoncen ---- (hlasit?)/ nedelat nic
//                          /**/  // $response = $chybovyControler()->chyba( 'U0 - podruhe volany inicializacni GET na zacaty a neukonceny test. '
//                                //            . '(Je to GETinic, sezeni trva (v session sessTrva), neni q .)  '  ); 
//                            $response = $testerControler()->prejdiNaPrvniOtazku( );   //editovatelnou                   
//                 }else {
//                    if ( (new QuickformGetRequest())->isValid($this->request)) {
//                        //nesmysl --spatne - GET inicializacni,sezeni netrva  a zaroven q
//                        $response = $chybovyControler()->chyba( 'U1 - nekorektni GET. Test ještě nebyl spuštěn a je q. '
//                                            . '(Je to GETinici, sezeni netrva (neni session sessTrva), je q - asi nenastava.)'  );                    
//                    }else {
//                        //*zacatek vseho* ----  GET inicializacni,sezeni netrva (podle persisted), neni to q                               
//                        $response = $testerControler()->spustTest(  );  //editovatelny
//                    }
//                 }
//
//             }else {  //get, neni inicializacni
//                                 
//                 
//                if ( (new QuickformGetRequest())->isValid($this->request)) { //get, neni inicializacni, a je q
//                    if ((new SezeniTrva())->isValid($this->sessionHandler)) { //get, neni inicializacni, a je q, trva
//                            // v seesion testUkoncen true ------ ukazat jen na cteni  
//                            
//                        
//                        if  (( new TestUkoncen())->isValid($this->sessionHandler) ) {   
//                                //$response = $chybovyControler()->chyba( 'U2a - nekorektni. Test ukončen.'
//                        /**/    //              . '(Je to GET, sezeni trva (session sessTrva), je q -, !ale test je ukoncen!)  '  );
//                                // zobrazeni ale zmrzle
//  /****************/            $response = $testerControler()->zobrazNeeditovatelnouOtazku(  ); 
//                           
//                            }else {  // v seesion testUkoncen neukoncen ---- *bezna stranka testu*                                                                       
//                                
//                                $response = $testerControler()->zobrazOtazku(  ); //editovatelnou
//                            }                                                      
//                    }else {
//                         // sezeni netrva a test ukoncen|neukoncen true a prislo q----------spatne -                                     
//                         $response = $chybovyControler()->chyba( 'U2 - nekorektni. Test ukončen uzavřením session.'
//                                            . '(Je to GET, sezeni netrva (neni session sessTrva), je q - to asi nenastava.)  '  );
//            
//                    }
//                }else { // 'cizi' GET ale muze to byt ten z presmerovani
//                    //sezeni trva a v seesion testUkoncen  ----  ukazat jen na cteni
//                    if ((new SezeniTrva())->isValid( $this->sessionHandler ) and 
//                       ( new TestUkoncen())->isValid($this->sessionHandler) ) {                        
//                       
//                        if (  (new DikGetRequest)->isValid( $this->request) ) {
//                            $response = $testerControler()->zobrazVysledky(  ); 
//                        }else {
//                            //sezeni trva a v session testUkoncen je neukoncen   ---- spatne
//                            $response = $chybovyControler()->chyba( 'U3 - nekorektni, necekany (cizi) get. '
//                                            . '(Je to GET, sezeni trva (je session sessTrva), neni q, test neukoncen, neni to dekovaci)'  );
//                        }
//                    }else {                        
//                        //sezeni netrva - spatne
//                        $response = $chybovyControler()->chyba( 'U4 - cizi GET.  '
//                                                  . '(Je to GET, sezeni netrva (neni session sessTrva), neni q. )'  );
//
//                    }
//                    
//                }
//            }
//        }
//        //******************* POST**********************************************
//        elseif ((new RequestStatus())->isPost($this->request)) {
//            if ((new QuickformSubmitRequest())->isValid($this->request)) {
//               if ((new SezeniTrva())->isValid($this->sessionHandler)) {
//                   // regulerni quickform,  eventuelne se ulozi anebo taky ne, ! podle  tabbedisValid !
//
//                    //******************
//                    if ( !( new TestUkoncen())->isValid($this->sessionHandler) ) { 
//                        $response = $testerControler()->ulozVysledky(  );  
//                    }else {
//                        $response = $chybovyControler()->chyba( 'U6 - zpracovavam post. Test byl již ukončen. je q '
//                                         . 'Test je ukončen vyplněním celého testu nebo zavřením panelu prohlížeče.'); 
//                         
//                    }   
//               }else {
//                   // po zavrene session uz nic
//                   $response = $chybovyControler()->chyba( 'U5 - nelze pokračovat v testu - test byl již ukončen. je q '
//                                                           . 'Test je ukončen vyplněním celého testu nebo zavřením panelu prohlížeče.');
//               }
//            } elseif ((new QuickformNavigationRequest())->isValid($this->request)) {
//                $response = $testerControler()->zobrazOtazku();
//            } else {
//                    throw new \LogicException('ER1 Přišel neznámý POST request.');
//            }
//
//        //********************
//        } else {
//                throw new \LogicException('ER2 To sem blázen ini get, ani post ');
//        }
//        
//        
//         return  $response  ;
//    }
     