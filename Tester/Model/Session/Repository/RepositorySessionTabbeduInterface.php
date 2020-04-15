<?php
namespace Tester\Model\Session\Repository;

use Tester\Model\Session\Entity\SessionTabbedu;

/**
 *
 * @author vlse2610
 */
interface RepositorySessionTabbeduInterface {

    public function get();
    
    public function add( SessionTabbedu $stavEntity );
    
    public function remove ( SessionTabbedu $stavEntity );
}
