<?php
namespace Tester\Application;

// kontejner
use Pes\Container\ContainerConfiguratorHttpAbstract;
use Psr\Container\ContainerInterface;   


use Pes\Utils\Directory;

// logger
use Pes\Logger\FileLogger;

// session
use Pes\Session\SessionStatusHandler;
use Pes\Session\SaveHandler\PhpLoggingSaveHandler;

//router
use Pes\Router\Router;

// database
use Pes\Database\Handler\ConnectionInfo;
use Pes\Database\Handler\DbTypeEnum;
use Pes\Database\Handler\DsnProvider\DsnProviderMysql;
use Pes\Database\Handler\OptionsProvider\OptionsProviderMysql;
use Pes\Database\Handler\AttributesProvider\AttributesProviderDefault;
use Pes\Database\Handler\Handler;
use Pes\Database\Handler\HandlerInterface;
use Pes\Database\Metadata\MetadataProviderMysql;


//hydrator
use Tester\Model\Aggregate\Hydrator as AggHydrator;
use Tester\Model\Db\RowObject\Hydrator as DbHydrator;
use Tester\Model\Db\RowObject\Hydrator as DbNameHydrator;

// repository
use Tester\Model\Session\Repository as SessionRepo;
use Tester\Model\Aggregate\Repository as AggRepo;
use Tester\Model\Db\Dao as DbRepo;
use Tester\Model\File\Repository as FileRepo;

use Tester\Model\Aggregate\Entity as AggEntity;

// service
use Tester\Service\SpustTestService;
use Tester\Service\UkazTestService;

use Tester_Tabbed_Controller_Page_Parameters_PageParameters;



/**
 *
 *
 * @author pes2704
 */
class TesterContainerConfigurator extends ContainerConfiguratorHttpAbstract {

