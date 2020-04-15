<?php
namespace Tester\Validator\Request;

use Pes\Http\RequestInterface;
use Pes\Http\RequestStatus;

use Tester\Validator\Request\ValidatorInterface;
use Tester\Model\Request\Entity\VstupniPrikazUkaz; 

/**
 * Description of InicializacniUkazTest
 *
 * @author vlse2610
 */
class InicializacniUkazTestRequest implements ValidatorInterface  {
    
    
    public function isValid( RequestInterface $request ) {
        if ((new RequestStatus())->isGet($request)){            
            
            $vstupniPrikazUkaz = new VstupniPrikazUkaz();            
            //prochazim vsechny vlastnosti entity Vstupni Prikaz Ukaz a zjistuji, zda jsou v requestu potrebne vlastnosti obsazene a naplnene.
            foreach ($vstupniPrikazUkaz as $key => $value) { 
                $tempom = $request->getParam( $key );
                
                if  (!$request->getParam( $key ) ) {
                    return FALSE;
                }                   
            }
            return TRUE;
                    
        } else  return  FALSE;
    }
    
}
