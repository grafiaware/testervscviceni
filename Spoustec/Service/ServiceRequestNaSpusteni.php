<?php
namespace Spoustec\Service;

use Spoustec\Service\ServiceRequestNaSpusteniInterface;
use Pes\Http\RequestInterface;


/**
 * Description of ObsluhaRequest
 *
 * @author vlse2610
 */
class ServiceRequestNaSpusteni implements ServiceInterface {
              
   const PARAM_GET_OZNACENI_TICKETU = 'oznaceni_ticketu';  //value asi cislo, hash, unique klic tabulky ticket
   private $request;
   

   public function __construct(  RequestInterface $request) {
     
        $this->request = $request;
   }           
    
    
     /**
     * Vrací označení ticketu, pro který je spouštěč volán. (napr. z GET promenne )
     * @return 
     */
    public function dejParametrSkriptuIdentifikatorTicketu() {
       //$this->request->getParam('jmenoPromene');
       $oT = $this->request->getParam(self::PARAM_GET_OZNACENI_TICKETU);               
      return isset($oT) ? $oT : NULL  ;
    } 
    
    public function dejMetoduRequestu() {
       //$this->request->getParam('jmenoPromene');             
        $m = $this->request->getMethod();
      return isset($m) ? $m : NULL  ;
    } 
    
    
}
