<?php

namespace Tester\Validator\Session;

use Tester\Model\Handler\SessionInterface;
use Tester\Model\Session\Entity as StavEntity;
use Tester\Model\Session\Repository as SessionRepo;

/**
 * Description of TrvaTest
 *
 * @author vlse2610
 */
class TestUkoncen implements ValidatorInterface {    
       
         
    /**
     * 
     * Pokud vlastnost testUkoncen objektu session v session *existuje*, pak sezeni trva.
     * 
     * @param SessionInterface $sessionHandler
     * @return boolean
     */
    public function isValid( SessionInterface $sessionHandler ) {
        
        $ukoncen = $sessionHandler->get(SessionRepo\StavTestu::NAME_TESTUKONCEN);
       
        $valid = FALSE;
        if ($ukoncen) {       
            $valid = TRUE;
        }
        return $valid;
    }
    
        
}