    public function getAliases() {
    }
    
    
    

// Service vraci stale stejny objekt (vyrobi ho 1x)
    public function getSevicesDefinitions() {
        return [
           // konfigurace
            'databaseNick' => 'tester',
            'databaseHost' => 'localhost',
            'databaseName' => 'tester_3',
            'databaseUser' => 'root',
            'databasePassword' => 'spravce',
            // 'basePath' => 'http://localhost/TesterVScviceni201908/Tester/',
            'basePath' => '/TesterVScviceni/Tester/',
            
            'cestaKSadamOtazekASpravnychOdpovedi' => 'sadaUloh/',
            'cestaKTextumAplikace' => 'textyAplikace/',
            'invalidHtmlForm' => 'htmlFormSChybovymHlasenim',

            'nameAdresarLogs' => 'Logs/Tester',
            'nameFileSessionLog' => 'Session.log',
            'nameFileTesterApplicationLog' => 'TesterApplication.log',
            'nameSession' => 'TesterSession',
            'nameRouterLog' => 'Router.log',

            // request
            'request' => function(ContainerInterface $c) {
                return $this->request;
            },

            // session handler
            SessionStatusHandler::class => function(ContainerInterface $c) {
                $sessionLogger = FileLogger::getInstance( $c->get('nameAdresarLogs'),
                                                          $c->get('nameFileSessionLog'), FileLogger::REWRITE_LOG);
                $saveHandler = new PhpLoggingSaveHandler( $sessionLogger );
                return new SessionStatusHandler( $c->get('nameSession'),$saveHandler );
            },

            SessionRepo\SessionTestu::class => function(ContainerInterface $c) {
                return new SessionRepo\SessionTestu( $c->get(SessionStatusHandler::class) );
            },
                    
            SessionRepo\SessionTabbedu::class => function(ContainerInterface $c) {
                return new SessionRepo\SessionTabbedu( $c->get(SessionStatusHandler::class) );
            },          
                    
                                        
            // router        
            Router::class => function(ContainerInterface $c) {
                return new Router(FileLogger::getInstance($c->get('nameAdresarLogs'), $c->get('nameRouterLog')));
            },

    
            // database
            Handler::class => function(ContainerInterface $c) : HandlerInterface {
                $connectionInfoUtf8 = new ConnectionInfo($c->get('databaseNick'), DbTypeEnum::MySQL, $c->get('databaseHost'),
                                                         $c->get('databaseUser'), $c->get('databasePassword'), $c->get('databaseName'));
                $dsnProvider = new DsnProviderMysql();
                $optionsProvider = new OptionsProviderMysql();
                $logger = FileLogger::getInstance($c->get('nameAdresarLogs'),
                                                  $c->get('nameFileTesterApplicationLog'), FileLogger::REWRITE_LOG); //new NullLogger();
                $attributesProviderDefault = new AttributesProviderDefault($logger);
                return new Handler($connectionInfoUtf8, $dsnProvider, $optionsProvider, $attributesProviderDefault, $logger);
            },
            MetadataProviderMysql::class => function(ContainerInterface $c) {
                return new MetadataProviderMysql($c->get(Handler::class));
            },

                    
            // hydrator
            DbNameHydrator\NameHydrator::class => function(ContainerInterface $c) {
                return new DbNameHydrator\NameHydrator();
            },
            DbHydrator\Hydrator::class => function(ContainerInterface $c) {
                return new DbHydrator\Hydrator($c->get(DbNameHydrator\NameHydrator::class) );
            },
                    
            AggHydrator\AggregateHydrator::class =>  function(ContainerInterface $c) {
                return new AggHydrator\AggregateHydrator();
            },
   

//minule
// Agg repository
//AggRepo\ZadaniTestuAggregateRepository::class => function( ContainerInterface $c ) {                                              
//        $repoKonfiguraceTestu = $c->get(DbRepo\KonfiguraceTestu::class);
//              $repoSadaOtazek = $c->get(DbRepo\SadaOtazek::class);
//                  $repoOtazky = $c->get(FileRepo\Ulohy::class);                                  
//                    $hydrator = $c->get(AggHydrator\AggregateHydrator::class); 
//            $repoSessionTestu = $c->get(SessionRepo\SessionTestu::class);
//
//  $repositoryZadaniTestAggreg = new AggRepo\ZadaniTestuAggregateRepository
//                ($repoKonfiguraceTestu, $repoSadaOtazek, $repoOtazky,
//                 $repoSessionTestu,  $hydrator);
//    return $repositoryZadaniTestAggreg;  //vraci repository
//},                                                 
//AggRepo\SpoustenyTestAggregateRepository::class => function( ContainerInterface $c ) {
//             $repoPrubehTestu = $c->get(DbRepo\PrubehTestu::class);
//           $repoTicketPouzity = $c->get(DbRepo\TicketPouzity::class);                   
//            $repoSessionTestu = $c->get(SessionRepo\SessionTestu::class);                         
//                    $hydrator = $c->get(AggHydrator\AggregateHydrator::class); 
//
//    $repositorySpoustTestAggreg = new AggRepo\SpoustenyTestAggregateRepository
//                        ( $repoPrubehTestu, $repoTicketPouzity, $repoSessionTestu,  $hydrator);
//    return $repositorySpoustTestAggreg;  //vraci repository
//},                                                                                       
//AggRepo\OdpovedAggregateRepository::class => function(ContainerInterface $c) {
//                    $repoOdpoved =  $c->get(DbRepo\Odpoved::class);
//            $repoOdpovedNaOtazku = $c->get(DbRepo\OdpovedNaOtazku::class);
//               $repoSessionTestu = $c->get(SessionRepo\SessionTestu::class);
//                       $hydrator = $c->get(AggHydrator\AggregateHydrator::class); 
//     $repositoryOdpovedAggregate = new AggRepo\OdpovedAggregateRepository( $repoOdpoved, $repoOdpovedNaOtazku, $repoSessionTestu, $hydrator );
//    return $repositoryOdpovedAggregate;
//}, 

//AggEntity\SpoustenyTestAggregate::class => function (ContainerInterface $c) { //Tester\Model\Aggregate\Repository\SpoustenyTestAggregateRepository    
//    /* @var $repo AggRepo\SpoustenyTestAggregateRepository */
//    $repoSpoustTest  =  $c->get( AggRepo\SpoustenyTestAggregateRepository::class );   
//    /* @var $ent AggRepo\SpoustenyTestAggregate */
//    $ent = $repoSpoustTest->getPodleIdPrubehuTestuZSession();         
//    return $ent;    
//},                   
//AggEntity\ZadaniTestuAggregate::class => function (ContainerInterface $c) {
//    /* @var $repo AggRepo\ZadaniTestuAggregateRepository  */
//    $repoZadani = $c->get ( AggRepo\ZadaniTestuAggregateRepository::class );
//    $spoustenyTest = $c->get ( AggEntity\SpoustenyTestAggregate::class);
//    /* @var $ent AggEntity\ZadaniTestuAggregate */
//    $ent = $repoZadani->getPodleUidKonfigurace( $spoustenyTest->prubehTestu->uidKonfiguraceTestuFk ) ;          
//    return $ent; 
//},
//AggEntity\OdpovedAggregate::class => function (ContainerInterface $c) {     
//    /* @var $repoOdpoved AggRepo\OdpovedAggregateRepository */
//    $repoOdpoved =  $c->get ( AggRepo\OdpovedAggregateRepository::class);
//    $spoustenyTest = $c->get ( AggEntity\SpoustenyTestAggregate::class);
//    /* @var $ent AggEntity\OdpovedAggregate */
//    $ent = $repoOdpoved->getByPrubehTestuId( $spoustenyTest->prubehTestu->idPrubehTestu );       
//    // kdyz nejsou jeste odpovedi - je NULL
//    return $ent;
//},     
//minule - konec



              
                                                                                                   
            AggRepo\GetTestAggregateRepository::class => function( ContainerInterface $c ) {
                         $repoPrubehTestu = $c->get(DbRepo\PrubehTestu::class);
                       $repoTicketPouzity = $c->get(DbRepo\TicketPouzity::class);                   
                        $repoSessionTestu = $c->get(SessionRepo\SessionTestu::class);                         
                                $hydrator = $c->get(AggHydrator\AggregateHydrator::class); 
                                
                      $repoZadaniTestuAgg = $c->get(AggRepo\ZadaniTestuAggregateRepository::class);
                               
                $repositorySpoustTestAggreg = new AggRepo\GetTestAggregateRepository
                                    ( $repoPrubehTestu, $repoTicketPouzity, $repoSessionTestu,  $hydrator, $repoZadaniTestuAgg);
                return $repositorySpoustTestAggreg;  //vraci repository
            },           
                    
            AggRepo\PostTestAggregateRepository::class => function( ContainerInterface $c ) {
                         $repoPrubehTestu = $c->get(DbRepo\PrubehTestu::class);
                       $repoTicketPouzity = $c->get(DbRepo\TicketPouzity::class);                   
                        $repoSessionTestu = $c->get(SessionRepo\SessionTestu::class);                         
                                $hydrator = $c->get(AggHydrator\AggregateHydrator::class); 
                                
                        $repoZadaniTestuAgg = $c->get(AggRepo\ZadaniTestuAggregateRepository::class);
                       $repoOdpovedTestuAgg = $c->get(AggRepo\OdpovedAggregateRepository::class);   
                       
                $repositoryPostTestAggreg = new AggRepo\PostTestAggregateRepository
                                    ( $repoPrubehTestu, $repoTicketPouzity, $repoSessionTestu,  $hydrator, $repoZadaniTestuAgg, $repoOdpovedTestuAgg );
                return $repositoryPostTestAggreg;  //vraci repository
            },      
            AggRepo\ZadaniTestuAggregateRepository::class => function( ContainerInterface $c ) {                                              
                    $repoKonfiguraceTestu = $c->get(DbRepo\DaoKonfiguraceTestu::class);
                          $repoSadaOtazek = $c->get(DbRepo\SadaUloh::class);
                              $repoOtazky = $c->get(FileRepo\Ulohy::class);                                  
                                $hydrator = $c->get(AggHydrator\AggregateHydrator::class); 
                        //$repoSessionTestu = $c->get(SessionRepo\SessionTestu::class);

                $repositoryZadaniTestAggreg = new AggRepo\ZadaniTestuAggregateRepository
                            ($repoKonfiguraceTestu, $repoSadaOtazek, $repoOtazky,
                             /*$repoSessionTestu,*/  $hydrator);
                return $repositoryZadaniTestAggreg;  //vraci repository
            },            
                    
            AggRepo\OdpovedAggregateRepository::class => function(ContainerInterface $c) {
                                $repoOdpoved =  $c->get(DbRepo\Odpoved::class);
                        $repoOdpovedNaOtazku = $c->get(DbRepo\OdpovedNaOtazku::class);
                           //$repoSessionTestu = $c->get(SessionRepo\SessionTestu::class);
                                   $hydrator = $c->get(AggHydrator\AggregateHydrator::class); 
                                   
                $repositoryOdpovedAggregate = new AggRepo\OdpovedAggregateRepository( $repoOdpoved, $repoOdpovedNaOtazku, /*$repoSessionTestu,*/ $hydrator );
                return $repositoryOdpovedAggregate;
            }, 
            
//................................................ 
            // idPrubehTestu je ze SESSION $sessE->idDbEntityPrubehTestu
            AggEntity\GetTestAggregate::class => function (ContainerInterface $c) { //Tester\Model\Aggregate\Repository\SpoustenyTestAggregateRepository
                /* @var $sessionR SessionRepo\SessionTestu */
                $sessionR = $c->get ( SessionRepo\SessionTestu::class );
                /* @var $sessE SessionEntity\SessionTestu */
                $sessE = $sessionR->get(); 
                /* @var $repoGetTestAgg AggRepo\GetTestAggregateRepository */
                $repoGetTestAgg  =  $c->get ( AggRepo\GetTestAggregateRepository::class );                                   
                /* @var $ent AggEntity\GetTestAggregate */
                $ent = $repoGetTestAgg->get( $sessE->idDbEntityPrubehTestu);   //ze session   
                return $ent;    
            },           
            
            // idPrubehTestu je ze SESSION $sessE->idDbEntityPrubehTestu        
            AggEntity\PostTestAggregate::class => function (ContainerInterface $c) { //Tester\Model\Aggregate\Repository\SpoustenyTestAggregateRepository
                /* @var $sessionR SessionRepo\SessionTestu */
                $sessionR = $c->get( SessionRepo\SessionTestu::class );
                /* @var $sessE SessionEntity\SessionTestu */
                $sessE = $sessionR->get(); 
                /* @var $repoGetTestAgg AggRepo\PostTestAggregateRepository */
                $repoPostTestAgg  =  $c->get( AggRepo\PostTestAggregateRepository::class );                                   
                /* @var $ent AggEntity\PostTestAggregate */
                $ent = $repoPostTestAgg->get( $sessE->idDbEntityPrubehTestu);   //ze session    
                return $ent;    
            },                                       
//.........
                    
            AggEntity\ZadaniTestuAggregate::class => function (ContainerInterface $c) {
                /* @var $repo AggRepo\ZadaniTestuAggregateRepository  */
                $repoZadani = $c->get ( AggRepo\ZadaniTestuAggregateRepository::class );
                /* @var $getTestE AggEntity\GetTestAggregate */
                $getTestE = $c->get ( AggEntity\GetTestAggregate::class);
                /* @var $ent AggEntity\ZadaniTestuAggregate */
                $ent = $repoZadani->getPodleUidKonfigurace( $getTestE->prubehTestu->uidKonfiguraceTestuFk ) ;          
                return $ent; 
            },
                    
            AggEntity\OdpovedAggregate::class => function (ContainerInterface $c) {     
                /* @var $repoOdpoved AggRepo\OdpovedAggregateRepository */
                $repoOdpoved =  $c->get ( AggRepo\OdpovedAggregateRepository::class);
                /* @var $getTestE AggEntity\GetTestAggregate */
                $getTestE = $c->get ( AggEntity\GetTestAggregate::class);
                /* @var $ent AggEntity\OdpovedAggregate */
                $ent = $repoOdpoved->getByPrubehTestuId( $getTestE->prubehTestu->idPrubehTestu );       
                // kdyz nejsou jeste odpovedi - je NULL
                return $ent;
            },                           
        
//...........................................................         

            // Db repository
            DbRepo\PrubehTestu::class =>  function( ContainerInterface $c) {
                return new DbRepo\PrubehTestu(
                        $c->get(Handler::class),
                        'prubeh_testu',
                        $c->get(MetadataProviderMysql::class),
                        $c->get(DbHydrator\Hydrator::class));
            },
            DbRepo\DaoKonfiguraceTestu::class => function(ContainerInterface $c) {
                return new DbRepo\DaoKonfiguraceTestu(
                        $c->get(Handler::class),
                        'konfigurace_testu',
                        $c->get(MetadataProviderMysql::class),
                        $c->get(DbHydrator\Hydrator::class));
            },
            DbRepo\SadaUloh::class => function(ContainerInterface $c) {
                return new DbRepo\SadaUloh(
                        $c->get(Handler::class),
                        'sada_otazek',
                        $c->get(MetadataProviderMysql::class),
                        $c->get(DbHydrator\Hydrator::class));
            },
            DbRepo\TicketPouzity::class => function(ContainerInterface $c) {
                return new DbRepo\TicketPouzity(
                        $c->get(Handler::class),
                        'ticket_pouzity',
                        $c->get(MetadataProviderMysql::class),
                        $c->get(DbHydrator\Hydrator::class));
            },
            FileRepo\Ulohy::class => function(ContainerInterface $c) {
                return new FileRepo\Ulohy( $c->get('cestaKSadamOtazekASpravnychOdpovedi')); 
            },
            FileRepo\TextyTesteru::class => function(ContainerInterface $c) {
                return new FileRepo\TextyTesteru( $c->get('cestaKTextumAplikace')); 
            },
            DbRepo\Odpoved::class => function (ContainerInterface $c) {
                return new DbRepo\Odpoved
                        ($c->get(Handler::class),
                        'odpoved',
                        $c->get(MetadataProviderMysql::class),
                        $c->get(DbHydrator\Hydrator::class));
            },
            DbRepo\OdpovedNaOtazku::class => function ( ContainerInterface $c) {
                return new DbRepo\OdpovedNaOtazku(
                        $c->get(Handler::class),
                        'odpoved_na_otazku',
                        $c->get(MetadataProviderMysql::class),
                        $c->get(DbHydrator\Hydrator::class));
            },
                

          
            \Tester_Tabbed_TesterovyController::class => function ( ContainerInterface $c) {
                /* @var $sessionRepo SessionRepo\SessionTestu */         
                $sessionRepo = $c->get (  SessionRepo\SessionTestu::class );
                $sessionE = $sessionRepo->get();                          
                /* @var $zadaniE AggEntity\ZadaniTestuAggregate  */                
                $zadaniE = $c->get( AggEntity\ZadaniTestuAggregate::class );               
                /* @var $tabbed \Tester_Tabbed_TesterovyController  */                    
                $tabbed = new \Tester_Tabbed_TesterovyController('Tabbed', false); 
                foreach ( $zadaniE->ulohy as $idUloha=>$uloha) {   
                    if  ( $sessionE->testUkoncen ) { 
                             $tabbed->setZamrzly();   }      
                    else {   $tabbed->setNezamrzly(); }
                    /* @var  $pageAutomat \Tester_Tabbed_Controller_Page_Populator_RadioGroupPopulatorForJenCist */
                    $pageAutomat = new \Tester_Tabbed_Controller_Page_Populator_RadioGroupPopulator(new \HTML_QuickForm2( $idUloha, 'post', NULL, FALSE));              
                    
                    $pageParameters = new Tester_Tabbed_Controller_Page_Parameters_PageParameters(); 
                    $pageParameters->setFormActionNav('prechod/')
                                   ->setFormActionSubmit('odpoved/')
                                   ->setFormAction('cokoli/')
                                   ->setIdUloha($idUloha)
                                   ->setUloha($uloha)
                                    ->setBasePath($c->get('basePath'));
                    $pageAutomat->setPageParameters( $pageParameters);                                  
                    
                    $pageAutomat->initialize_setPopulParameters ( (new \Tester_Tabbed_Controller_Page_Populator_Parameters_RadioGroupParameters())
                                            ->setBezPravidel(\FALSE)
                                            ->setZobrazujZvoleneOdpovedi(  $tabbed->getZobrazujZvoleneOdpovedi()  )
                                            ->setJenCist( $tabbed->getjenCist()  ) );                      
                    $tabbed->addPage($pageAutomat);
                    // -------These actions manage going directly to the pages with the same name                 
                    $tabbed->addHandler($idUloha, new \HTML_QuickForm2_Controller_Action_Direct());
                }         
                // We actually add these handlers here for the sake of example
                // They can be automatically loaded and added by the controller
                // $tabbed->addHandler('submit', new \HTML_QuickForm2_Controller_Action_Submit());                    
                // $tabbed->addHandler('jump', new \HTML_QuickForm2_Controller_Action_Jump());                               
                // This is the action we should always define ourselves
                // $tabbed->addHandler('process', new \Tester_Tabbed_Handler_Process( ));
                // We redefine 'display' handler to use the proper stylesheets        
                if ( $tabbed->getjenCist()/*gFactory->jenCist*/) {
                     $tabbed->addHandler('display', new \Tester_Tabbed_Handler_DisplayFrozen( ));        
                } else {
                    $tabbed->addHandler('display', new \Tester_Tabbed_Handler_Display(  ));        
                }           
                return $tabbed;
            },   
                     
            
            // service
            SpustTestService::class => function( ContainerInterface $c) {
                return new SpustTestService( $c->get(DbRepo\TicketPouzity::class));
            },
            UkazTestService::class => function( ContainerInterface $c) {
                return new UkazTestService( $c->get ( DbRepo\TicketPouzity::class), 
                                            $c->get ( DbRepo\Odpoved::class) );
            },        
        ];
    }

    
    
