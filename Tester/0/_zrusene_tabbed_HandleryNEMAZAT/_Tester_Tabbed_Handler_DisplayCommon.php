<?php
use Pes\Container\Container;

class _Tester_Tabbed_Handler_DisplayCommon extends HTML_QuickForm2_Controller_Action_Display {

    protected $container;
   
    public function __construct(Container $containet) {
        $this->container = $containet;
    }
}
