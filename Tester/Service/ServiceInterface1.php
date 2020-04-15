<?php
namespace Tester\Service;

/**
 *
 * @author vlse2610
 */
interface ServiceInterface1 {
     
    /**
     * Pta se, zda test trva (v session na promennou self::SESSION_TEST_TRVA)
     * @return bool Vraci TRUE/FALSE .
     */
    public function trvaTest(): bool ;   
    
    /**
     * Nastavuje TRUE
     * @return ServiceInterface
     */   
    public function nastavTestTrva(): ServiceInterface;
    
    /**
     * Zruší v session self::SESSION_TEST_TRVA
     * @return ServiceInterface
     */
    public function nastavTestNetrva() : ServiceInterface;    
    
    
    public function dejIdentifikatorSpustenehoTestuZeSession() : string ; 
    
    public function jeMetodaRequestuGET() : bool;
    public function jeMetodaRequestuPOST() : bool;
                   
    public function jeMetodaRequestuGETzQuickformu() : bool;
    public function jeMetodaRequestuPOSTzQuickformu() : bool;

    public function jeInicializacniGet() : bool;
    
    
    /**
     * Vrací označení ticketu z GET promenne nebo NULL.
     * @return varchar
     */
    public function dejIdentifikatorTicketuZGET() : string ;  
    
    
    /**
     * Vrací označení konfigurace testu z GET promenne nebo NULL.
     * @return varchar
     */    
    public function dejIdentifikatorKonfiguraceTestuZGET() : string ;           
      
    
    /**
     * Vrací označení konfigurace testu. (napr. z GET promenne, nebo session ). 
     * Vrati NULL, pokud nenalezne ve vyse uvedenych mistech.
     * @return varchar
     */    
    public function dejIdentifikatorKonfiguraceTestu() : string ;
   
}
