<?php
namespace Spoustec\Model;

use Spoustec\Service\ServiceRequestNaSpusteniInterface;
use Pes\Cryptor\CryptorInterface;

/**
 *
 * @author vlse2610
 */
interface PozadavekSpusteniInterface {
   
    public static function createFromRequest( ServiceInterface $SeReqSpusteni, CryptorInterface  $cryptor);
    
    public function getIdTicket();
}
