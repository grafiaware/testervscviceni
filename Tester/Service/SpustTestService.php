<?php
namespace Tester\Service;

use Tester\Model\Db\Dao\TicketPouzityDao;
use Tester\Validator\Ticket\IdentifikatorTicketuPouzity;
use Tester\Validator\Ticket\IdentifikatorTicketuFormat;
use Tester\Service\SpustTestServiceInterface;


/**
 * Description of SpustTest
 *
 * @author vlse2610
 */
class SpustTestService  implements SpustTestServiceInterface {

    private $ticketPouzityRepo;

    public function __construct(TicketPouzityDao $ticketPouzityRepo ) {
        $this->ticketPouzityRepo = $ticketPouzityRepo;
    }
    
    
    /**
     * Kontroluje, zda ticket nebyl jiz použit, zda ticket ma platný format.
     * 
     * @param type $uidKonfiguraceTestu
     * @param type $identifikatorTicketu
     * @return boolean
     * @throws \UnexpectedValueException
     */
    public function lzeSpustitTest(  $uidKonfiguraceTestu, $identifikatorTicketu ) {
        // pouzity  ticket
        if (!( (new IdentifikatorTicketuPouzity( $this->ticketPouzityRepo ))->isValid( $identifikatorTicketu )) ) {
            throw new \UnexpectedValueException("Ticket již byl použit.");
        }
        // format ticket
        if (!( (new IdentifikatorTicketuFormat())->isValid($identifikatorTicketu)) ) {
            throw new \UnexpectedValueException("Ticket nemá platný formát.");
        }
       
        return TRUE;
    }

}