    //vzdycky se vyrobi znovu
    public function getFactoriesDefinitions() {

    }
}

             
//            'factoryNaNezamrzlyTabbed' => function ( ContainerInterface $c) {
//                return new TabbedFactory(\FALSE, \FALSE);   
//            },        
//                    
//            'factoryNaZamrzlyTabbed' => function ( ContainerInterface $c) {
//                return new TabbedFactory(\TRUE, \TRUE);   
//            },              
                    
//            // AggRepo\KompletTestAggregate  
//            AggRepo\KompletTestAggregate::class => function(ContainerInterface $c) {   
//                                    $repoPrubehTestu  = $c->get(DbRepo\PrubehTestu::class);
//                                  $repoTicketPouzity  = $c->get(DbRepo\TicketPouzity::class);
//                               $repoKonfiguraceTestu  = $c->get(DbRepo\KonfiguraceTestu::class);
//                                     
//                                     $repoSadaOtazek  = $c->get(DbRepo\SadaOtazek::class);
//                                           $repoUlohy = $c->get(FileRepo\Ulohy::class);
//                                                                   
//                                         $repoOdpoved = $c->get(DbRepo\Odpoved::class);
//                                 $repoOdpovedNaOtazku = $c->get(DbRepo\OdpovedNaOtazku::class);                                     
//                                    $repoSessionTestu = $c->get(SessionRepo\SessionTestu::class);
//                                  $repoSessionTabbedu = $c->get(SessionRepo\SessionTabbedu::class );                       
//                $repositoryKompletTestAggregate = new AggRepo\KompletTestAggregate
//                            ($repoPrubehTestu, $repoTicketPouzity, $repoKonfiguraceTestu, 
//                             $repoSadaOtazek, $repoUlohy,
//                             $repoOdpoved, $repoOdpovedNaOtazku, 
//                             $repoSessionTestu, $repoSessionTabbedu );   
//                return $repositoryKompletTestAggregate;
//            },       



