<?php

use TestAplikace\TesterContainerConfiguratorMUJ;
use TestAplikace\TestikDaoApp;

use Pes\Container\Container;
// database
use Pes\Database\Handler\ConnectionInfo;
use Pes\Database\Handler\DbTypeEnum;
use Pes\Database\Handler\DsnProvider\DsnProviderMysql;
use Pes\Database\Handler\OptionsProvider\OptionsProviderMysql;
use Pes\Database\Handler\AttributesProvider\AttributesProviderDefault;
use Pes\Database\Handler\Handler;
use Pes\Database\Handler\HandlerInterface;
use Pes\Database\Metadata\MetadataProviderMysql;

use Pes\Http\Factory\EnvironmentFactory;
use Pes\Http\Factory\ServerRequestFactory;
use Pes\Http\ResponseSender;
use Pes\Middleware\UnprocessedRequestHandler;


use Tester\Model\Db\Dao\KonfiguraceTestuDao;
use Tester\Model\Db\RowObject\Hydrator\HydratorRowObject;
use Tester\Model\Db\RowObject\Hydrator\NameHydrator;

use Tester\Model\Db\RowObject\KonfiguraceTestuRow;
use Tester\Model\Db\Entity\KonfiguraceTestuEntity;
use Tester\Model\Db\Repository\KonfiguraceTestuRepository;

//
include '../vendor/Pes/src/Bootstrap/Bootstrap.php';

//*************************************************************
// VYPNUTÍ KVŮLI EACH() V QUICKFORM2
error_reporting(E_ALL & ~E_DEPRECATED);
$environment = (new EnvironmentFactory())->createFromGlobals();
$request = (new ServerRequestFactory())->createFromEnvironment($environment);  

                if (!$request) {
                                throw new \UnexpectedValueException('Zapomenutý čert !! v index  request NULL / false...' );
                        }   
                        
                $response = (new TestikDaoApp())->process($request, new UnprocessedRequestHandler());  //VYROBI RESPONSE
/*tady jsem*/                
               ( new ResponseSender() )->send( $response ); 



//----------------------------------- bylo funkcni
//
// $containerMUJ = (new TesterContainerConfiguratorMUJ($request))->configure(new Container()); 
// $dbh = $containerMUJ->get(Handler::class); 
// var_dump($dbh);
// 
// 
// 
// $metaProvider = $containerMUJ->get(MetadataProviderMysql::class);
// $hydratorRowObject = new HydratorRowObject (new NameHydrator);
//  
// $daoKonfiguraceTestu = new KonfiguraceTestuDao($dbh, 'konfigurace_testu', $metaProvider, $hydratorRowObject );
// 
//// datovy objekt --get
// $uid = '1234567890001';
// $rowObjektKonfiguraceTestu = $daoKonfiguraceTestu->get($uid);
// var_dump($rowObjektKonfiguraceTestu);
// 
// // pole datovych objektu --find
// $rowObjektKonfiguraceTestuAll = $daoKonfiguraceTestu->find('uid_konfigurace_testu like :place', [ 'place' => '12%'] );
// var_dump($rowObjektKonfiguraceTestuAll);  
// 
// 
 
 
 
 //ykusit yapsat
 //zkusit dat do prubezny test dao application 

