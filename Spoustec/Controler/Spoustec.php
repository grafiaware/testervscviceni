<?php

namespace Spoustec\Controler;

use Spoustec\Cosi\CosiInterface;
//use Spoustec\Cosi\CosiEnum;

use Spoustec\Service\ObsluhaSessionInterface;
//use Spoustec\Service\ObsluhaSession;



/**
 * Description of Spoustec
 *
 * @author vlse2610
 */
class Spoustec implements SpoustecInterface {    
       
    private $obsluhaSession;
    private $cosi;
    
    /**
     * Kontroluje vstupenky a zda osoba, ktera je vpustena jeste kino neopustila, nebo kino neskoncilo
     * @param ObsluhaSessionInterface $obsluhaSession
     * @param PripravarInterface $cosi
     */
    public function __construct(  ObsluhaSessionInterface  $obsluhaSession, CosiInterface $cosi) {
      
        $this->obsluhaSession = $obsluhaSession;
        $this->cosi = $cosi;
    }
    
    public function spust(  ) {
        
        if ( !$this->obsluhaSession->jeSpustenSpoustec() ) {        //  nespusten  ([spustenSpoustec]  bezi,trva sezeni?  )
            $this->cosi->start();
            
            // do session ulozi, ze zacal test(produkt, cosi)
            $this->obsluhaSession->saveZacatekCosi($idpozadavek);   //ulozit do session 'test cosi - asi      
        
        }       
        
        else {      // spustenSpoustec
                  
            if ( $this->obsluhaSession->jeSpustenProduktCosi() ) {
                
            }                       
            else {
                //neeexistuje session['identifikator'] --chyba
                
//               TODO
                throw new \UnexpectedValueException( "Spusten Spoustec a nespusten produkt-cosi." ) ; 
                
                
            }  
        }
        
    }
}
