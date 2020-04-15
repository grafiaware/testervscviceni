<?php
namespace Tester\Validator\Request;

use Pes\Http\RequestInterface;
use Pes\Http\RequestStatus;

/**
 * Description of QuickformRequest
 *
 * @author vlse2610
 */
class DikGetRequest implements ValidatorInterface {
    
    /**
     *      
     * 
     * @param RequestInterface $request
     * @return boolean
     */
    public function isValid(RequestInterface $request) {    
        if ((new RequestStatus())->isGet($request)){      
            
            $getParams = $request->getQueryParams();
            $needle = 'dik';
            $input = array_keys($getParams);            
            $ret = in_array( $needle , $input  );
            if (isset($ret) AND count($ret)) {
               return TRUE;
            }    
            else return FALSE; 
            
        } else return FALSE;
    }
    
}
