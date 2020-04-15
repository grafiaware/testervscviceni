<?php
namespace Tester\Validator\Request;

use Pes\Http\RequestInterface;
use Pes\Http\RequestStatus;

/**
 * Description of QuickformRequest
 *
 * @author vlse2610
 */
class QuickformGetRequest implements ValidatorInterface {
    
    /**
     * Kontroluje pritomnost _qf query parametru v request.     
     * 
     * @param RequestInterface $request
     * @return boolean
     */
    public function isValid(RequestInterface $request) {
        if ((new RequestStatus())->isGet($request)){              
        
            $getParams = $request->getQueryParams();
            $needle = '_qf';
            $input = array_keys($getParams);            
            $ret = array_keys(array_filter($input, function($var) use ($needle){return strpos($var, $needle) !== false;}  ));
            if (isset($ret) AND count($ret)) {
               return TRUE;
            }    
            else return FALSE; 
            
        } else return FALSE;                         
        
    }
}
