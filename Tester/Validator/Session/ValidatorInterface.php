<?php

namespace Tester\Validator\Session;
use Tester\Model\Handler\SessionInterface;
/**
 *
 * @author vlse2610
 */
interface ValidatorInterface {
    
    public function isValid(SessionInterface $sessionHandler);
        
}
