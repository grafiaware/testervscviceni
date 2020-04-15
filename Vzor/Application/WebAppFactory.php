<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application;

use Pes\Application\AppFactory;
use Pes\Application\AppInterface;

use Pes\Text\Message;
use Pes\Logger\FileLogger;
use Pes\Http\Helper\RequestDumper;

use Model\Repository\PresentationStatusRepo;

/**
 * Description of WebAppFactory
 *
 * @author pes2704
 */
class WebAppFactory extends AppFactory {

    /**
     *
     * @return AppInterface
     */
    public function create() {
        $app = $this->createFromGlobals();   // mj. automaticky nastaví urlInfo jako atribut requestu s klíčem AppFactory::URL_INFO_ATTRIBUTE_NAME
        // base log directory je nastaveno v kontejneru
        if (PES_DEVELOPMENT) {
            $logger = FileLogger::getInstance('Logs/App', 'AppLogger.log', FileLogger::REWRITE_LOG);
            $logger->info((new RequestDumper())->dump($app->getServerRequest()));
            $pathLogger = FileLogger::getInstance('Logs/App', 'RequestPathLogger.log', FileLogger::APPEND_TO_LOG);
            $uri = $app->getServerRequest()->getUri();
            $pathLogger->info((string) $uri);

        }
        return $app;
    }
}