//            AggRepo\TestAggregate::class => function( ContainerInterface $c) {
//                         $repoPrubehTestu = $c->get(DbRepo\PrubehTestu::class);
//                       $repoTicketPouzity = $c->get(DbRepo\TicketPouzity::class);
//                    $repoKonfiguraceTestu = $c->get(DbRepo\KonfiguraceTestu::class);
//                          $repoSadaOtazek = $c->get(DbRepo\SadaOtazek::class);
//                              $repoOtazky = $c->get(FileRepo\Ulohy::class);
//                        $repoSessionTestu = $c->get(SessionRepo\SessionTestu::class);                
//                                $hydrator = $c->get(AggHydrator\TestAggregateHydrator::class); $hydrator;
//                $repositoryTestAggreg = new AggRepo\TestAggregate
//                                    ( $repoPrubehTestu, $repoTicketPouzity, $repoKonfiguraceTestu,
//                                      $repoSadaOtazek, $repoOtazky, $repoSessionTestu,  $hydrator);
//                return $repositoryTestAggreg;  //vraci repository
//            },

//-------------------------------------------------
            // entity factory
//            TestAggregateEntityFactory::class => function(ContainerInterface $c) {
//                return new TestAggregateEntityFactory(
//                                                    $c->get(DbRepo\PrubehTestu::class),
//                                                    $c->get(DbRepo\KonfiguraceTestu::class),
//                                                    $c->get(DbRepo\SadaOtazek::class),
//                                                    $c->get(FileRepo\Ulohy::class),
//                                                    $c->get(DbRepo\TicketPouzity::class),
//                                                    $c->get(SessionRepo\SessionTestu::class),
//                                                    $c->get(AggHydrator\TestAggregateHydrator::class) );
//            },                    
//            KompletTestAggregateEntityFactory::class => function(ContainerInterface $c) {    
//                    return new KompletTestAggregateEntityFactory (
//                                                $c->get(DbRepo\PrubehTestu::class),             
//                                                $c->get(DbRepo\KonfiguraceTestu::class),
//                                                $c->get(DbRepo\SadaOtazek::class),
//                                                $c->get(FileRepo\Ulohy::class),
//                                    /* TicketPouzity $repoTicketPouzity,*/            
//                                                $c->get(DbRepo\Odpoved::class),
//                                                $c->get(DbRepo\OdpovedNaOtazku::class),                                   
//                                                $c->get(SessionRepo\SessionTestu::class),            
//                                                //$c->get(StavRepo\StavTabbedu::class),            
//                                                $c->get(AggHydrator\TestAggregateHydrator::class) );       
//            },        
                    
//            OdpovedAggregateEntityFactory::class => function( ContainerInterface $c) {
//                return new OdpovedAggregateEntityFactory( $c->get(SessionRepo\SessionTestu::class),
//                                                          $c->get(SessionRepo\SessionTabbedu::class)   );
//            }


//    ConnectionInfo::class => function(ContainerInterface $c) : HandlerInterface {
//            return new ConnectionInfo($c->get('databaseNick'), DbTypeEnum::MySQL, $c->get('databaseHost'),
//                                              $c->get('databaseUser'), $c->get('databasePassword'), $c->get('databaseName'));
//    },