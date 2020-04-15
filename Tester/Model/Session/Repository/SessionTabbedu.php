<?php
namespace Tester\Model\Session\Repository;

use Tester\Model\Session\Entity\SessionTabbedu as SessionTabbeduEntity;
use Pes\Session\SessionStatusHandlerInterface;


/**
 * Description of StavTestu
 *
 * @author vlse2610
 */
class SessionTabbedu implements RepositorySessionTabbeduInterface {
    
    const TABBED_CONTAINER = '_Tabbed_container';

    private $sessionHandler;         
    
    
    /**
     * 
     * @param SessionStatusHandlerInterface $sessionHandler .  Ovládá  naše sessionová data. Při běhu jsou globálně  v poli $_SESSION.
     */
    public function __construct( SessionStatusHandlerInterface $sessionHandler ) {
        
        $this->sessionHandler = $sessionHandler;                    
    }
        
    /**
     * Vrací entitu Entity. Vezme ji ze session
     * @return SessionTabbeduEntity
     */
    public function get() {
        $tabbedSessionData = $this->sessionHandler->get(self::TABBED_CONTAINER);
        if($tabbedSessionData) {              
            $entity = new SessionTabbeduEntity();
            $entity->tabbedSessionData = $tabbedSessionData;
            $entity->setPersisted(TRUE);
        }
        return $entity ?? NULL;  
    }
    
    /**
     * Přidá entitu Entity do repository. Pokud již entita v repository je, přepíše ji novou entitou.
     * @param SessionTabbeduEntity $sessionTabbedu
     */
    public function add( SessionTabbeduEntity $sessionTabbedu ){
        $this->sessionHandler->set(self::TABBED_CONTAINER, $sessionTabbedu->tabbedSessionData );            
        $sessionTabbedu->setPersisted( TRUE);  // nastaveni do entity ///  
        
    }
    
    /**
     * Smaže entitu SessionTabbeduEntity $sessionTabbedu z repository (session) a 
     * objekt SessionTabbeduEntity nastavi na persistet = false.
     * 
     * @param SessionTabbeduEntity $sessionTabbedu
     */
    public function remove( SessionTabbeduEntity $sessionTabbedu ) {
        //$this->sessionHandler->set(self::TABBED_CONTAINER, null); // nastaveni do session
        $this->sessionHandler->delete(self::TABBED_CONTAINER); 
        $sessionTabbedu->setPersisted(FALSE);  // nastaveni do entity 
    }

}
