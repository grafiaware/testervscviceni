<?php

namespace Spoustec\Model\Session;

/**
 * Description of Session
 *
 * @author vlse2610
 */
 class  Session implements SessionInterface {
         
    public function __construct( ) {  
                 
    }
    
    
     public function start () {
         if (session_status() == \PHP_SESSION_NONE) {
             session_start();         // obnoveni  drive ulozenych dat, vzkrisi pole $_SESSION           
         }
     }
        
    public  function get($name) {        
        return  isset($_SESSION [$name]) ? $_SESSION [$name] : NULL;        
    }    
    
    /**
     * 
     * @param type $name
     * @param type $value
     * @return $this
     */
    public  function set($name, $value) {
        $_SESSION [$name] = $value;
        return $this;       //fluent interface
        //return ;        //navrat.hodnota void
    } 
    
}
