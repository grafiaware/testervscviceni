<?php
namespace Spoustec\Model;

use Spoustec\Service\ServiceRequestNaSpusteniInterface;
use Pes\Cryptor\CryptorInterface;
use Spoustec\Model\PozadavekSpusteniInterface;

/**
 * Description of PozadavekSpust
 *
 * @author vlse2610
 * TOTIO NENI TABULKA ALE OBJEKT POZADAVEK SPUSTENI
 */
class PozadavekSpusteni implements PozadavekSpusteniInterface {      
   
   private $idTicket;
   
   private function __construct( $identifikatorTicket  ) {
       $this->idTicket = $identifikatorTicket;
   }
    
   
   public static function createFromRequest( ServiceInterface $SeReqSpusteni, CryptorInterface  $cryptor) {            
       // new static();   late binding - napred se instancuje objekt a pak se pripoji do promenne /ma vzynam pri vytvareni u dedenych objektu/       
       //rozsifrovat 
       $pomid = $cryptor->decrypt($SeReqSpusteni->dejParametrSkriptuIdentifikatorTicketu());
       $pozadavekSpusteni = new  self($pomid);
       //return $pozadavekSpusteni;
       
       
       return  new  self($cryptor->decrypt($SeReqSpusteni->dejParametrSkriptuIdentifikatorTicketu()));
   }
    
   
   public function getIdTicket() {
       return $this->idTicket;
   }


   
   
}
