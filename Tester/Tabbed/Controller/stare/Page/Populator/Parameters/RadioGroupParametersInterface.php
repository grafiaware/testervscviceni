<?php


/**
 *
 * @author vlse2610
 */
interface Tester_Tabbed_Controller_Page_Populator_Parameters_RadioGroupParametersInterface {
    
    public function getJenCist() ;
    
    public function getBezPravidel();
    
    public function getZobrazujZvoleneOdpovedi( );

    public function setJenCist($jenCist);
             
    public function setBezPravidel($bezPravidel);
    
    public function setZobrazujZvoleneOdpovedi( $zobrazuj );

}
