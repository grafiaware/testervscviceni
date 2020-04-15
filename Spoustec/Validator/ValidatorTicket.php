<?php
namespace Spoustec\Validator;

/**
 * Description of ValidatorTicket
 *
 * @author vlse2610
 */
class ValidatorTicket implements ValidatorInterface {
    
    public function isValid() {
        
        $OK = TRUE;
        $zprava = "";

        if (!$OK) {
              throw new \UnexpectedValueException( "Ticket není validní." );        }
        
//        assert( FALSE , "ValidatorPozadavek je prazdny") ;
        //return isset($oznaceni) ? TRUE : FALSE;
        return $OK;
    }
    
}
