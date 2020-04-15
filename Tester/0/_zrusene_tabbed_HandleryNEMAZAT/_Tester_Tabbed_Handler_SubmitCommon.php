<?php
use Pes\Container\Container;

class _Tester_Tabbed_Handler_SubmitCommon extends HTML_QuickForm2_Controller_Action_Submit
            //implements HTML_QuickForm2_Controller_Action
{

    protected $container;
   
    public function __construct(Container $container) {
        $this->container = $container;
    }
}
