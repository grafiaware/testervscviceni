<?php


 include '../vendor/Pes/Pes/Pes/src/Bootstrap/Bootstrap.php';
 
 use Tester\AppContext;
// use Pes\Database\Handler\HandlerInterface;
// use Pes\Database\Handler\Handler;
 //use Tester\Model\Repository\SpustenyTest;
 //use Tester\Model\Entity\SpustenyTest;
   
//---------------------------------------------------------------   
    $dbh  = AppContext::getDb();  // tester_2
//---------------------------------------------------------------  

   $repositorySpustenyTest = new Tester\Model\Repository\SpustenyTest($dbh);   
   $entitySpustenyTest =  new Tester\Model\Entity\SpustenyTest();  
   
//-------------------------- pocatecni nastaveni $entitySpustenyTest ---------------------------------------      
   
   //$entitySpustenyTest->id_spusteny_test;
   $entitySpustenyTest->id_ticket_pouzity_fk = 5000;
   $entitySpustenyTest->identifikator_konfigurace_testu_fk = 1;   
   $entitySpustenyTest->cas_spusteni =   new DateTime('2018-03-01 11:00:00');             
   $entitySpustenyTest->cas_ukonceni =   new DateTime('2018-03-05 11:05:00');   
   
   echo date('Y-m-d H:i:s', $entitySpustenyTest->cas_spusteni);
   echo date('Y-m-d H:i:s', $entitySpustenyTest->cas_ukonceni);
   
   var_dump($entitySpustenyTest);   
//   
////   //----------------------------- save -------------------------------------
   
   $ret = $repositorySpustenyTest->insert($entitySpustenyTest);
      exit;
////   //------------------------ select -------------------------------------------
//      
   $id = 7;
   $selected = $repositorySpustenyTest->get($id);
   
   var_dump("Precteno z DB podle id : ".  $id );
   var_dump($selected); 
   exit;
//      
   $selected->id_ticket_pouzity_fk = 123456;
   $updated = $repositorySpustenyTest->insert($selected);    
//      
//   //-------------------------- delete -------------------------------------------
//   
//   $entitySpustenyTest->id_spusteny_test = 10;
//   $repositorySpustenyTest->delete($entitySpustenyTest);
   exit;
   
   
