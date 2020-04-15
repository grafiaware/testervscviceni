<?php
namespace Tester\Validator\Session;

use Tester\Model\Handler\SessionInterface;
//use Tester\Model\Session\Entity as SessionEntity;
//use Tester\Model\Session\Repository as SessionRepo;

/**
 * Description of TrvaTest
 *
 * @author vlse2610
 */
class __TestNejakyZacalATrva implements ValidatorInterface {    
       
    
    /** 
     * Pokud promenna sessTrva v session *existuje*, pak sezeni trva.
     * 
     * @param SessionInterface $sessionHandler
     * @return boolean
     */
    public function isValid( SessionInterface $sessionHandler ) {
        
        $trva = $sessionHandler->hasNejakyTestTrva();              
        $valid = FALSE;
        if ($trva) {       
            $valid = TRUE;
            
//            $entity = new SessionEntity\SpustenyTest();
//            foreach ($entity as $key => $value) {
//                $pom1 = $sessionHandler->get($key);
//                if ( !isset($pom1) ) {
//                    $valid = FALSE;    
//                }                              
//            }
            
        }
        return $valid;
    }
    
        
}
