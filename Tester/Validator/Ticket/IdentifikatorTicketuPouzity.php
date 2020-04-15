<?php
namespace Tester\Validator\Ticket;

use Tester\Model\Db\Dao\TicketPouzityDao;

/**
 * 
 */
class IdentifikatorTicketuPouzity  implements ValidatorInterface {
    
    private $ticketRepository;
    
    /**
     * 
     * @param TicketPouzityDao $ticketRepository
     */ 
    public function __construct( TicketPouzityDao $ticketRepository /*, konfogurace repository*/) {
        $this->ticketRepository = $ticketRepository;
    }
    
    
    /**
     * OK = false - ticket  uz byl pouzit,
     * OK = true - nepouzity (validni)
     * 
     * @param type $identifikatorTicketu
     * @return bool
     */
    public function isValid( $identifikatorTicketu ){
        $ok = ( ($this->ticketRepository->getByIdentifikatorTicketu($identifikatorTicketu)) !== null) ? \FALSE : \TRUE ;
                    // ok=false, tj. nasel ho v tabulce pouzitych (!== null),
                    // 
                    // 
                    // pak je na miste resit vicenasobnou pouzitelnost ticketu
                    // - nekde zadana konfigurace !ticketu jako vicekratPouzitelny ("druh" ticketu)
                    // rozmyslet , co zapsat do ticket_pouzity -  zapisovat pocet pouziti a kdy - ?
        
        
        return ($ok) ;
       //null !== expression
    }
}
