<?php
namespace Tester\Controler;

use HTML_QuickForm2_Controller_Page;

use Pes\Http\Response;
use Pes\Http\Response\RedirectResponse;
use Pes\View\View;
use Pes\View\Template\PhpTemplate;
use Pes\Session\SessionStatusHandler;

use Tester\Model\Aggregate\Repository as AggRepo;
use Tester\Model\Aggregate\Entity as AggEntity;

use Tester\Model\Session\Entity as SessEntity;
use Tester\Model\Session\Repository as SessRepo;
use Tester\Model\Db\RowObject as DbEntity;
use Tester\Model\File\Repository as FileRepo;

use Tester_Tabbed_TesterovyController;   

use Tester\Service\SpustTestService;
use Tester\Service\UkazTestService;



class Tester extends ControllerAbstract {

    /**
     * GET Volá se pro "inicilizační request" pro nezapočatý test.
     * Zapíše do repository (Uloží) agregatni strukturu (objekt) SpoustenyTestAggragateEntity.
     * (Tj.: mimo jiné do repository Session testeru ulozi idDbEntityPrubehTestu!)
     * Vrací response s vyrenderovanym formularem ulohy.
     * 
     * route 'novytest/:uidKonfiguraceTestu/:identifikatorTicketu/'  
     * 
     * Pozn.: Nastavuje testUkoncen = false  a  testZahajen=true  v agregatnim objektu SpoustenyTestAggragateEntity,
     * zapíše identifikátor spuštěného testu do session. (Tj.: do repository Session testeru ulozi idDbEntityPrubehTestu!)
     *
     * @return Pes\Http\Response response
     */
    public function getNovyTest( $uidKonfiguraceTestu, $identifikatorTicketu ){                 
        /* @var $spustTestService SpustTestService */
        $spustTestService =  $this->container->get(SpustTestService::class); 
        if ( $spustTestService->lzeSpustitTest( $uidKonfiguraceTestu, $identifikatorTicketu ) ) {
       
            // v session mohou byt stara data,(napr. z minuleho testu jineho) ale ty nechci, protoze vytvarim NOVY spousteny test
            /* @var $sessionTabbeduRepo SessRepo\SessionTabbedu */ 
            $sessionTabbeduRepo = $this->container->get( SessRepo\SessionTabbedu::class );
            $sessionTabbeduE = $sessionTabbeduRepo->get( );
            if ( $sessionTabbeduE ) {
                $sessionTabbeduRepo->remove($sessionTabbeduE);                    
            }
            /* @var $sessionTestuRepo SessRepo\SessionTestu */ 
            $sessionTestuRepo = $this->container->get( SessRepo\SessionTestu::class );                
            $sessionTestuE = $sessionTestuRepo->get();
            if ( $sessionTestuE ) { 
                $sessionTestuRepo->remove($sessionTestuE);                     
            }     
            
            //--------- ctene zadani = 'stare', tj. informace z repozitory,  dle $uidKonfiguraceTestu ( z routy )
            /* @var $zadaniTestuAggregateRepository AggRepo\ZadaniTestuAggregateRepository */
            $zadaniTestuAggregateRepository = $this->container->get( AggRepo\ZadaniTestuAggregateRepository::class ) ; 
            /* @var $zadaniTestuAggregateEntity \AggEntity\ZadaniTestuAggregate */
            $zadaniTestuAggregateEntity = $zadaniTestuAggregateRepository->getPodleUidKonfigurace( $uidKonfiguraceTestu ) ;  // z routy 
            
            //---------- nove prubeh (casti) objekty -------------------------
            //neberu z repository, tvorim novy
            $getTestAggregateEntity = new AggEntity\GetTestAggregate( ) ;    // nove , nutno naplnit      
            $getTestAggregateEntity->prubehTestu->uidKonfiguraceTestuFk = $uidKonfiguraceTestu; // to uz vim, nezavisi na ukladani do db
            $getTestAggregateEntity->prubehTestu->poleNavic             = "Něco do pole navic2.";            
            $getTestAggregateEntity->prubehTestu->casSpusteni           = new \DateTime();    
            
            $getTestAggregateEntity->ticketPouzity->identifikatorTicketu = $identifikatorTicketu;   
                                    
            $getTestAggregateEntity->sessionTestu->testUkoncen = \FALSE;          // ***  NASTAVUJE *** pro "novy" prubeh
            $getTestAggregateEntity->sessionTestu->testZahajen = \TRUE;           // ***  NASTAVUJE *** pro "novy" prubeh
            
            $getTestAggregateEntity->zadaniTestuAggregate = $zadaniTestuAggregateEntity;
            //------------------------------------------------------------------
                   
            //----- !!! AGGREGAT ULOZIT  !!! ------            
            /* @var   $getTestAggregateRepository  AggRepo\GetTestAggregateRepository */
            $getTestAggregateRepository = $this->container->get( AggRepo\GetTestAggregateRepository::class ) ;
            $getTestAggregateRepository->add( $getTestAggregateEntity );     // !!!  ULOZIT    !!!
            //Důležitá poznámka: v add zde vznika idDbEntityPrubehTestu a ulozi se do repository Session testu
            //-------------------------------------------------------------------------------------------------------------------
            
            //-------- vytvorit tabbed controler a vratit response, s pozadavkem o zobrazeni ulohy testu (prvni neodpovezenou)     
            /* @var $tabbed Tester_Tabbed_TesterovyController */   
            $tabbed = $this->container->get(Tester_Tabbed_TesterovyController::class );                                       
            $tabbed->setRunParams( /* $pageId*/ NULL , 'display' );
            $html = $tabbed->run();   // html kod stranky k zobrazeni                                
                    if (!$html) {
                            throw new \UnexpectedValueException('Zapomenutý čert !! v Tester->getNovyTest tabbed-run  vratil NULL / false...' );
                    }       
                    
            //----------------- naplneni dat pro template ----                                                   
            /* @var $textyTesteruRepo FileRepo\TextyTesteru */
            $textyTesteruRepo  = $this->container->get( FileRepo\TextyTesteru::class );
            $textyTesteruArr = $textyTesteruRepo->get( "Texty_Testeru" /*nazev sady*/ );             

            $poleProTemplate = [
                'basePth'    => $this->container->get('basePath'),
                'nazevTestu' => $getTestAggregateEntity->zadaniTestuAggregate->konfiguraceTestu->nazevTestu,
                'casSpusteni'   => $getTestAggregateEntity->prubehTestu->casSpusteni->format('Y-m-d H:i:s'), //datetime
                'idPrubehTestu' => $getTestAggregateEntity->prubehTestu->idPrubehTestu,
                'vstupHtmlForm' => $html,      
                'textyTesteruArr' => $textyTesteruArr,
            ];            
            $template = new PhpTemplate('templates/templateVstupniFormular.php');  //vytvori objekt Template a nastavi mu jmenosouboru s templatou     
            $ulohaFormHtmlView = new View();
            $ulohaFormHtmlView->setTemplate($template)->setData($poleProTemplate);
            // pak pouzijeme v nem nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi - napr.echem                      
            
            $output =  $ulohaFormHtmlView->render();
            $response = new Response( 200 );
            $response->getBody()->write($output);
            return $response;                
            
        } else {
                //nelze spustit
                return new Response( 204 );
        }
    }
//        //Informational 1xx
//        100 => 'Continue',        101 => 'Switching Protocols',        102 => 'Processing',
//        //Successful 2xx
//        200 => 'OK',        201 => 'Created',        202 => 'Accepted',        203 => 'Non-Authoritative Information',
//        204 => 'No Content',        205 => 'Reset Content',        206 => 'Partial Content',        207 => 'Multi-Status',
//        208 => 'Already Reported',        226 => 'IM Used',

    
    

    
    
    
    /**     
     * GET Volá se pro "inicilizační request" pro již započatý test.     
     * Zapisuje jen do SessionTestu.
     * Tato metoda MUSÍ ZAPSAT do SESSION identifikator testu (vyhledaného podle idPrubehTestu)    
     * Vrací response s vyrenderovanym formularem ulohy.
     * 
     * route 'test/:idPrubehTestu/:identifikatorTicketu/'
     * Pozn.:Nastavuje testUkoncen = true  a testZahajen= false  v agregatnim objektu SessionTestu.
     * 
     * @return Pes\Http\Response response
     */
    public function getTest( $idPrubehTestu, $identifikatorTicketuZobrazeni ){             
        /* @var $ukazTestService UkazTestService */
        $ukazTestService =  $this->container->get( UkazTestService::class); 
        if ( $ukazTestService->lzeUkazatTest ( $idPrubehTestu , $identifikatorTicketuZobrazeni  ) ) {  
            //---  ukazovat lze test, jen kdyz uz mame odpovedi = musi ex. záznam v tabulce odpoved a je v něm uložené sessionTabbedu          

            //--------- = ctene prubeh = stare dle $idPrubehTestu ( z routy )
            /* @var $getTestAggregateRepo AggRepo\GetTestAggregateRepository */ 
            $getTestAggregateRepo = $this->container->get(AggRepo\GetTestAggregateRepository::class );
            //$this->container->get( AggRepo\ZadaniTestuAggregateRepository::class )
            $getTestAggregateEntity = $getTestAggregateRepo->get( $idPrubehTestu ) ;
            //pozn. $spoustenyTestAggregateEntity->prubehTestu->identifikatorKonfiguraceTestuFk
            //pozn. $spoustenyTestAggregateEntity->sessionTestu   --- zde  nenaplnen - je to totiz prvni runda    
            //pozn. $spoustenyTestAggregateEntity->ticketPouzity --- zde je ticket, kterym byl test spousten

            
            //-----------   ctene odpoved  = stare
            /* @var $odpovedAggRepo  AggRepo\OdpovedAggregateRepository  */
            $odpovedAggRepo = $this->container->get( AggRepo\OdpovedAggregateRepository::class);        
            /*@var  $odpovedAggE AggEntity\OdpovedAggregate */
            $odpovedAggE = $odpovedAggRepo->getByPrubehTestuId(  $idPrubehTestu  ) ;          
            // odpovedi jsou "zakompilovane" v sessionTabbedu ulozenem v odpovedi
            //---------------------------------------------------------------------------

            // tady  vytvorit new **session testu**
            // napred smazu ten, co eventuelne existuje  a  !!!!! DYCKY   vytvorim novy            
            /* @var $sessionTestuRepo  SessRepo\SessionTestu  */
            /* @var $sessionTestuE  SessEntity\SessionTestu */           
            $sessionTestuRepo = $this->container->get( SessRepo\SessionTestu::class );                
            $sessionTestuE = $sessionTestuRepo->get();
            if ( $sessionTestuE ) { 
                    $sessionTestuRepo->remove($sessionTestuE);   
            }                
            $sessionTestuE = new SessEntity\SessionTestu() ;
            $sessionTestuE->idDbEntityPrubehTestu = $getTestAggregateEntity->prubehTestu->idPrubehTestu;
            $sessionTestuE->testUkoncen = \TRUE;           // ***  NASTAVUJE *** pro "novy" prubeh
            $sessionTestuE->testZahajen = \FALSE;          // ***  NASTAVUJE *** pro "novy" prubeh      
            $sessionTestuRepo->add( $sessionTestuE );
            
            // ted tady je v SESSION idDbEntityPrubehTestu vzdy
            
            //  v prectenem z repository $odpovedAggE->odpoved je ulozena **sessionTabbedu**. SessionTabbedu zapisu do repository session.
            // tj. smazu tu 'minulou' session tabbedu a zapisu tu z trvaleho uloziste = z tabulky odpoved
            if ( $odpovedAggE->odpoved->sessionTabbedu ) {
                /*  @var  $sessionTabbeduE SessEntity\SessionTabbedu */ 
                //$sessionTabbedu = new SessEntity\SessionTabbedu() ;
                $sessionTabbeduE = $odpovedAggE->odpoved->sessionTabbedu ;                
                /* @var    $sessionTabbeduRepo   SessRepo\SessionTabbedu */ 
                $sessionTabbeduRepo = $this->container->get( SessRepo\SessionTabbedu::class );
                $sessionTabbeduEntZeSession = $sessionTabbeduRepo->get();
                if ( $sessionTabbeduEntZeSession ) {
                        $sessionTabbeduRepo->remove( $sessionTabbeduEntZeSession ); }                
                $sessionTabbeduRepo->add( $sessionTabbeduE );
            }
            //---------------------------                        
                                      
            /* @var $tabbed Tester_Tabbed_TesterovyController */                                                                         
            $tabbed = $this->container->get( \Tester_Tabbed_TesterovyController::class );                                       
            $tabbed->setRunParams( /* $pageId*/ NULL , 'display' );
            $html = $tabbed->run();   // html kod stranky k zobrazeni                                                            
                    if (!$html) {
                            throw new \UnexpectedValueException('Zapomenutý čert !! v Tester->getTest tabbed-run  vratil NULL / false...' );
                    }                                       
                    
            //----------------- naplneni dat pro template ----  
            //$idPrubehTestu.... neni ze session, ale z routy
            //$getTestAggregateEntityPoulozeniSession = $getTestAggregateRepo->get( $idPrubehTestu ) ; //pozn.: mohla byt zmena
            /* @var $getTestAggregateEntityPoulozeniSession GetTestAggregate */
            $getTestAggregateEntityPoulozeniSession = $this->container->get(AggEntity\GetTestAggregate::class );
            
            /* @var  $textyTesteruRepo FileRepo\TextyTesteru */
            $textyTesteruRepo  = $this->container->get( FileRepo\TextyTesteru::class );
            $textyTesteruArr = $textyTesteruRepo->get( "Texty_Testeru" /*nazev sady*/ );            
            
            $poleProTemplate = [
                'basePth'  =>  $this->container->get('basePath'),
                'nazevTestu'  => $getTestAggregateEntityPoulozeniSession->zadaniTestuAggregate->konfiguraceTestu->nazevTestu,                      
                'casSpusteni'  => $getTestAggregateEntityPoulozeniSession->prubehTestu->casSpusteni->format('Y-m-d H:i:s'), //datetime
                'idPrubehTestu'  => $getTestAggregateEntityPoulozeniSession->prubehTestu->idPrubehTestu,
                'odpovedInserted'   => ( ( $odpovedAggE->odpoved ) ? $odpovedAggE->odpoved->inserted : ''), //timestamp
                'vstupHtmlForm'  => $html,
                'textyTesteruArr'  =>  $textyTesteruArr,
            ];    
                               
            //-----------------------------
            $template = new PhpTemplate('templates/templateVstupniFormularFreeze.php');  //vytvori objekt Template a nastavi mu jmeno souboru templaty
            $ulohaFormHtmlView = new View();
            $ulohaFormHtmlView->setTemplate($template)->setData($poleProTemplate);
            // pak pouzijeme v nem nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi - napr.echem                      
                       
            $output =  $ulohaFormHtmlView->render();
            $response = new Response( 200 );
            $response->getBody()->write($output);
            return $response;                                                        

        } else {
            //nelze ukazat
            return new Response( 204 );
        }

    }
    
    
    
    
     /**
     * Volá se z Akce->route. Pro zavolani v jiz spustene session.
      * 
     * Vrací response s vyrenderovanym formularem ulohy.
     * route  GET 'uloha/:idUloha/'
     * 
     * @return Pes\Http\Response;
     */
    public function getUloha( $idUloha) {    
        /* @var $sessionHandler SessionStatusHandler */
        $sessionHandler = $this->container->get(SessionStatusHandler::class);
        $html = $sessionHandler->get($this->container->get('invalidHtmlForm'));
        if ($html) {
             $sessionHandler->delete($this->container->get('invalidHtmlForm'));
        }
        
        /* potrebuji i odpovedi */
        /* @var $postTestAggregateEntityPodleZSession AggEntity\PostTestAggregate */
        $postTestAggregateEntityPodleZSession = $this->container->get( AggEntity\PostTestAggregate::class );         

        //--------------- html mam  s cervenym rameckem ze session, 
        //--------------- nebo nemam a musim si  udelat zde z pozadovane ulohy
        if (!$html) {     
            /* @var $tabbed Tester_Tabbed_TesterovyController */                                                                         
            $tabbed = $this->container->get( \Tester_Tabbed_TesterovyController::class );                                       
            $tabbed->setRunParams( /* $pageId*/ $idUloha , 'display' );
            $html = $tabbed->run();   // html kod stranky k zobrazeni                                                  
        }        
        
        //----------------- naplneni dat pro template ----  
        /* @var  $textyTesteruRepo FileRepo\TextyTesteru */
        $textyTesteruRepo  = $this->container->get( FileRepo\TextyTesteru::class );
        $textyTesteruArr = $textyTesteruRepo->get( "Texty_Testeru" /*nazev sady*/ );            
        $poleProTemplate = [
                'basePth'    =>  $this->container->get('basePath'),
                'nazevTestu' => $postTestAggregateEntityPodleZSession->zadaniTestuAggregate->konfiguraceTestu->nazevTestu,                
                'casSpusteni' => $postTestAggregateEntityPodleZSession->prubehTestu->casSpusteni->format('Y-m-d H:i:s'), //datetime
                'idPrubehTestu' => $postTestAggregateEntityPodleZSession->prubehTestu->idPrubehTestu,       
                'odpovedInserted' => ( ( $postTestAggregateEntityPodleZSession->odpovedAggregate ) ? $postTestAggregateEntityPodleZSession->odpovedAggregate->odpoved->inserted : ''), //timestamp
                'vstupHtmlForm' => $html,
                'textyTesteruArr' =>  $textyTesteruArr,
        ];  
        
        //----- rozhodnuti o zmrzlosti = editovatelnosti -----
        if ($postTestAggregateEntityPodleZSession->sessionTestu->testUkoncen)  {
            $template = new PhpTemplate('templates/templateVstupniFormularFreeze.php'); } //vytvori objekt Template a nastavi mu jmeno souboru templaty
        else {
            $template = new PhpTemplate('templates/templateVstupniFormular.php');         //vytvori objekt Template a nastavi mu jmeno souboru templaty
        }

        
        $ulohaFormHtmlView = new View();
        $ulohaFormHtmlView->setTemplate($template)->setData($poleProTemplate);
        // pak pouzijeme v nem nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi(- napr.echem)                                                                  
        $output =  $ulohaFormHtmlView->render();
        $response = new Response( 200 );
        $response->getBody()->write($output);
        return $response;
    }
    
    

    
      

