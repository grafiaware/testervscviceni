<?php


namespace Tester\Service;

/**
 *
 * @author vlse2610
 */
interface RequeServiceInterface {
    
 
    public function getOznaceniZadostiZGET();
    public function getOznaceniZadostiZSession();

    public function isFirstRequestPodleSession();
    public function isPlatnaRundaPodleSession();
    
    public function isPostMethod() ;
    
    public function isRequestQuickFormGet();

    
}
