<?php
use Tester\Model\File\Entity\Otazka;
use Tester\Model\Db\RowObject\OdpovedNaOtazkuRow;


/**
 *
 * @author vlse2610
 */
interface Tester_Tabbed_Controller_Page_Populator_RadioGroupPopulatorInterface {
    /**
     * 
     * @param string $idOtazka
     * @param Otazka $otazka     
     * @param OdpovedNaOtazku $odpovedZvolena
     * @param string $bezPravidel
     */
   // public function initialize($idOtazka, Otazka $otazka, /*$napisTlacitkoNav, */
   //         OdpovedNaOtazku $odpovedZvolena=null, $bezPravidel=\FALSE );
    
    public function initialize_setPopulParameters(Tester_Tabbed_Controller_Page_Populator_Parameters_RadioGroupParametersInterface $parameters) ;
}
