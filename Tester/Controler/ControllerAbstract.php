<?php
namespace Tester\Controler;

use Pes\Container\Container;

/**
 * Description of ControllerAbstract
 *
 * @author vlse2610
 */
abstract class ControllerAbstract {
    
    /**
     * @var Container
     */
    protected $container;


    public function __construct(Container $container ) {
        $this->container = $container;
    }
}
