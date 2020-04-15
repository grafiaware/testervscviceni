<?php

namespace Spoustec\Validator;

use Spoustec\Model\Session\SessionInterface;
use Spoustec\Service\RequeServiceInterface;

/**
 * Description of ValidatorIdentifikatoruZGetu
 *
 * @author vlse2610
 */
class ValidatorIdentifikatoruZGetu implements ValidatorInterface {
    
    private $reque;
      private $session;
    
    public function __construct( RequeServiceInterface $reque,  SessionInterface $session ) {
       $this->reque = $reque ;
       $this->session = $session;
    }
    
    public function isValid($param) {
        $oznaceni = $this->reque->getOznaceniZadosti();
        
        $jeSpustenPoprve = $this->jePrvniSpusteniTestuSArgumentem ();
      
        $jeRegulerniRunda = $this->jeRegulerniRunda ( );
      
        
        assert( FALSE , "ValidatorIdentifikatoruZGetu je prazdny");
    }
    
    
    
    /**
     * Zjistuje, zda jde o prvni spusteni testu - tj. zadost o test je v GET a neni v session
     * 
     */
    public function jePrvniSpusteniTestuSArgumentem( ) {
        if (  $this->reque->getOznaceniZadosti() ) { //je v GETu  
            
            if ( ! $this->session->get('identifikace') ) {
                // 'Je argument $oznaceniZadostiOTest_zGetu 
                //  'není v session [identifikace] ---> prvni spusteni v prohlizeci s argumentem';    
                $vratit = true;  //to je spravny stav
            }
            else {
                $vratit = false;  //to je chorobny stav
                // $debug[] = 'Je argument [identifikace] ' . $identifikace_parametr_test_zGETu . 
                //    'je i v session [identifikace]: ' . _SESSION["identifikace"]. ' ----> tzn. uz sla runda kolem<br/>' ;         
                // $debug[] = "Chyba parametru skriptu - opakovane spusteni! - je parametr a je i  v session - spoustim v otevrenem prohlizeci opakovane";                                    
                // $this->die[] ="Váš test můžete spustit pouze jednou!"; 
            }
        }        
        return $vratit;
    }
    
    
    public function jeRegulerniRunda( ) {
        if ( ! $this->reque->getOznaceniZadosti() ) { //neni v GETu  
            
             if (  ( $this->reque->getRequeMethod() == 'POST' OR $this->reque->isRequestQuickFormGet() ) 
                    AND  $this->session->get("identifikace") 
                ) {  
                                                                                            // ... a je v SESSION -> OK
               // $debug[] = 'Neni argument [identifikace] , ale je  v session [identifikace]: ' . $_SESSION["identifikace"]. ' ---- tzn. uz sla runda kolem<br/>' ;
               // $idValidni = $_SESSION["identifikace"];
               $vratit = true;  
            }
            else {      //... a neni ani v SESSION -> CHYBA 
                
                //$debug[] =' Neni argument [identifikace] a neni ani  v session [identifikace]';
                //$this->die[] = "Test je možno spouštět pouze kliknutím na odkaz ve vašem e-mailu.";
                $vratit = false; 
            }    
        }
        
        return $vratit;
    }
    
    
}
