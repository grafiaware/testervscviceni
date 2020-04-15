<?php
namespace Tester\Validator\Request;

use Pes\Http\RequestInterface;
use Pes\Http\RequestStatus;

/**
 *
 * @author vlse2610
 */
interface ValidatorInterface {
    
    public function isValid( RequestInterface $request);
        
}
