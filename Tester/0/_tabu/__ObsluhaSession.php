<?php
namespace Tester\Service;

use Tester\Service\ObsluhaSessionInterface;
use Tester\Model\Handler\Session\SessionInterface;
use Tester\Model\Handler\Session\Session;
//use Spoustec\Cosi\CosiEnum;

/**
 * Description of ObsluhaSession
 *
 * @author vlse2610
 */
class ObsluhaSession implements ObsluhaSessionInterface {
   
  //  const PARAM_SESSION_SPUSTENSPOUSTEC  = 'spustenSpoustec';   //value 'spustenSpoustec' , mysleno nas skript tj.spoustec
  //  const SESSION_PRIZNAK_TEST_SPUSTEN   = 'priznakTestSpusten';     //hodnota True = spusten  
    const SESSION_IDENTIFIKATOR_TESTU    = 'identifikatorTestu';  
    
    public $session;
 
    /**
     * 
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session) {
        $this->session = $session;       
    }           
    
      
//    /**
//     * Je spusten nejaky test (cosi, produkt) ?
//     * @return boolean
//     */
//     public function trvaTest() {          
//        $trva = $this->session->get(self::SESSION_PRIZNAK_TEST_SPUSTEN) ? TRUE : FALSE;
//        return  $trva; 
//     }
    
//    
//     public function nastavTestSpusten(){
//         $this->session->set(self::SESSION_PRIZNAK_TEST_SPUSTEN, TRUE);
//         return;
//         
//     }         
     
//     public function dejIdentifikatorTestu() {
//         $ident = $this->session->get(self::SESSION_IDENTIFIKATOR_TESTU) ? ($this->session->get(self::SESSION_IDENTIFIKATOR_TESTU)) : NULL;
//         return $ident;         
//     }
     
     public function trvaTest() {          
        $trva = $this->session->get(self::SESSION_IDENTIFIKATOR_TESTU) ? TRUE : FALSE;
        return  $trva; 
     }
    
     public function  nastavIdentifikatorTestuTrva($idn){
         $this->session->set(self::SESSION_IDENTIFIKATOR_TESTU, $idn);
         return;
         
     }    
     
  
}
