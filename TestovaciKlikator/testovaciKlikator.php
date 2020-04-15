<?php
require 'Bootstrap.php';
## konfigurace ##
#######  TYTO TŘI POLOŽKY SE MĚNÍ PŘI ZMĚNĚ TESTOVANÉ ZAKÁZKY ##################
// složka zakázky (testovacího běhu)
$definedTestDir = 'Zakazky/Zkusebni';
## parametry testu k test context objetu ##
$testContextObject = new Zakazky_Zkusebni_TestContext();
## Zde je třeba udrřovat existující id ##### (id vzb_osoba_kampan)
$idTest = '1280';   //id_vzb_osoba_kampan v db svoboda
//$idTest = '1279';   //id_vzb_osoba_kampan v db selnerova
################################################################################


// url serveru
$definedMethod = 'http://';
$definedHost = 'localhost';
// kořenová složka
$definedRootDir = 'Tester';

// jméno volaného skriptu, který musí být uveden u odkazu, ze kterého se test spouští
$queryPrefix = $testContextObject->getAcceptedScriptnamePrefix();
// Koder pro kódování parametru
$parameterCoder = $testContextObject->getRequestParameterKoder();
// Builder úrp setavení query
$queryBuilder = $testContextObject->getQueryBuilder();
// název skriptu, na který bude provedeno přesměrování, pokud kontroly proběhnou v pořádku
$targetScriptName = $testContextObject->getTargetScriptName();

$dbh = TestovaciKlikator_AppContext::getDb();
$messages = array();
######## INFO o konfiguraci klikátoru ####################
if (session_status()==PHP_SESSION_NONE) {
    session_start();
}
$messages[] = 'Spuštěno na adrese '.$definedMethod.$definedHost.$definedRootDir.$definedTestDir;
$messages[] = 'Identifikátor testu v databázi - id_test = '.$idTest;
$messages[] = 'SESSION: '.var_export($_SESSION, TRUE);


######### PROVEDENÍ AKCÍ A GENEROVÁNÍ ZPRÁV ###########
## KONTROLA EXISTENCE ID TESTU ##
$msgs = TestovaciKlikator_Actions_ZkontrolujIdTest::perform($idTest);
if (isset($msgs)) $messages = array_merge($messages, $msgs);
    
##  SMAZÁNÍ SESSION  ##
$destroySession = isset($_GET['destroy_session']) ? TRUE :FALSE;;
if ($destroySession) {
    $msgs = TestovaciKlikator_Actions_SmazSession::perform();
    if (isset($msgs)) $messages = array_merge($messages, $msgs);
}

##  SMAZÁNÍ POŽADAVKU ##
$deleteRequirement = isset($_GET['delete_requirement']) ? TRUE :FALSE;;
if ($deleteRequirement) {
    if ($idTest) {
        $msgs = TestovaciKlikator_Actions_SmazPozadavek::perform($idTest);
        if (isset($msgs)) $messages = array_merge($messages, $msgs);
    }
}
    
######### VYTVOŘENÍ ODKAZŮ  ############################
$urlRootDir = $definedMethod.$definedHost.'/'.$definedRootDir.'/';
$urlTestDir = $urlRootDir.$definedTestDir.'/';

$queryDefective = $parameterCoder->encode("nesmyslnyParametr");
$queryNonexistingId = $parameterCoder->encode($queryBuilder->build(array('test'=>'qqqqq')));
## Zde je třeba udrřovat existující id #####
$queryExistingId = $parameterCoder->encode($queryBuilder->build(array('test'=>$idTest)));
$links['Mazání']['Smaž session - smazání všech proměnných session a vytvoření nové'] = $_SERVER['SCRIPT_NAME'].'?destroy_session=1';
$links['Mazání']['Smaž požadavek z databáze tester'] = $_SERVER['SCRIPT_NAME'].'?delete_requirement=1';

$links['Test htaccess']['Neprávná adresa - neexistující soubor v kořenovém adresáři'] = $urlRootDir.'index.php';
$links['Test htaccess']['Neprávná adresa - existující soubor v kořenovém adresáři'] = $urlRootDir.'fileForTestingRequestValidator.html';
$links['Test htaccess']['Neprávná adresa - neexistující soubor v podadresáři s konfigurací zakázky'] = $urlTestDir.'qqqqq.php';
$links['Test htaccess']['Neprávná adresa - existující soubor v podadresáři s konfigurací zakázky'] = $urlTestDir.'halo.html';
$links['Test htaccess']['Nesprávná adresa - s neexistujícím prefixem parametru'] = $urlTestDir.'tradada';

$links['Test accessor']['Nevalidní klíč'] = $urlTestDir.$queryPrefix.$queryDefective;
$links['Test accessor']['Validní klíč, neexistující identifikátor'] = $urlTestDir.$queryPrefix.$queryNonexistingId;
$links['Test accessor']['Validní klíč, existující identifikátor'] = $urlTestDir.$queryPrefix.$queryExistingId;


######  ZOBRAZENÍ  ######################################          
$view = new TestovaciKlikator_View();
echo $view->setMessages($messages)->setLinks($links)->setDefinedTestDir($urlTestDir)->getResponse();
