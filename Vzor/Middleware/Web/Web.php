<?php
namespace Middleware\Web;

use Pes\Middleware\AppMiddlewareAbstract;
use Pes\Container\Container;

use Pes\Router\RouterInterface;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Middleware\Menu\MenuContainerConfigurator;

use Middleware\Web\Controller\GetController;

class Web extends AppMiddlewareAbstract implements MiddlewareInterface {

    ## proměnné třídy - pro dostupnost v Closure definovaných v routách ##
    private $request;

    private $container;

    /**
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return Response
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {

        $this->request = $request;

        // middleware kontejner:
        //      nový kontejner konfigurovaný dvěma konfigurátory: ComponentContainerConfigurator a MenuContainerConfigurator
        //      -> delagát další nový kontejner konfigurovaný WebContainerConfigurator
        //      -> v něm jako delegát aplikační kontejner
        // komponenty a menu používají databázi z menu kontejneru (upgrade), web používá starou databázi
        $this->container =
            (new ComponentContainerConfigurator())->configure(
                (new MenuContainerConfigurator())->configure(
                        new Container(
                            (new WebContainerConfigurator())->configure(
                                    new Container($this->getApp()->getAppContainer())
                            )
                        )
                )
            );

####################################
        /* @var $router RouterInterface */
        $router = $this->container->get(RouterInterface::class);

        $router->addRoute('GET', '/', function() {
                /** @var GetController $ctrl */
                $ctrl = $this->container->get(GetController::class);
                $ctrl->forRequest($this->request);
                return $ctrl->home();
            });
        $router->addRoute('GET', '/www/last', function() {
                /** @var GetController $ctrl */
                $ctrl = $this->container->get(GetController::class);
                $ctrl->forRequest($this->request);
                return $ctrl->last();
            });
        $router->addRoute('GET', '/www/item/:uid', function($uid) {
                /** @var GetController $ctrl */
                $ctrl = $this->container->get(GetController::class);
                $ctrl->forRequest($this->request);
                return $ctrl->item($uid);
            });
        $router->addRoute('GET', '/www/searchresult', function() {
                /** @var GetController $ctrl */
                $ctrl = $this->container->get(GetController::class);
                $ctrl->forRequest($this->request);
                return $ctrl->searchResult();
            });
        return $router->route($request) ;
    }
}


