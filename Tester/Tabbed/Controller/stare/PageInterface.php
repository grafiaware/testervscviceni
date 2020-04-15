<?php


/**
 *
 * @author vlse2610
 */
interface Tester_Tabbed_Controller_PageInterface {
   
    public function setPageParameters(Tester_Tabbed_Controller_Page_Parameters_PageParametersInterface $pageParameters) ;
    public function getPageParameters(): Tester_Tabbed_Controller_Page_Parameters_PageParametersInterface;
    public function storeValues( $param =\TRUE ) ;
}
