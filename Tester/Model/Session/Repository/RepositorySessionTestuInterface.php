<?php
namespace Tester\Model\Session\Repository;

use Tester\Model\Session\Entity\SessionTestu;

/**
 *
 * @author vlse2610
 */
interface RepositorySessionTestuInterface {

    public function get();
    
    public function add (SessionTestu $stavEntity );
    
    public function remove (SessionTestu $stavEntity );
}
