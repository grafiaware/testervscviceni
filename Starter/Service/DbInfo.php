<?php

/**
 * Služba - zabývá se informacemi databátového připojení
 *
 * @author vlse2610
 */
class Starter_Service_DbInfo {
  /**
   * 
   * Vrací jméno hostitele a jméno databáze použitého db připojení
   * @return array
   */
    public function getInfoDB() {
         $dbh = Starter_AppContext::getDb(); 
         $a['dbHost'] = $dbh->getDbHost() ;
         $a['dbName'] = $dbh->getDbName();
         return $a;         
    }
    
}
