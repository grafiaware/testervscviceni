<?php
namespace Tester\Service;

use Tester\Model\Db\Dao\TicketPouzityDao;
use Tester\Model\Db\Dao as OdpovedRepo;
use Tester\Model\Db\RowObject as EntityRepo;

use Tester\Service\UkazTestServiceInterface;
use Tester\Validator\Ticket\IdentifikatorTicketuFormat;


/**
 * Description of SpustTest
 *
 * @author vlse2610
 */
class UkazTestService  implements UkazTestServiceInterface {

    private $ticketPouzityRepo;
    private $odpovedRepo;

    public function __construct( TicketPouzityDao $ticketPouzityRepo, OdpovedRepo\Odpoved $odpovedRepo ) {
        $this->ticketPouzityRepo = $ticketPouzityRepo;
        $this->odpovedRepo = $odpovedRepo;
    }
    
    /**
     * Vrací TRUE, ex-li záznam v tabulce odpoved a je v něm uložené sessionTabbedu.
     * 
     * @param type $idPrubehTestu
     * @param type $identifikatorTicketu
     * @return boolean
     * @throws \UnexpectedValueException
     */
    public function lzeUkazatTest( $idPrubehTestu , $identifikatorTicketu  ) {
//        // pouzity  ticket
//        if (!( (new IdentifikatorTicketuPouzity( $this->ticketPouzityRepo ))->isValid( $vstupniPrikaz->identifikatorTicketu )) ) {
//            throw new \UnexpectedValueException("Ticket již byl použit.");
//        }
        // format ticket
        if (!( (new IdentifikatorTicketuFormat())->isValid($identifikatorTicketu)) ) {
            throw new \UnexpectedValueException("Ticket nemá platný formát.");
        }
        
        //musi mit zaznam v tabulce odpoved 
        /* @var $odpoved EntityRepo\RowObjectOdpoved */
        $odpoved =  $this->odpovedRepo->getByPrubehTestuId( $idPrubehTestu ) ;
        if ( !$odpoved ) {
             throw new \UnexpectedValueException( "Neexistuje uložená odpověď odpoved pro požadovaný test (idPrubehTestu: "   . $idPrubehTestu .  ")" );
        }
        if ( !$odpoved->sessionTabbedu ) {
             throw new \UnexpectedValueException( "Neexistuje uložené prostředí session v uložené odpovědi požadovaného testu (idPrubehTestu: "   . $idPrubehTestu .  ")" );
        }
      
        
        
        return \TRUE;
    }

}
