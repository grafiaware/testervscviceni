<?php


namespace Spoustec\Service;

/**
 *
 * @author vlse2610
 */
interface ObsluhaSessionInterface {
   
        
        public function jeSpustenSpoustec() ;
       //public function trvaSezeni() ;
         
        public function jeSpustenProduktCosi() ;
        
        public function zjistiCosiZParametru() ;

        
        public function saveSpusteniSpoustec () ;
                
        public function saveZacatekCosi($idpar)  ;
}
