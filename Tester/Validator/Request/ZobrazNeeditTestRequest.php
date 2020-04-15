<?php
namespace Tester\Validator\Request;

use Pes\Http\RequestInterface;
use Pes\Http\RequestStatus;

/**
 * Description of QuickformRequest
 *
 * @author vlse2610
 */
class ZobrazNeeditTestRequest implements ValidatorInterface {
    
    /**
     *      
     * 
     * @param RequestInterface $request
     * @return boolean
     */
    public function isValid(RequestInterface $request) {
        $getParams = $request->getQueryParams();       
        $input = array_keys($getParams);      
        
        $needle = 'zmrz';              
        $ret1 = in_array( $needle , $input  );               
        $needle = 'idTest';
        $ret2 = in_array( $needle , $input  );
        
        if ((isset($ret1) AND count($ret1))  and  (isset($ret2) AND count($ret2))  ) { 
           return TRUE; }    
        else { 
           return FALSE;            
        }  
        
    }
}
