<?php
/**
 * Služba kontroluje správnost přihlašovacích informací podle dat v databázi.
 *
 * @author pes2704
 */
class Starter_Service_SigninInfoChecker {
    
    private $message;
    
    /**
     * Přijímá data odeslaná formulářem Prihlas a ověří exitenci právě jednoho záznamu s id testu, příjmením a jménem v databázi. 
     * Předpokládá existenci databázového pohledu, který potřebné informace obsahuje.
     * Pokud kontrola selže a není nalezen záznam odpovídající plně zadaným kritériím, metoda se pokusí odhadnout možnou příčinu selhání
     * a interně uloží hlášení o možné příčině. Toto hlášení je možné následně získat voláním metody getLastMessage().
     * 
     * @param type $post
     * @return boolean 
     * @throws LogicException Při nekonzistenci dat v databázi
     */
    public function check($post) {

        extract($post);
        $this->message = '';
        $countByCriteria = $this->countByCriteria($idtest, $prijmeni, $jmeno);
        switch ($countByCriteria) {
            case 1:
                return TRUE;
                break;
            case 0:
                $foundById = $this->findById($idtest);
                switch (count($foundById)) {
                    case 0:
                        $this->message = 'Neexistuje toto číslo testu.';
                        return FALSE;
                        break;
                    case 1:
                        $foundByIdPrijmeni = $this->findByIdPrijmeni($idtest, $prijmeni);
                        $foundByIdJmeno = $this->findByIdJmeno($idtest, $jmeno);
                        if (count($foundByIdPrijmeni)>1 OR count($foundByIdJmeno)>1) {
                            throw new LogicException('Došlo k chybě. Nalezeno více záznamů při vyhledávání dle id a jména nebo příjmení. Kontaktujte administrátora.');
                        }
                        if ($foundByIdPrijmeni) {
                            $preklepy = $this->prehozy($foundByIdPrijmeni[0], 'jmeno', $jmeno);
                            if ($preklepy<3) {
                                $this->message = 'Možná máte překlep ve jméně.';
                            } else {
                                $this->message = 'Neznámá osoba.';
                            }
                        } elseif ($foundByIdJmeno) {
                            $preklepy = $this->prehozy($foundByIdJmeno[0], 'prijmeni', $prijmeni);
                            if ($preklepy<3) {
                                $this->message = 'Možná máte překlep v příjmení.';
                            } else {
                                $this->message = 'Neznámá osoba.';
                            }                          
                        } else {
                                $this->message = 'Neexistuje toto číslo testu pro zadanou osobu.';
                        }                            
                        return FALSE;
                        break;
                    default:
                        throw new LogicException('Došlo k chybě. Nalezeno více záznamů při vyhledávání dle id. Kontaktujte administrátora.');
                        break;
                }
                break;
            default:
                throw new LogicException('Došlo k chybě. Nalezeno více záznamů podle zadaných kritérií. Kontaktujte administrátora.');
                break;
        }
                
    }
    
    private function prehozy($pole, $index, $value) {
        return isset($pole[$index]) ? levenshtein($pole[$index], $value, 1, 1.1, 1) : -1;
    }
    
    /**
     * Vrací poslední uložené hlášení o možné příčině selhání kontroly metodou check().
     * @return type
     */
    public function getLastMessage() {
        return $this->message;
    }
    
    /**
     * Vrací počet záznamů odpovídajících id testu, příjmení a jménu v databázovém pohledu.
     * 
     * @param type $idTest id testu - id vazební tabulky vzb_osoba_kampan (tedy id_vzb_osoba_kampan)
     * @param type $prijmeni příjmení osoby - sloupec prijmeni z tabulky osoba_central
     * @param type $jmeno jméno osoby - sloupec jmeno z tabulky osoba_central
     * @return integer
     */
    private function countByCriteria($idTest, $prijmeni, $jmeno) {
        $dbh = Starter_AppContext::getDb();        
        $query = "SELECT id_vzb_osoba_kampan, prijmeni, jmeno
                        FROM view_kampane_2
                        WHERE id_vzb_osoba_kampan = :id AND prijmeni = :prijmeni AND jmeno = :jmeno";                  
        $select =  $dbh->prepare($query);
        $select->bindParam(':id', $idTest);
        $select->bindParam(':prijmeni', $prijmeni);
        $select->bindParam(':jmeno', $jmeno);
        $success = $select->execute();
        return $select->rowCount(); 
    }
    
    /**
     * Vrací počet záznamů odpovídajících id testu v databázovém pohledu.
     * 
     * @param type $idTest id testu - id vazební tabulky vzb_osoba_kampan (tedy id_vzb_osoba_kampan)
     * @return array Pole všech nalezených řádků v databázovém pohledu
     */
    private function findById($idTest) {
        $dbh = Starter_AppContext::getDb();        
        $query = "SELECT id_vzb_osoba_kampan, prijmeni, jmeno
                        FROM view_kampane_2
                        WHERE id_vzb_osoba_kampan = :id";                  
        $select =  $dbh->prepare($query);
        $select->bindParam(':id', $idTest);
        $successViewKampane = $select->execute();        
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Vrací počet záznamů odpovídajících id testu a příjmení v databázovém pohledu.
     * 
     * @param type $idTest id testu - id vazební tabulky vzb_osoba_kampan (tedy id_vzb_osoba_kampan)
     * @param type $prijmeni příjmení osoby - sloupec prijmeni z tabulky osoba_central
     * @return array Pole všech nalezených řádků v databázovém pohledu
     */
    private function findByIdPrijmeni($idTest, $prijmeni) {
        $dbh = Starter_AppContext::getDb();        
        $query = "SELECT id_vzb_osoba_kampan, prijmeni, jmeno
                        FROM view_kampane_2
                        WHERE id_vzb_osoba_kampan = :id AND prijmeni = :prijmeni";                  
        $select =  $dbh->prepare($query);
        $select->bindParam(':id', $idTest);
        $select->bindParam(':prijmeni', $prijmeni);
        $success = $select->execute(); 
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Vrací počet záznamů odpovídajících id testu a jménu v databázovém pohledu.
     * 
     * @param type $idTest id testu - id vazební tabulky vzb_osoba_kampan (tedy id_vzb_osoba_kampan)
     * @param type $jmeno jméno osoby - sloupec jmeno z tabulky osoba_central
     * @return array Pole všech nalezených řádků v databázovém pohledu
     */
    private function findByIdJmeno($idTest, $jmeno) {
        $dbh = Starter_AppContext::getDb();        
        $query = "SELECT id_vzb_osoba_kampan, prijmeni, jmeno
                        FROM view_kampane_2
                        WHERE  id_vzb_osoba_kampan = :id AND jmeno = :jmeno";                  
        $select =  $dbh->prepare($query);
        $select->bindParam(':id', $idTest);        
        $select->bindParam(':jmeno', $jmeno);
        $success = $select->execute(); 
        return $select->fetchAll(\PDO::FETCH_ASSOC);      
    }
    
}
