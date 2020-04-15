<?php

namespace Spoustec\Model\Session;

/**
 *
 * @author vlse2610
 */
interface SessionInterface {
    
    
    public function start () ;  
    
    
    public function set($name, $value);
    /**
     * 
     * @param type $name
     * @return SessionInterface 
     */
    public function get($name);
}
