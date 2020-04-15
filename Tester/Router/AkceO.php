<?php
namespace Tester\Router;

use Pes\Http\RequestInterface;
use Pes\Http\RequestStatus;

use Tester\Model\Handler\SessionInterface;


use Tester\Validator\Request\InicializacniRequest;
use Tester\Validator\Request\QuickformGetRequest;
use Tester\Validator\Request\QuickformSubmitRequest;
use Tester\Validator\Session\SezeniTrva;

use Tester\Controler\Tester ;
use Tester\Controler\Chyber ;

use Tester\Model\Aggregate\Repository\SpustenyTestAggregateRepoFactory;
use Tester\Model\Aggregate\Repository\OdpovedAggregateRepoFactory;
use Tester\Model\Aggregate\Entity\SpustenyTestAggregate;


/**
 * Description of Akce
 *
 * @author vlse2610
 */
class Akce {

    private $request;    
    private $sessionHandler;

    private $spustenyTestAggregateRepoFactory;
    private $odpovedAggregateRepoFactory;


    public function __construct(
            RequestInterface $request, 
            SessionInterface $sessionHandler,
            SpustenyTestAggregateRepoFactory $spustenyTestAggregateRepoFactory,
            OdpovedAggregateRepoFactory  $odpovedAggregateRepoFactory
            ) {
        
        $this->request = $request;
        $this->sessionHandler = $sessionHandler;
        $this->spustenyTestAggregateRepoFactory =  $spustenyTestAggregateRepoFactory;
        $this->odpovedAggregateRepoFactory = $odpovedAggregateRepoFactory;
    }
            
    
    /**
     * 
     * @return  Pes\Http\Response $response
     * @throws \LogicException
     */
    public function route() { 
        // $testerControler = new Tester($this->request, $this->spustenyTestAggregateRepoFactory, $this->odpovedAggregateRepoFactory );//$response stale tentyz
        $testerControler = function($request, $spustenyTestAggregateRepoFactory,  $odpovedAggregateRepoFactory ) {
                 return new Tester($request, $spustenyTestAggregateRepoFactory, $odpovedAggregateRepoFactory );//$response stale tentyz
             };             
        $chybovyControler = function() { return new Chyber(); };
        
        //---------------------------------------------------------------------------------------------------------------
        if ((new RequestStatus())->isGet($this->request)) {
            
            if ( (new InicializacniRequest())->isValid( $this->request )) {
                if ((new SezeniTrva())->isValid($this->sessionHandler)) {  
                    $spustTestAggregRepo = $this->spustenyTestAggregateRepoFactory->create();
                    $spustTestAggregEntity = $spustTestAggregRepo->get();
                    $ukoncen = $spustTestAggregEntity->sessionTestu->testUkoncen;
                                        
//                    if ( $ukoncen ) {
//                        $response = $chybovyControler()->chyba('U2 - test nelze spustit dvakrát. (Opakované spuštění)');                        
//                    }
//                    else {                                            
                        $spustTestAggregRepo = $this->spustenyTestAggregateRepoFactory->create();
                        $spustTestAggregEntity = $spustTestAggregRepo->get();  //vytvori aggregat dle situace s/bez VstupnihoPrikazu
                        $response = $testerControler($this->request, $this->spustenyTestAggregateRepoFactory,
                                                     $this->odpovedAggregateRepoFactory )->getNovyTest( $spustTestAggregEntity );                         
                    //}
                } else {
                    $spustTestAggregRepo = $this->spustenyTestAggregateRepoFactory->create();
                    $spustTestAggregEntity = $spustTestAggregRepo->get();  //vytvori aggregat dle situace s/bez VstupnihoPrikazu( - zde nebyl spusten,tak s)
                                      
                    $response = $testerControler($this->request, $this->spustenyTestAggregateRepoFactory,
                                                 $this->odpovedAggregateRepoFactory )->getNovyTest( $spustTestAggregEntity );                                        
                }
                
            } elseif ((new QuickformGetRequest())->isValid($this->request)) { 
                    if ((new SezeniTrva())->isValid($this->sessionHandler)) {
                        $spustTestAggregRepo = $this->spustenyTestAggregateRepoFactory->create();
                        $spustTestAggregEntity = $spustTestAggregRepo->get();  //vytvori aggregat dle situace s/bez VstupnihoPrikazu( - zde byl spusten,tak bez)

                        $response = $testerControler($this->request, $this->spustenyTestAggregateRepoFactory,
                                                     $this->odpovedAggregateRepoFactory )->getUloha( $spustTestAggregEntity );
                    } else {
                         $response = $chybovyControler()->chyba( 'U3 - nekorektně spuštěný test. (Test ještě nebyl spuštěn. GET, je q)'  );
                    }                                                
                } else {
                    if ((new SezeniTrva())->isValid($this->sessionHandler)) {
                        $response = $chybovyControler()->chyba( 'U4 - nekorektně spuštěný test. (GET, test trva(session). neni q) '  );
                    }
                    else {
                         $response = $chybovyControler()->chyba( 'U5 - nekorektně spuštěný test. (Test ještě nebyl spuštěn. GET, neni q) '  );
                    } 
                }              
            
            } 
            elseif ((new RequestStatus())->isPost($this->request)){
                if ((new QuickformSubmitRequest())->isValid($this->request)) {
                    if ( !(new SezeniTrva())->isValid($this->sessionHandler)) {    
                        $response = $chybovyControler()->chyba( 'U1 - nelze pokračovat v testu - test byl již ukončen. '
                                                             . 'Test je ukončen vyplněním celého testu nebo zavřením panelu prohlížeče.');
                        
                    } else {
                        $spustTestAggregRepo = $this->spustenyTestAggregateRepoFactory->create();
                        $spustTestAggregEntity = $spustTestAggregRepo->get(); 
                        
                        $response = $testerControler($this->request, $this->spustenyTestAggregateRepoFactory, 
                                                     $this->odpovedAggregateRepoFactory )->saveOdpoved( $this->sessionHandler, $spustTestAggregEntity );                        
                                                            //********ulozi** test ukoncen ***********************************************
                                                            //******** nebo zobrazi dalsi otazku
                                                            //
//                        $pom1 = $spustTestAggregEntity->sessionSpustenyTest->testUkoncen;
//                        //if ( $this->sessionHandler->get($this->sessionHandler->getNameUkoncen()) ) {
//                         if (isset( $spustTestAggregEntity->sessionSpustenyTest->testUkoncen ) and ($spustTestAggregEntity->sessionSpustenyTest->testUkoncen === true)  ) {     
//                            $hhaah = $testerControler($this->request, $this->spustenyTestAggregateRepoFactory, 
//                                                     $this->odpovedAggregateRepoFactory )->zobrazVysledky( $this->sessionHandler );  
//
//                            $response->getBody()->write($hhaah ."<br>***** po ze Akce->route->zobrazVysledky() <br><br> "); 
//                        }
                    
//                        $url = "";
//                          header("Location: $url");
//                          exit;  
                    }  
                } else {
                    throw new \LogicException('ER2 Přišel neznámý POST request.');
                }
                
            } else {
                throw new \LogicException('ER1 To sem blázen ini get, ani post ');                 
            } 
        
        
        return  $response  ;
    }    
      
    
}         
        


