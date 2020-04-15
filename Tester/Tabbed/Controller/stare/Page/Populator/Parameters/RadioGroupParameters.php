<?php

use Tester\Model\Db\RowObject\OdpovedNaOtazkuRow;


/**
 * Description of RadioGroupParameters
 *
 * @author vlse2610
 */
class Tester_Tabbed_Controller_Page_Populator_Parameters_RadioGroupParameters 
                    implements Tester_Tabbed_Controller_Page_Populator_Parameters_RadioGroupParametersInterface {

   /**
    * Formulář je/není zobrazen v "zamrzlém stavu", tj.  je/není needitovatelný.
    * @var boolean
    */
    private $jenCist;
    
    /**
     * Nebudou/budou uplatňována pravidla formuláře.
     * @var boolean 
     */
    private $bezPravidel;
    
    /**
     * Ve formuláři bude/nebude označena  zvolená a správná odpověď.
     * @var boolean 
     */
    private $zobrazujZvoleneOdpovedi;
   

    public function getJenCist() {
        return $this->jenCist;
    }    
    public function getBezPravidel() {       
        return $this->bezPravidel;
    }   
    public function getZobrazujZvoleneOdpovedi( ) {
        return $this->zobrazujZvoleneOdpovedi;
    }
    

    public function setJenCist( $jenCist) {
        $this->jenCist = $jenCist;
        return $this;
    }
    public function setBezPravidel( $bezPravidel) {
        $this->bezPravidel = $bezPravidel;
        return $this;
    }    
    public function setZobrazujZvoleneOdpovedi( $zobrazuj ) {
        $this->zobrazujZvoleneOdpovedi = $zobrazuj;
        return $this;
    }
  


}
