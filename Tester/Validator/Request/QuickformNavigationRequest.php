<?php
namespace Tester\Validator\Request;

use Pes\Http\RequestInterface;
use Pes\Http\RequestStatus;

/**
 * Description of QuickformRequest
 *
 * @author vlse2610
 */
class QuickformNavigationRequest implements ValidatorInterface {
    
    
    /**
     * Kontroluje pritomnost _qf post parametru v request a současně nepřítomost parametru ve formátu '_qf_XX_submit'.
     * Submit tlačítko odešle POST s jedním parametrem ve formátu '_qf_XX_submit', kde XX je index stránky, na které byl zmáčknut submit.
     * Navigační tlačítko odešle POST s parametry ve formátu '_qf_XX', kde XX jsou indexy stránek.
     * 
     * @param RequestInterface $request
     * @return boolean
     */
    public function isValid( RequestInterface $request ) {       
        if ( (new RequestStatus())->isPost($request) ) {
                    
            $postParamsKeys = array_keys($request->getParsedBody());
            $prefix = '_qf';
            $postfix = 'submit';
            $postfixLength = 6;
            $retQf = array_filter($postParamsKeys, function($var) use ($prefix, $postfix, $postfixLength){
                                                        return strpos($var, $prefix) !== false;
                                                    }  
                                           );
            return (isset($retQf) AND count($retQf)) AND !((new QuickformSubmitRequest())->isValid($request)) ? TRUE : FALSE;
        
        } else return FALSE;
    }
}
