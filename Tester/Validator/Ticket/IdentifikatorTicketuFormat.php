<?php
namespace Tester\Validator\Ticket;


/**
 * Description of TicketFormat
 *
 * @author vlse2610
 */
class IdentifikatorTicketuFormat  implements ValidatorInterface {
    
//    
//    public function __construct() {
//        ;
//    }
    
     public function isValid( $identifikatorTicketu ) {
        
        $is = is_string($identifikatorTicketu);
       
//        if (substr($identifikatorTicketu, 0, 1) != ('X')) {
//            return \FALSE; 
//        }
        
        return  $is;    
    }
    
}
