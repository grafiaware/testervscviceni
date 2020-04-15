<?php
/**
 * Description of IsTypeValidator
 *
 * @author pes2704
 */
class Tester_Accessor_Validator_IsNaturalNumberValidator implements Tester_Accessor_Validator_ValidatorInterface {
    public function isValid($param) {
        if (is_numeric($param)) {
            $number = (int) $param;
            if ($number == $param) {  //integer
                if ($number > 0) {  
                    return TRUE;
                }
            }
        }
        return FALSE;
    }
}
