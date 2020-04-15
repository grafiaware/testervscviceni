<?php
declare(strict_types=1);
define('PES_FORCE_DEVELOPMENT', 'force_development');
//// nebo
//define('PES_FORCE_PRODUCTION', 'force_production');

include 'vendor/pes/pes/src/Bootstrap/Bootstrap.php';

use Application\WebAppFactory;
use Middleware\Web\WebDevelopment;
use Pes\Container\Container;
use Application\AppContainerConfigurator;
use Pes\Middleware\UnprocessedRequestHandler;
use Pes\Http\ResponseSender;

$app = (new WebAppFactory((new AppContainerConfigurator())->configure(new Container())))->create();
$response = $app->run(new WebDevelopment(), new UnprocessedRequestHandler());

(new ResponseSender())->send($response);
