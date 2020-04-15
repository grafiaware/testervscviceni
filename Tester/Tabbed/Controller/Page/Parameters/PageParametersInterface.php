<?php
use Tester\Model\File\Entity\Uloha;

/**
 *
 * @author vlse2610
 */
interface Tester_Tabbed_Controller_Page_Parameters_PageParametersInterface {
    
    //public function getNapisTlacitkoNav();
    public function getBasePath();
    
    public function setBasePath($basePath);
    
    public function getFormAction();

    public function getFormActionNav();

    public function getFormActionSubmit();
    
    public function getIdUloha() ;
    
    public function getUloha(): Uloha ;
    
    //---------------------------------------------------
    
    //public function setNapisTlacitkoNav($napisTlacitkoNav);

    public function setFormAction($formAction);

    public function setFormActionNav($formActionNav);

    public function setFormActionSubmit($formActionSubmit);
    
    public function setIdUloha( $idUloha) ;
   
    public function setUloha( Uloha $uloha) ;
    
    
}
