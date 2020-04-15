<?php
use Tester\Model\File\Entity\Uloha;

/**
 * Description of PageParameters
 *
 * @author vlse2610
 */
class Tester_Tabbed_Controller_Page_Parameters_PageParameters implements Tester_Tabbed_Controller_Page_Parameters_PageParametersInterface {
    
    //private $napisTlacitkoNav;
   
    private $formActionNav;
    private $formActionSubmit;
    private $formAction;
    
    private $idUloha;
    
    /**
    * @var Uloha Entita Uloha
     */
    private $uloha;


    public function getFormActionNav() {
        return $this->formActionNav;
    }

    public function getFormActionSubmit() {
        return $this->formActionSubmit;
    }
    
    public function getFormAction() {
        return $this->formAction;
    }   
         
    
    public function getIdUloha() {
        return $this->idUloha;
    }

    public function getUloha(): Uloha {
        return $this->uloha;
    }      
    
    public function setFormActionNav($formActionNav) {
        $this->formActionNav = $formActionNav;
        return $this;
    }

    public function setFormActionSubmit($formActionSubmit) {
        $this->formActionSubmit = $formActionSubmit;
        return $this;
    }
    
    public function setFormAction($formAction) {
        $this->formAction = $formAction;
        return $this;
    }
    
      public function setIdUloha( $idUloha) {
        $this->idUloha = $idUloha;
        return $this;
    }

    public function setUloha( Uloha $uloha) {
        $this->uloha = $uloha;
        return $this;
    }
    
    
    
}
