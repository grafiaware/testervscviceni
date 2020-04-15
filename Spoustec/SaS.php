<?php
include '../vendor/Pes/Pes/Pes/src/Bootstrap/Bootstrap.php';

use Spoustec\AppContext;

use Spoustec\Validator\ValidatorPozadavekSpusteni;
use Spoustec\Validator\ValidatorTicket;

use Spoustec\Service\CosiFactory;

use Spoustec\Model\PozadavekSpusteni;

use Spoustec\Service\ServiceRequestNaSpusteni;
use Spoustec\Service\ObsluhaSession;

use Spoustec\Model\TicketModel;
use Spoustec\Model\Session\Session;

use Pes\Http\Environment;
use Pes\Http\Request;
use Pes\Router\Router;
use Pes\Cryptor\CryptorReversing;

// Start the session, form-page values will be kept there
//session_start(); SESSION START
$mojeSessionHandler = new Session(); 
$mojeSessionHandler->start();

$environment = new Environment($_SERVER);
$mojeRequest = Request::createFromEnvironment($environment);
$parms =  $mojeRequest->getQueryParams();

ob_start();

$dbh  = AppContext::getDb('spoustec');  // tester_2

$serviceRequestNaSpusteni = new ServiceRequestNaSpusteni ( $mojeRequest ); 
$obsluhaSession = new ObsluhaSession ( $mojeSessionHandler );

$validatorPozadavku = new ValidatorPozadavekSpusteni ( $serviceRequestNaSpusteni );  //presneji validatorZadosti
$jeValidniPozadavek = $validatorPozadavku->isValid(); //uvnitr vyhazuje \UnexpectedValueException( )

$cryptor = new CryptorReversing;
$pozadavekSpusteni =  PozadavekSpusteni::createFromRequest($serviceRequestNaSpusteni, $cryptor);

$ticketModel = new TicketModel ( $dbh  );
$radekTicket = $ticketModel->get( $pozadavekSpusteni->getIdTicket() );  // cte radku z tab. ticket, pozn. zde se zjisti i neex. ticket

$validatorTicket = new ValidatorTicket ( );
$jeValidniTicket = $validatorTicket->isValid( $radekTicket );
//if (!$jeValidniTicket) {   //validator - kontrola na platnost , popr. kolikrat uz byl pouzit, max.pouziti versus pocet uziti
//            //tj i kontrola, "zda neni spusten dvakrat"
//    throw new \UnexpectedValueException( "Ticket není platny." ) ;  //vyhazovat ve validatoru
//}  

//----------------cvicne------
$httpMethod = $mojeRequest->getMethod();
$basePath = $mojeRequest->getUri()->getBasePath();  //není PSR7
$virtualPath = $mojeRequest->getUri()->getPath();  
//-----------------------

$router = new Router();

$cosiFactory = new CosiFactory (  ); 
$cosi = $cosiFactory->create (  $radekTicket ['cosi'] );

$cosi->start( );



 //$idpozadavek  = $tablePozadavek->save($radekTicket['id_ticket'] /*$id_ticket_FK*/); 
//exit;
////-------------------------------------------------------------------------------------------
//// objekt kontrolor=pripoustedlo - obsahuje kód z řádek 38 až 217
//    $pripoustedlo = new Pripoustedlo($mojeSession);
// 
//    $muze = $pripoustedlo->muze($requestMethod, $requestQuickformGet, $oznaceniZadostiOTest_zGetu);
//    
//############ CHYBOVÉ UKONČENÍ ###############################
//// pokud byla chyba, běh skriptu je ukončen
//    if (!$muze) {
//        Tester_Parte::parteAndExit($pripoustedlo->getDieMessages());
//    }    
//
////------------ identifikace  -------   konec   --------------------
//   
////----------------------------------***    
//    ############# ZADÁNÍ TESTU ###################################
//    $mParamTestu = new ParametryTestu($pripoustedlo); // zadani otazek a odpovedi
//    $testZadaniArray = $mParamTestu->getPoleSeZadanim();
//    
//    ############# FORMULÁŘ tabbed #######################################
//    $tabbed = new HTML_QuickForm2_Controller('Tabbed', false);
//
//    foreach ($testZadaniArray as $uloha) {
//        //$navTlac = str_pad(strval($uloha['id']),2,'0', STR_PAD_LEFT );  //string - Na tlačitko vpravo nahore pro pohyb mezi tabulemi
//        $navTlac = substr($uloha['id'], -2);            //string - Na tlačitko vpravo nahore pro pohyb mezi tabulemi
//        $pageAutomat = new Tester_Tabbed_Page_RadioGroupAutomat(new HTML_QuickForm2( $navTlac));
//        $pageAutomat->initialize($uloha);
//        $tabbed->addPage($pageAutomat);
//
//         // -------These actions manage going directly to the pages with the same name
//        $tabbed->addHandler($navTlac, new HTML_QuickForm2_Controller_Action_Direct());
//    }
//
//    // We actually add these handlers here for the sake of example
//    // They can be automatically loaded and added by the controller
//    $tabbed->addHandler('submit', new HTML_QuickForm2_Controller_Action_Submit());
//    $tabbed->addHandler('jump', new HTML_QuickForm2_Controller_Action_Jump());
//
//    // This is the action we should always define ourselves
//    $tabbed->addHandler('process', new Tester_Tabbed_Process());
//    // We redefine 'display' handler to use the proper stylesheets
//    $tabbed->addHandler('display', new Tester_Tabbed_Display());
//
//    $coSloVen = $tabbed->run();    //vraci to, co vraci $tabbed->pages[$page]->handle($action)      process->perform() t/f
//                                   //nebo to, co vraci  Display->renderForm($form)   $htmlFormular     
//    //---------------------------------***
//    
//    $action = $tabbed->getActionName();
//        //echo "tabbed->getActionName<br>"; print_r($action);
//    
//    if ( $action[1] == 'display' or ($action[1] == 'submit' and !$tabbed->isValid()) )  {                   
//        //$mParamTestu = new ParametryTestu($prectena_veta_z_view_kampane_2); //data -- viz vyse
//        $vstupniOtazkaTab = new VstupniOtazkaTab($mParamTestu, $coSloVen ); //controler
//        $otazkaFormHtml = $vstupniOtazkaTab->getVypisHTML();
//        echo   $otazkaFormHtml;                                 
//    }            
//    if ($action[1] == 'submit' and $tabbed->isValid()) {
//        $mOdpovedi = new OdpovediFormulare($pageAutomat);
//        $vysledky  = new Vysledky($mOdpovedi, $mParamTestu);  //controler
//        $vysledkyHtml = $vysledky->getVypisHTML();
//        echo  $vysledkyHtml;        
//    }
//--------------------------------------------------------------------------------------------------------
########## ZISKANI IDENTIFIKACE z GETu  ##############################
//$requestQuickformGet = FALSE;
//$identifikace_parametr_test_zGETu = '';
//$requestMethod = $_SERVER['REQUEST_METHOD'];
//
//if ($requestMethod=='GET') {
//    $get = $_GET;
//    $needle = '_qf';
//    $input = array_keys($get);
//    $ret = array_keys(array_filter($input, function($var) use ($needle){return strpos($var, $needle) !== false;}  ));
//    
//    if (isset($ret) AND count($ret)) {
//        $requestQuickformGet = TRUE;
//    }        
//    //$query_str = parse_url($redirectUrl, PHP_URL_QUERY);  // s touto konstantou vrací jen query
//
//    $identifikace_parametr_test_zGETu = filter_input(INPUT_GET,'test');
//}
##########################################################
       



