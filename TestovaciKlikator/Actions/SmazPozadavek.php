<?php
/**
 * Description of SmazPozadavek
 *
 * @author pes2704
 */
class TestovaciKlikator_Actions_SmazPozadavek {
    public static function perform($idTest) {
        $dbh = TestovaciKlikator_AppContext::getDb();
        try{
            $dbh->beginTransaction();
            $commitFlag = TRUE;
            $querySelectIdPozadavek = "SELECT id_pozadavek FROM pozadavek WHERE kampane_id_vzb_osoba_kampan = :id";                
            $statementSelectIdPozadavek = $dbh->prepare($querySelectIdPozadavek);
            $statementSelectIdPozadavek->bindParam(':id', $idTest);
            $successSelectIdPozadavek =  $statementSelectIdPozadavek->execute();
            $resultSelectIdPozadavek =  $statementSelectIdPozadavek->fetch(PDO::FETCH_ASSOC);
            if (!$resultSelectIdPozadavek) {
                $commitFlag = FALSE;
                $messages[] =  "Nenalezen požadavek v db.";            
            } else {
                $queryDeleteOdpoved = "DELETE FROM odpovedi WHERE id_pozadavek_fk = :id";                
                $statementDeleteOdpovedi = $dbh->prepare($queryDeleteOdpoved);
                $statementDeleteOdpovedi->bindParam(':id', $resultSelectIdPozadavek['id_pozadavek']);
                $successDeleteOdpovedi = $statementDeleteOdpovedi->execute();
                $queryDeleteRequest = "DELETE FROM request WHERE id_pozadavek_fk = :id";                
                $statementDeleteRequest = $dbh->prepare($queryDeleteRequest);
                $statementDeleteRequest->bindParam(':id', $resultSelectIdPozadavek['id_pozadavek']);
                $successDeleteRequest = $statementDeleteRequest->execute();
                $queryDeletePozadavek = "DELETE FROM pozadavek WHERE kampane_id_vzb_osoba_kampan = :id";                
                $statementDeletePozadavek = $dbh->prepare($queryDeletePozadavek);
                $statementDeletePozadavek->bindParam(':id', $idTest);
                $successDeletePozadavek = $statementDeletePozadavek->execute();
                if (!$successDeletePozadavek) {
                    $messages[] =  "Nepodařilo se smazat požadavek z db.";                                
                    $commitFlag = FALSE;
                }    
            }
        } catch(PDOException $e) {
            $messages[] =  "SQL Error Message:  " . $e->getMessage();
            $commitFlag = FALSE;
        }
        if(!$commitFlag){
            $dbh->rollback();
            $messages[] =  "Selhalo smazání požadavku z databáze tester.";            
        } else {
            $dbh->commit();
            $messages[] = 'Smazáno záznamů '.$statementDeleteOdpovedi->rowCount().' z tabulky odpovedi.';
            $messages[] = 'Smazáno záznamů '.$statementDeleteRequest->rowCount().' z tabulky request.';
            $messages[] = 'Smazáno záznamů '.$statementDeletePozadavek->rowCount().' z tabulky pozadavek.';
            $messages[] = 'Záznamy v db tabulkách smazány.';
        }
        return $messages;        
    }
}
