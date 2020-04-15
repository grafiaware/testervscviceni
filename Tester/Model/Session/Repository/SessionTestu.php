<?php
namespace Tester\Model\Session\Repository;

use Tester\Model\Session\Entity as SessionEntity ;
use Pes\Session\SessionStatusHandlerInterface;


/**
 * Description of StavTestu
 *
 * @author vlse2610
 */
class SessionTestu implements RepositorySessionTestuInterface {

    const NAME_PERSISTED      =  'persisted';   

    private $sessionHandler;


    public function __construct( SessionStatusHandlerInterface $sessionHandler ) {

        $this->sessionHandler = $sessionHandler;
    }

    /**
     * Z uloziste v session vyzvedne ulozene informace (napr. id prubehu testu, a ostatni vlastnosti) a znovuvytvori objekt
     * (pozn. pro trdla - vytvori pro tento beh skriptu  novy objekt)  typu  Tester\Model\Session\Entity\SessionTestu.
     * (Vlastnosti neulozene naplni null, vlastnosti s hodnotou false naplni false.)
     * Nema-li z ceho vytvorit (neni nstavena promenna 'persisted'), vraci NULL.
     *
     * @return SessionEntity\SessionTestu $entity
     */
    public function get() {
        ######## nemame vice id v session   ####### MY MAME JEN JEDNO ULOZISTE SESSION/STAV #######

        if( $this->sessionHandler->get(self::NAME_PERSISTED) ) {

            $entity = new SessionEntity\SessionTestu();
            foreach ($entity as $key => $value) {
                //if ( $this->sessionHandler->has($key) ) {
                    $entity->$key = $this->sessionHandler->get($key);
                //}
                $entity->setPersisted(TRUE);

            }
        }
        return $entity ?? NULL;
    }

    
    
    /**
     * Do uloziste v session  -   ulozi  vlastnosti stav prubeh testu (napr.$idDbEntityPrubehTestu, testUkoncen).      
     * @param Tester\Model\Session\Entity\SessionTestu $sessionTestu
     */
    public function add( SessionEntity\SessionTestu $sessionTestu ){
        foreach ($sessionTestu as $key => $value) {
            $this->sessionHandler->set($key, $value);
        }
        
        $this->sessionHandler->set(self::NAME_PERSISTED, TRUE);  //nastaveni persisted do session
        $sessionTestu->setPersisted( TRUE);  // nastaveni do entity ///

    }




    /**
     * Z uloziste v session  'odstraní' chlivecek persisted.
     * To znamena, ze entita v session "neni".
     */
    public function remove( SessionEntity\SessionTestu $sessionTestu ) {
        $this->sessionHandler->set(self::NAME_PERSISTED, null); // nastaveni do session
        $sessionTestu->setPersisted(FALSE);  // nastaveni do entity
    }

}
