<?php
/**
 * Služba - zabývá se  informacemi obsaženými v pohledu view_kampane_2.
 *
 * @author pes2704
 */
class Starter_Service_Kampane {
    /**
     * Metoda čte z databáze informace obsažené v pohledu view_kampane_2 pro zadaný požadavek.
     * @param integer $idTest id reprezentujici požadavek (id tabulky vzb_osoba_kampan)
     * @return array
     */
    public function getInfo($idTest) {
        $dbh = Starter_AppContext::getDb();        
        $query = "SELECT id_vzb_osoba_kampan, id_kampan_fk, id_osoba_fk, datumcas_odeslani, 
                        kampan_nazev, kampan_datum, kampan_popis, prijmeni, jmeno, 
                        test_nazev, test_jmeno_souboru, zakaznik_nazev
                        FROM view_kampane_2
                        WHERE id_vzb_osoba_kampan = :id";                  
        $statementViewKampane =  $dbh->prepare($query);
        $statementViewKampane->bindParam(':id', $idTest);              
        
        return $statementViewKampane->execute() ? $statementViewKampane->fetch(\PDO::FETCH_ASSOC) : NULL;  
    }
    
  
    
}
