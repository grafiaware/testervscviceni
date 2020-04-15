<?php
namespace Tester\Tabbed\Factory;

use Pes\Container\Container;


/**
 *
 * @author vlse2610
 */
interface __TabbedFactoryInterface {
    /**
     * 
     * @param Container $container
     * @param type $testZadaniArray
     * 
     * @return \Tester_Tabbed_TesterovyController
     */
    public function create(Container /*$container,*/ $testZadaniArray );
}
