<?php
/**
 * Description of ZkontrolujIdTest
 *
 * @author pes2704
 */
class TestovaciKlikator_Actions_ZkontrolujIdTest {
    public static function perform($idTest) {
        $dbh = TestovaciKlikator_AppContext::getDb();        
        $query = "SELECT id_vzb_osoba_kampan, kampan_nazev, test_jmeno_souboru, test_nazev, zakaznik_nazev
                        FROM view_kampane_2
                        WHERE id_vzb_osoba_kampan = :id";                  
        $statementViewKampane =  $dbh->prepare($query);
        $statementViewKampane->bindParam(':id', $idTest);
        $successViewKampane = $statementViewKampane->execute();
        $countOfOsobaKampan = $statementViewKampane->rowCount();     
        if ($countOfOsobaKampan===0) {
            $messages[] = "Neexistuje zadané idTestu (id_vzb_osoba_kampan): ".$idTest;
            $idTest = NULL;
        }        
    }
}