    /**
     * Volá se pro "děkovací request"  z Akce->route.
     * route   GET 'dekujeme/'
     * @return Response
     */
    public function getDekujeme(  ) {           
        $sessionTestuRepository =  $this->container->get(SessRepo\SessionTestu::class );
        /* @var   $sessionTestuEntity   SessEntity\SessionTestu  */
        $sessionTestuEntity = $sessionTestuRepository->get(); 
        
        /* @var $getTestAggregateRepo AggRepo\GetTestAggregateRepository */
        $getTestAggregateRepo = $this->container->get( AggRepo\GetTestAggregateRepository::class );    
        /* @var   $spoustenyTestEntity  AggEntity\SpoustenyTestAggregate  */        
        $getTestAggregateEntityPodleSession = $getTestAggregateRepo->get( $sessionTestuEntity->idDbEntityPrubehTestu );
                             /*getPodleIdPrubehuTestu( $sessionTestuEntity->idDbEntityPrubehTestu ) ;      */

//        //--------- = ctene zadani  = stare dle identifikatorKonfiguraceTestuFk
//        /* @var $zadaniTestuAggregateRepository AggRepo\ZadaniTestuAggregateRepository */
//        $zadaniTestuAggregateRepository = $this->container->get( AggRepo\ZadaniTestuAggregateRepository::class ) ; 
//        /* @var $zadaniTestuAggregateEntity  \AggEntity\ZadaniTestuAggregate */
//        $zadaniTestuAggregateEntity = $zadaniTestuAggregateRepository->getPodleUidKonfigurace( $getTestAggregateEntityPodleSession->prubehTestu->uidKonfiguraceTestuFk );                                         
        
                   
        //------------------------------------------
        reset( $getTestAggregateEntityPodleSession->zadaniTestuAggregate->ulohy );        
        $template = new PhpTemplate('templates/templateDekujeme.php');   //vytvori objekt Template a nastavi mu jmenosouboru s templatou       
        $poleProTemplate  = [
            'basePth' => $this->container->get('basePath'),          
            'prvniKlic' => key( $getTestAggregateEntityPodleSession->zadaniTestuAggregate->ulohy ) ];
        
        $view = new View();      //vytvori objekt View - pouzije v sobe nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak uzije na zobrazeni ( napr.echem )                                       
        $view->setTemplate($template)->setData( $poleProTemplate );        
        $output =  $view->render();
        
        $response = new Response( 200 );
        $response->getBody()->write($output);
        return $response;             
        
    }

    
    
    
 
