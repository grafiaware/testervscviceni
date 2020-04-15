<?php
/**
 * Description of TestRequestCreator
 *
 * @author pes2704
 */
class Starter_Service_TestUrlCreator {
    public function create($idTest) {
                ## konfigurace ##
        #######  TYTO TŘI POLOŽKY SE MĚNÍ PŘI ZMĚNĚ TESTOVANÉ ZAKÁZKY ##################
        // složka zakázky (testovacího běhu)
        $definedTestDir = 'Zakazky/Zkusebni';
        ## parametry testu k test context objetu ##
        $testContextObject = new Zakazky_Zkusebni_TestContext();
        ##############################################################################        
        
        // url serveru
        $definedMethod = 'http://';
        $definedHost = 'localhost';
        // kořenová složka
        $definedRootDir = 'Tester';

        // jméno volaného skriptu, který musí být uveden u odkazu, ze kterého se test spouští
        $queryPrefix = $testContextObject->getAcceptedScriptnamePrefix();
        // Koder pro kódování parametru
        $parameterCoder = $testContextObject->getRequestParameterKoder();
        // Builder pro setavení query
        $queryBuilder = $testContextObject->getQueryBuilder();
        // název skriptu, na který bude provedeno přesměrování, pokud kontroly proběhnou v pořádku
        $targetScriptName = $testContextObject->getTargetScriptName();

        $dbh = Starter_AppContext::getDb();


        ######### VYTVOŘENÍ ODKAZU  ############################
        $urlTestDir = $definedMethod.$definedHost.'/'.$definedRootDir.'/'.$definedTestDir.'/';
        $query = $parameterCoder->encode($queryBuilder->build(array('test'=>$idTest)));

        return $urlTestDir.$queryPrefix.$query;
    }
}
