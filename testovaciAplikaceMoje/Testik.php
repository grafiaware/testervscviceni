<?php
namespace 


//new Session\LoggingHandler('TesterSession') pro zapamatovani
//id_test=841&zmrz=1

use Pes\Http\Response;

use Pes\Container\Container;

use Tester\Model\Aggregate\EntityFactory\TestAggregateEntityFactory;
use Tester\Model\Prikaz\VstupniPrikazSpust;
use Tester\Model\Prikaz\VstupniPrikazUkaz;




class Testik extends ControllerAbstract {

    public function getKonfigDao($uidKonfiguraceTestu) {
                    
        $dbh = $containerMUJ->get(Handler::class); 
        // var_dump($dbh); 
        $metaProvider = $containerMUJ->get(MetadataProviderMysql::class);
        $hydratorRowObject = new HydratorRowObject (new NameHydrator);
        
        $daoKonfiguraceTestu = new KonfiguraceTestuDao($dbh, 'konfigurace_testu', $metaProvider, $hydratorRowObject );

        // datovy objekt --get
         $uid = $uidKonfiguraceTestu ; //'1234567890001';
         $rowObjektKonfiguraceTestu = $daoKonfiguraceTestu->get($uid);
        //var_dump($rowObjektKonfiguraceTestu);
                       
        return $this->createResponseWithHtmlObjectExport($rowObjektKonfiguraceTestu);        
    }
    
      
    public function getKonfigDaoAll($uidKonfiguraceTestu, $identifikatorTicketu) {
        
        return $this->createResponseWithHtmlObjectExport($testAgregateEntitySpust);        
    }
      
      

    private function createResponseWithHtmlObjectExport($object) {                
        
        $export = print_r($object, TRUE);
        $output =  "<html><body><h2>VYPSALO TO ????</h2><pre>".$export."</pre></body></html>";
        $response = new Response( 200 );
        $response->getBody()->write($output);
        return $response;
    }    
      
// $template = new PhpTemplate('templates/templateVstupniFormular.php');  //vytvori objekt Template a nastavi mu jmenosouboru s templatou     
//            $ulohaFormHtmlView = new View();
//            $ulohaFormHtmlView->setTemplate($template)->setData($poleProTemplate);
//            // pak pouzijeme v nem nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi - napr.echem                      
//            
//            $output =  $ulohaFormHtmlView->render();
//            $response = new Response( 200 );
//            $response->getBody()->write($output);
//            return $response;         
      
      
//    //use Pes\Session;
//    public function testujSpust($uidKonfiguraceTestu, $identifikatorTicketu) {
//        $container = (new TesterContainerFactory(Container::class))->create();
//       /* @var $entityVstupniPrikazSpust VstupniPrikazSpust */       
//        $entityVstupniPrikazSpust = $container->get( VstupniPrikazSpust::class );   
//        $entityVstupniPrikazSpust->identifikatorTicketu = $identifikatorTicketu;
//        $entityVstupniPrikazSpust->uidKonfiguraceTestu = $uidKonfiguraceTestu;
//        
//        /* @var $testAgregateEntityFactory TestAggregateEntityFactory */
//        $testAgregateEntityFactory = $container->get( TestAggregateEntityFactory::class);
//        
//        //$entityVstupniPrikazSpust = new VstupniPrikazSpust($this->request);         
//        $testAgregateEntitySpust  =  $testAgregateEntityFactory->createByPrikazSpust( $entityVstupniPrikazSpust );
//        return $this->createResponseWithHtmlObjectExport($testAgregateEntitySpust);
//    }
//    
//    
//    public function testujUkaz($idPrubehTestu) {
//        $container = (new TesterContainerFactory(Container::class))->create();
//        /* @var $entityVstupniPrikazUkaz VstupniPrikazUkaz */
//        $entityVstupniPrikazUkaz  = $container->get( VstupniPrikazUkaz::class ); 
//        $entityVstupniPrikazUkaz->idTest = $idPrubehTestu;
//        
//        /* @var $testAgregateEntityFactory TestAggregateEntityFactory */
//        $testAgregateEntityFactory = $container->get( TestAggregateEntityFactory::class);
//        
//        $testAgregateEntityUkaz  =  $testAgregateEntityFactory->createByPrikazUkaz( $entityVstupniPrikazUkaz );
//        return $this->createResponseWithHtmlObjectExport($testAgregateEntityUkaz);
//    }
//    
//    
//    
//    

//    }
}


       
