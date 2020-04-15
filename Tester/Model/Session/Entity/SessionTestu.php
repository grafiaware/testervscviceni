<?php
namespace Tester\Model\Session\Entity;

use Tester\Model\Session\Entity\EntityAbstract;

/**
 * Description of SpustenyTest
 *
 * @author vlse2610
 */
class SessionTestu extends EntityAbstract {
    
    // zde by teoreticky melo byt id teto entity pro identifikaci a pro rozhodovani zda insert nebo update
    // ale protoze mame jen jednu entitu, a vzdycky se zapisuje 'stejne' , tak tady vlastnost id teto entity neni    .
    //public $idSessionTestu;
    
    
    /**
     * Uchovávané informace o 'spustenem' = probihajicim testu, potřebné v příštím běhu skriptu (v jednom sezení).
     * Zapisují se do repository, v tomto případě session.
     */
    public $idDbEntityPrubehTestu;        
    
    public $testUkoncen = \NULL;
    
    public $testZahajen  = \NULL;
    

    
}
