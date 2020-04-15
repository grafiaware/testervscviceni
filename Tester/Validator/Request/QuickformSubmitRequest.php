<?php
namespace Tester\Validator\Request;

use Pes\Http\RequestInterface;
use Pes\Http\RequestStatus;

/**
 * Description of QuickformRequest
 *
 * @author vlse2610
 */
class QuickformSubmitRequest implements ValidatorInterface {
    
    
    /**
     * Kontroluje pritomnost _qf submit post parametru v requestu.
     * Submit tlačítko odešle POST s jedním parametrem ve formátu '_qf_XX_submit', kde XX je index stránky, na které byl zmáčknut submit.
     * 
     * @param RequestInterface $request
     * @return boolean
     */
    public function isValid( RequestInterface $request ) {
        if ( (new RequestStatus())->isPost($request) ) {      
            
            $postParamsKeys = array_keys($request->getParsedBody());
            // submit tlačítko odešle POST s jedním parametrem ve formátu '_qf_XX_submit', kde XX je index stránky, na které byl zmáčknut submit
            $prefix = '_qf';
            $postfix = 'submit';
            $postfixLength = 6;
            $ret = array_filter($postParamsKeys, function($var) use ($prefix, $postfix, $postfixLength){
                                 return strpos($var, $prefix) !== false AND strrpos($var, $postfix) == strlen($var)-$postfixLength;
                                                    }  
                                           );
            return (isset($ret) AND count($ret)) ? TRUE : FALSE;
        }    
    }
}
