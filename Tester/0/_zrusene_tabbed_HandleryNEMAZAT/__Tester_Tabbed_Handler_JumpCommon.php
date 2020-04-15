<?php
use Pes\Container\Container;

class __Tester_Tabbed_Handler_JumpCommon extends HTML_QuickForm2_Controller_Action_Jump {

    protected $container;
   
    public function __construct(Container $container) {
        $this->container = $container;
    }
}
