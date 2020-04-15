<?php

namespace Spoustec\Service;

use Spoustec\Service\ObsluhaSessionInterface;
use Spoustec\Model\Session\SessionInterface;
use Spoustec\Cosi\CosiEnum;

/**
 * Description of ObsluhaSession
 *
 * @author vlse2610
 */
class ObsluhaSession  implements ObsluhaSessionInterface {
   
    const PARAM_SESSION_SPUSTENSPOUSTEC  = 'spustenSpoustec';   //value 'spustenSpoustec' , mysleno nas skript tj.spoustec
    const PARAM_SESSION_IDENTIFIKATOR    = 'identifikator';     //hodnota je pro test -  id_pozadavek
    const PARAM_SESSION_PRODUKT_STAV     = 'stavProduktu';      // 'bezi'/'skoncen'
    
    public $session;
 
    public function __construct(  SessionInterface $session) {
       
        $this->session = $session;       
    }           
    
    
    /**
     * Je to  opakovane nebo prvni spusteni skriptu ?  zjisteni podle session
     * @return boolean
    */
     public function jeSpustenSpoustec() {                  
        return $this->session->get(self::PARAM_SESSION_SPUSTENSPOUSTEC) ? TRUE : FALSE;
     }
    
     /**
      * Zjisti podle parametru v session o jaky produktCosi se jedna
      * 
      * return CosiEnum
      */
      public function zjistiCosiZParametru() {
          $s = '';
          if ($this->session->get('test')) { $s = 'test' ; }
          if ($this->session->get('video')) { $s = 'video' ; }
          
          switch ($s) {
            case 'test':  return CosiEnum::TEST;
            case 'video': return CosiEnum::VIDEO;              
          }  
      }
     
   
      
      public function saveSpusteniSpoustec () {
//          
//          TODO
          $this->session->set( self::PARAM_SESSION_SPUSTENSPOUSTEC, self::PARAM_SESSION_SPUSTENSPOUSTEC );
//      
//          
      }
     
     
     /**
     * Je spusten nejaky test (cosi, produkt) ?
     * @return boolean
    */
     public function jeSpustenProduktCosi() {            //jeSpustenProduktTest      
        return $this->session->get(self::PARAM_SESSION_IDENTIFIKATOR) ? TRUE : FALSE;
     }
     
     
     /**
      * 
      * @param type $idpar id tabulky pozadavek
      */
     public function saveZacatekCosi($idpozadavku) {
         $this->session->set(self::PARAM_SESSION_IDENTIFIKATOR, $idpozadavku);
     }
     
}