    /**
     * POST 'prechod/:idUloha/:idCilovaUloha/'
     */
    public function prejdiNaUlohu(  $idCilovaUloha) {      
        $url = $this->container->get('basePath') . "uloha/" .  $idCilovaUloha . "/";                
        $response = RedirectResponse::withRedirect(new Response(), $url);        
        return $response;          
    }  



     /**
     * Volá se pro  POST.  Po každém submit z formulare.
     * ( puvodne v datech je  'tabbedi' proměnná _qf_XX_submit, kde XX je index stránky )
     * Dříve se presměrovával v run()(tj. prešel v run na Tester_Tabbed_Handler_Submit na příslušnou akci handleru). 
     * 
     * Jsou-li vsechny ulohy odpovezeny - uloží všechny odpovědi  všech úloh  do jednoho řádku tabulky odpoved a jednotlive odpovedi do tabulky odpoved na otazku,
     * nastavi v session, ze test je ukoncen.
     * Neni treba zjistovat sessionTestu->testUkoncen.Protoze pri ukoncenem testu sem vubec nedojdu, protoze neni aktivni (ani zobrazene) tlacitko submititko pokracuj,
     * kterym se sem dostavam.                   
     *  
     * route    POST 'odpoved/:idUloha/'
     * @return RedirectResponse   se presmerovaval v run()(tj. prešel v run na Tester_Tabbed_Handler_Submit na příslušnou akci handleru)
     */
    public function saveOdpoved( $idUloha ) {                       
        /* @var $tabbed Tester_Tabbed_TesterovyController */   
        $tabbed = $this->container->get(Tester_Tabbed_TesterovyController::class );                                       
        // nepotrebuji  zobrazovat  // $tabbed->setRunParams(  NULL , 'display' ); // $html = $tabbed->run(); // html kod stranky k zobrazeni                                                                                     
        
        // nasleduje nahrada za Tester_Tabbed_Handler_Submit->perform        
        /* @var $pageController HTML_QuickForm2_Controller_Page */
        $pageController = $tabbed->dejPageControler($idUloha) ; //ziskam page controller
        $validStranka =  $pageController->storeValues();  // zjistim, stranka validni y/n  
        
        // - celý test je OK , ze session repository tabbedu vyzvednu 'odpovedi' a  budu ukladat
        if ($tabbed->isValid()) {      
            
      
            
            
            $url = $this->container->get('basePath') . "dekujeme/" ;             
            $vsechnyOdpovedi = $tabbed->getValue(); 
            // $pageController->handle('process');  // volal se zde Handler\Process Tester_Tabbed_Handler_Process (metoda perform),  Process je objekt typu .HTML_QuickForm2_Controller_Action                                                                                                         
           
  /* */          /* @var $odpovedAggRepo AggRepo\OdpovedAggregateRepository */
  /* */          $odpovedAggRepo = $this->container->get( AggRepo\OdpovedAggregateRepository::class);  
            
            /* @var $repoSessionTestu SessRepo\SessionTestu  */     
            $repoSessionTestu = $this->container->get(  SessRepo\SessionTestu::class ) ;
            $sessionTestuEntity = $repoSessionTestu->get();  
            $idPrubehTestu =  $sessionTestuEntity->idDbEntityPrubehTestu;
                      
            $odpovediNaOtazkuColl = array();            
            foreach ($vsechnyOdpovedi as $key=>$value) {   //v key jsou identifikatory
                $odpovedNaOtazku = new DbEntity\RowObjectOdpovedNaOtazku();  
                $odpovedNaOtazku->identifikatorOdpovedi = $key ;
                $odpovedNaOtazku->hodnota = $value ;
                $odpovedNaOtazku->idPrubehTestuFk = $idPrubehTestu;       
                $odpovediNaOtazkuColl[] = $odpovedNaOtazku;
            }                                  
            $odpovedE =  new DbEntity\RowObjectOdpoved();           
            $odpovedE->idPrubehTestuFk = $idPrubehTestu;
            /* @var $repoSessionTabbedu SessRepo\SessionTabbedu */ 
            $repoSessionTabbedu = $this->container->get( SessRepo\SessionTabbedu::class ) ;
            $sessionTabbeduE = $repoSessionTabbedu->get();            
            $odpovedE->sessionTabbedu = $sessionTabbeduE;        
            //--------------------------------------------------
            $novaOdpovedAggregateE = new AggEntity\OdpovedAggregate();                                   
            //$novaOdpovedAggregateE->sessionTestu =  $sessionTestuEntity; 
            $novaOdpovedAggregateE->odpoved = $odpovedE;
            $novaOdpovedAggregateE->odpovediNaOtazky = $odpovediNaOtazkuColl;
                      
    /* */        // $novaOdpovedAggregateE->sessionTestu->testUkoncen = true;   //   U K O N C E N I nastavit
    /* */  //      $odpovedAggRepo->add( $novaOdpovedAggregateE );             //   U K L A D A M 
            //   U K L A D A M    odpoved, odpoved(i) na otazku, session  
            
             
/*  ??????????????
 V teto runde nepotrebuji zadani ani prubeh testu
 Ma  byt jiny agregat 'PostTestOdpovedni' bez zadani a prubehu
 a v nem pri add zapisovat odpoved, ale ne zadani a prubeh ____???????????
 */            
            
/* @var $postTestAggregateEntityPodleZSession AggEntity\PostTestAggregate */
$postTestAggregateEntityPodleZSession = $this->container->get( AggEntity\PostTestAggregate::class );   
$postTestAggregateEntityPodleZSession->odpovedAggregate = $novaOdpovedAggregateE;     
$postTestAggregateEntityPodleZSession->sessionTestu->testUkoncen =  true; 


/* @var $postTestAggregateRepository AggRepo\PostTestAggregateRepository */
$postTestAggregateRepository = $this->container->get( AggRepo\PostTestAggregateRepository::class ); 
$postTestAggregateRepository->add($postTestAggregateEntityPodleZSession);       //   U K L A D A M 

            
            
            
            
            
        }
        
        else {      // zobrazit dalsi v poradi ktera je invalid -  zobrazi v dalsi runde
            if ($validStranka) {     //  - Current page is valid,  display jinou
                // Some other page is invalid, redirect to it  //ex. nejaka neodpozedena uloha
                $InvalidPage = $tabbed->getFirstInvalidPage();   //$idUlohaDalsi = $tabbed->getFirstInvalidPage()->handle('jump');                 
                $arUloha = str_getcsv($InvalidPage->getButtonName('display'), '_');                     
                $idUlohaDalsi = $arUloha[2] ; 
                $url = $this->container->get('basePath') . "uloha/$idUlohaDalsi/"; 
              
            } else {   //  - currentni otazka(uloha) nema splnena pravidla (napr. u povinne odp. neni odpovezeno), zobrazi v dalsi runde tuto s cervenym rameckem                                                 
                /* @var $sessionStatusHandler SessionStatusHandler */
                $sessionStatusHandler = $this->container->get(SessionStatusHandler::class);
                $htmlRed = $sessionStatusHandler->get($this->container->get('invalidHtmlForm'));
                if (! $htmlRed) {
                    $htmlRed = $pageController->handle('display');                  
                    // do session si ulozi vznikle html z handle display, pro zobrazeni v dalsi runde s cervenym rameckem
                    $sessionStatusHandler->set($this->container->get('invalidHtmlForm'), $htmlRed);                     
                }                 
                $url =  $this->container->get('basePath') . "uloha/$idUloha/";    
            }                                   
        }  
        return RedirectResponse::withRedirect( new Response(), $url );    
    }    
    
    
//***********************************************************************************************************************    
//--------- stare --------------------        
//        $tabbed->setRunParams( /* $pageId*/ $idUloha , 'submit');
//        $tabbedReturn = $tabbed->run();
//------- 
  
            
//            //***********************  'vymazat' session data z repository session, pak se nelze vratit zpetitkem po ulozeni odpovedi          
//            /* @var   $sessionTestuRepo    SessionRepo\SessionTestu */              
//            $sessionTestuRepo =  $this->container->get( SessionRepo\SessionTestu::class );
//            $sessionTestuE = $sessionTestuRepo->get();
//            $sessionTestuRepo->remove($sessionTestuE);
//            /* @var   $sessionTabbeduRepo  SessionRepo\SessionTabbedu */
//            $sessionTabbeduRepo = $this->container->get( SessionRepo\SessionTabbedu::class );
//            $sessionTabbeduE = $sessionTabbeduRepo->get();
//            $sessionTabbeduRepo->remove( $sessionTabbeduE );    
    
    
            
//----------------------------------------------------------------------------------------------------------------------------    
    
    
    /**     
     * route 'vysledky/'
     * 
     * @return Response
     */
    public function getVysledky(  ) {
        //jeste z $odpovedAggregatE udelat vypis                
        
//        $vysledkyObj = new Vysledky(   $this->container->get($serviceName)testAggregateRepoFactory,
//                                       $this->odpovedAggregateRepoFactory 
//                                        );
        
//        $otazkaFormHtml = $vysledkyObj->getVypisHTML();

//        $response = new Response( 200 );
//        $response->getBody()->write($otazkaFormHtml);
//        return $response;
        
        $response = new Response( 200 );
        $response->getBody()->write("VYPIS NECEHO CO BYCHOM CHTELI VYPSAT-v getVysledky");
        return $response;
        
    }
 
    /**
     * reurn array
     */
    public function dejSeznamPouzitelnychTestu( ){

         $query = "SELECT id_konfigurace_testu, popis_testu, nazev_testu, nazev_sady, jmeno_souboru
                       FROM   konfigurace_testu
                       LEFT JOIN sada_otazek ON konfigurace_testu.id_sada_otazek_fk = sada_otazek.id_sada_otazek
                       WHERE valid = 1 ";
        $statSelect = $this->dbh->prepare($query);
        $succ = $statSelect->execute();

        $pp = $statSelect->rowCount();
        if (!($pp>1))  {
             throw new \UnexpectedValueException('Nenalezen žádný přístupný test na výběr  v databázi.'. get_class() .  '.'. __CLASS__ ) ;
        }
        else {
            $i=1;
            while ($row = $statSelect->fetch(\PDO::FETCH_ASSOC)) {
                $data[$i] = $row ;
                $i++ ;
            }
        }
        return $data;
    }



}



//        $poleUlohy =  $zadaniTestuAggregateEntity->ulohy; //muj vytvor
//        $a = array_keys( $poleUlohy );
//        $prvniKlic = $a[0];     