<?php

    include '../../Pes/Pes/src/Bootstrap/Bootstrap.php';
      
    use Pes\Database\Metadata\MetadataProviderMysql;
      
    use Pes\Http\Environment;
    use Pes\Http\Request;
   
    use Tester\AppContext;    
    //use Pes\Logger\FileLogger;
    use Tester\Model\Db\RowObject\Hydrator;

    $environment = new Environment($_SERVER);

    $request = Request::createFromEnvironment($environment);                  
    //-----------------------------------------
    //$mojeSessionHandler = new Handler\Session(); //+start()    

    //-----------------------------------------       
    $dbh  = AppContext::getDb();  // tester_2    
    
    $metadataProviderMysql = new MetadataProviderMysql($dbh);                        
    
    
    $nameHydrator =  new Hydrator\NameHydrator();
    $hydrator = new Hydrator\HydratorRowObject( $nameHydrator );
    
    
    //--------------------------------------------------------------------------
//    $odpovedNaOtazkuRepo = new \Tester\Model\Db\Dao\OdpovedNaOtazku( $dbh, 'odpoved_na_otazku',  $metadataProviderMysql );
//    $odpovedNaOtazkuRepo->removeAll();
//    
//    $odpovedRepo = new \Tester\Model\Db\Dao\Odpoved( $dbh, 'odpoved',  $metadataProviderMysql );
//    $odpovedRepo->removeAll();
//    
//    $spustenyTestRepo = new \Tester\Model\Db\Dao\PrubehTestu( $dbh, 'spusteny_test', $metadataProviderMysql);
//    $spustenyTestRepo->removeAll();
    
    
    //samostatne nelze mazat  kvuli integrity constrain violation - cizi klice
    $ticketPouzityRepo  = new \Tester\Model\Db\Dao\TicketPouzityDao ($dbh, 'ticket_pouzity', $metadataProviderMysql, $hydrator);
    $ticketPouzityRepo->deleteAll();
     
    $ticketPouzityRepo->deleteAll();
