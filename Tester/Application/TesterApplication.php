<?php
namespace Tester\Application;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Pes\Container\Container;
use Pes\Session\SessionStatusHandler;
use Pes\Router\Router;

// pro definice rout
use Tester\Controler\Tester;


/**
 * Description of TesterApplication
 *
 * @author pes2704
 */
class TesterApplication implements MiddlewareInterface {
    /*
     * @var Container
     */
    private $container;


    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        
        $this->container = (new TesterContainerConfigurator($request))->configure(new Container());
        
        /* @var $sessionHandler SessionStatusHandler */
        $sessionHandler = $this->container->get(SessionStatusHandler::class);
        /* @var $router Router */
        $router = $this->container->get(Router::class);

######## ROUTY S TICKETEM - SPOUŠTĚJÍ SESSION ##################
        // zobraz nový test
        $router->addRoute('GET', 'novytest/:uidKonfiguraceTestu/:identifikatorTicketu/',
                          function($uidKonfiguraceTestu, $identifikatorTicketu)
                          {return (new Tester($this->container))->getNovyTest($uidKonfiguraceTestu, $identifikatorTicketu); });
       
        // zobraz dokonceny test
        $router->addRoute('GET', 'test/:idPrubehTestu/:identifikatorTicketu/',
                          function($idPrubehTestu, $identifikatorTicketuZobrazeni)
 /**/                     {return (new Tester($this->container))->getTest($idPrubehTestu, $identifikatorTicketuZobrazeni ); });


#########  session uz spustena ########################
        //uloha testu
        $router->addRoute('GET', 'uloha/:idUloha/', 
                          function( $idUloha )
                          {return (new Tester($this->container))->getUloha($idUloha); });


        //vzdycky po stisku tlacitka Pokracovat - "pokus o ulozeni" a presmeruje  na dalsi get otazku / uplny vypis diku/?popr.vypis odpovedi  "po ulozeni testu"
        // ulož data odpovědi
        $router->addRoute('POST', 'odpoved/:idUloha/', 
                          function( $idUloha ) 
                          {return (new Tester($this->container))->saveOdpoved($idUloha); });

        //po kliknuti navigace - přejdi na jinou ulohu
        $router->addRoute('POST', 'prechod/:idCilovaUloha/',    //'prechod/:idUloha/:idCilovaUloha/'
                          function( $idCilovaUloha )
                          {return (new Tester($this->container))->prejdiNaUlohu( $idCilovaUloha);});

        // dekujeme request, vzdy po dokonceni testu
        $router->addRoute('GET', 'dekujeme/', 
                          function() { return (new Tester($this->container))->getDekujeme(); });

        //uspesnost testu, souhrn, %, TODO
        $router->addRoute('GET', 'vysledky/', 
                          function() { return (new Tester($this->container))->getVysledky(); });



        //zde se divam na ("vstup do programu" = ) request z prohlizece
        $M = $request->getMethod() ;
        $U = $request->getUri();        //object
        $P = $request->getUri()->getPath(); //string
        return $router->route($request) ;
    }
}
