<?php
//uidentifikatorKonfiguraceTestu=5aba2c1fe2c87&identifikatorTicketu=X0001  pro zapamatovani
//id_test=841&zmrz=1

use Tester\Application\TesterApplication;

use Pes\Http\Factory\EnvironmentFactory;
use Pes\Http\Factory\ServerRequestFactory;
use Pes\Http\ResponseSender;
use Pes\Middleware\UnprocessedRequestHandler;

include '../vendor/Pes/src/Bootstrap/Bootstrap.php';

// VYPNUTÍ KVŮLI EACH() V QUICKFORM2
error_reporting(E_ALL & ~E_DEPRECATED);
$environment = (new EnvironmentFactory())->createFromGlobals();
$request = (new ServerRequestFactory())->createFromEnvironment($environment);
  
                        if (!$request) {
                                throw new \UnexpectedValueException('Zapomenutý čert !! v index  request NULL / false...' );
                        }   

$response = (new TesterApplication())->process($request, new UnprocessedRequestHandler());
( new ResponseSender() )->send( $response ); 




