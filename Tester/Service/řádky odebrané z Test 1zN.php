
###########  VALIDACE IDENTIFIKÁTORU -  ################################
if (isset($identifikace_parametr_test_zGETu) AND $identifikace_parametr_test_zGETu ) {  // identifikace je v GET
     //echo '<br/>Je argument [identifikace] ' . $identifikace_parametr_test_zGETu . ' <br/>' ;
    
     if ( !(isset($_SESSION["identifikace"])) ) {  // identifikace není v SESSION -> OK
        $debug[] = 'Je argument [identifikace]: ' . $identifikace_parametr_test_zGETu . 
                   'není v session [identifikace] ---> prvni spusteni v prohlizeci s argumentem';                                          
        $_SESSION['identifikace'] = $identifikace_parametr_test_zGETu;
        $idValidni = $identifikace_parametr_test_zGETu;    
     }
     else {  //identifikace je v SESSION a je i v GETu -> CHYBA
         $debug[] = 'Je argument [identifikace] ' . $identifikace_parametr_test_zGETu . 
              'je i v session [identifikace]: ' . $_SESSION["identifikace"]. ' ----> tzn. uz sla runda kolem<br/>' ;         
         $debug[] = "Chyba parametru skriptu - opakovane spusteni! - je parametr a je i  v session - spoustim v otevrenem prohlizeci opakovane";                                    
         $die[] ="Váš test můžete spustit pouze jednou!"; 
     }
             
}
else {    // identifikace není v GETu
    if (($requestMethod=='POST' OR $requestQuickformGet) AND isset($_SESSION["identifikace"]) ) {  // ... a je v SESSION -> OK
        $debug[] = 'Neni argument [identifikace] , ale je  v session [identifikace]: ' . $_SESSION["identifikace"]. ' ---- tzn. uz sla runda kolem<br/>' ;
        $idValidni = $_SESSION["identifikace"];
    }
    else {                                      //... a neni ani v SESSION -> CHYBA 
        $debug[] =' Neni argument [identifikace] a neni ani  v session [identifikace]';
        $die[] = "Test je možno spouštět pouze kliknutím na odkaz ve vašem e-mailu.";
    }    
}

//--------------- KONTROLA zda idValidni je take existujici 
if (isset($idValidni)) {  
// // ***kampane_2 nacteni informaci z DB z pohledu view_kampane_2
    $query = "SELECT id_vzb_osoba_kampan ,test_jmeno_souboru, test_nazev, zakaznik_nazev
                FROM view_kampane_2
                WHERE 
                id_vzb_osoba_kampan = :idValidni";               
   
    $statt = $dbh->prepare($query);
    $statt->bindParam(':idValidni', $idValidni);
    $succ = $statt->execute();
    $pp = $statt->rowCount();     
                        
    //zjistit kolikrat ji nasel - vicenez jedenkrat nebo vubec      
    if ($pp!==1) {
        $idValidni = NULL;
        $die[] = "Nemáte přístup k testu! Chyba při čtení z tabulky (pohledu)  -  neznámý přístup!";
    } else {                             
        $prectena_veta_z_view_kampane_2 =  $statt->fetch(PDO::FETCH_ASSOC);
    }
}
    //------zde jiz vim, ze pristup.udaj existuje a nacetl jsem udaje  z kampan_2
    //

if (isset($idValidni)) {  

    //------zapsat do pozadavek, tady nikdy neni jeste zapsano  -- 
    //-- je nutno zapsat
            //==============================================
            //========== zapis pozadavku ===================
            //==============================================
    ###########  KONTROLA opakovaneho pristupu A zápis do požadavků  ######################################      
        $query = "SELECT id_pozadavek, kampane_id_vzb_osoba_kampan,  otisk
            FROM pozadavek                 
            WHERE 
            kampane_id_vzb_osoba_kampan = :idValidni";                
        $statSelect = $dbh->prepare($query);
        $statSelect->bindParam(':idValidni', $idValidni);
        $succ = $statSelect->execute();
        if (!$succ) {
            $die[] = "Chyba při čtení z tabulky požadavek!"; 
        }
        if ($requestMethod=='GET' AND $identifikace_parametr_test_zGETu) {
            $pp = $statSelect->rowCount();            

            if ($pp > 0) {
                $die[] = "Nemáte přístup! Chyba při čtení z tabulky požadavek  - násobný přístup! Test lze spustit pouze jednou!";
            } else {
                $query = "INSERT INTO pozadavek " .
                         "SET kampane_id_vzb_osoba_kampan  = :idValidni, inserted = now()" ;                                
                $statInsert = $dbh->prepare($query);
                $statInsert->bindParam(':idValidni', $idValidni);
                $succInsert = $statInsert->execute(); 
                $succ = $statSelect->execute();
                $prectena_veta_z_pozadavek =  $statSelect->fetch(PDO::FETCH_ASSOC);
            }
        } else { //POST nebo GET při přepínání stránek formuláře
            $prectena_veta_z_pozadavek =  $statSelect->fetch(PDO::FETCH_ASSOC);
        }
    }            

// ------------KONTROLA proti  otisku  -------------------------------------------------------          
//-----------------------------------------------------------------------------------------           
 if ($requestMethod=='POST' OR $requestQuickformGet) { 
    // zda v session je otisk stejny jako v tabulce, kdyz ne tak die
    if ( isset($_SESSION["otisk"]) ){ 
        if ( $_SESSION["otisk"] != $prectena_veta_z_pozadavek['otisk'] ) {  
            $debug[] = 'Test byl již v minulosti spuštěn. Pokoušíte se nekorektně spustit test znovu.';
            $die[] = "Test je možno spouštět pouze kliknutím na odkaz ve vašem e-mailu.";  
        }
    }  else { // otisk neni v session - Nekorektni spusteni!
        $die[] = "Nekorektní spuštění! - Test je možno spouštět pouze kliknutím na odkaz ve vašem e-mailu."; 
    }
}  

if (!$die) {
    $kontrolaOK = TRUE;
} else {
    $kontrolaOK = FALSE;
}
// 
// ================================================
// =========== vyroba a zapis otisku ============== v pripade, ze parametr byl z Getu a kontroly OK
// ================================================
if ($kontrolaOK AND $requestMethod=='GET') {
    //vyroba otisku 
    $_SESSION['otisk'] =  session_id();  //$otisk;    
    //schovame si id pozadavku pro zápis do databáze po odeslání formuláře odpovedi
    $_SESSION['id_pozadavek'] = $prectena_veta_z_pozadavek['id_pozadavek'];  
    //zapis do tabulky pozadavek
    $query = "UPDATE pozadavek SET otisk = :otisk, id_request = :idRequest WHERE id_pozadavek = :idPozadavek";    
    $statt = $dbh->prepare($query);
    $ses_id = session_id();
    $statt->bindParam(':otisk', $ses_id);
    $statt->bindParam(':idRequest', $lastInsertedRequestId);
    $statt->bindParam(':idPozadavek', $prectena_veta_z_pozadavek['id_pozadavek']);

    $succ = $statt->execute();    
}
//todo: musi byt update , nestacil by jen jeden INSERT
//
if ($kontrolaOK) {
    ######### INSERT  do request ##########
    $query = "INSERT INTO request SET ";
    $set['ip'] = Utils_Ip::getRemoteIpAddress();
    $set['id_pozadavek_FK'] = isset($prectena_veta_z_pozadavek['id_pozadavek']) ? $prectena_veta_z_pozadavek['id_pozadavek'] : NULL;
    $set['kampane_id_vzb_osoba_kampan'] = isset($prectena_veta_z_pozadavek['kampane_id_vzb_osoba_kampan']) ? $prectena_veta_z_pozadavek['kampane_id_vzb_osoba_kampan'] : NULL;
    $set['request_uri'] = $_SERVER['REQUEST_URI'];
    $set['request_time'] = $_SERVER['REQUEST_TIME_FLOAT'];
    $set['remote_addr'] = $_SERVER['REMOTE_ADDR'];
    $set['query_string'] = $_SERVER['QUERY_STRING'];
    $set['input'] = @file_get_contents('php://input');
    $set['get_identifikace'] = isset($identifikace_parametr_test_zGETu) ? $identifikace_parametr_test_zGETu : "" ;
    $set['session_identifikace'] = $_SESSION['identifikace'];
    $set['kontrola_OK'] = $kontrolaOK;
    if($die) {
        $set['die'] = implode(' | ', $die);
    }
    if($debug) {
        $set['debug'] = implode(' | ', $debug);
    }
    foreach ($set as $key => $value) {
        if ($value) {
            $q[] = "`".$key."` = '".$value."'";
        }
    }
    $query .= implode(", ", $q);

    $statt = $dbh->prepare($query);
    $succ = $statt->execute();
    $lastInsertedRequestId = $dbh->lastInsertId();
}
// 
// ================================================
// =========== vyroba a zapis otisku ============== v pripade, ze parametr byl z Getu a kontroly OK
// ================================================
if ($kontrolaOK AND $requestMethod=='GET') {
    //vyroba otisku
    $_SESSION['otisk'] =  session_id();  //$otisk;    
    //schovame si id pozadavku pro zápis do databáze po odeslání formuláře odpovedi
    $_SESSION['id_pozadavek'] = $prectena_veta_z_pozadavek['id_pozadavek'];  
    //zapis do tabulky pozadavek
    $query = "update pozadavek set otisk ='" . session_id() . "'," .
            "id_request = " .  $lastInsertedRequestId .                
            " WHERE id_pozadavek = " . $prectena_veta_z_pozadavek['id_pozadavek'];    
    $statt = $dbh->prepare($query);
    $succ = $statt->execute();  
    if (!$succ){
        $die[] = " Chyba pri zaznamu pristupu(otisk) k testu. Update do tabulky pozadavek!";
    }
}


//------------------------------------------------
public function muze($requestMethod, $requestQuickformGet = FALSE, $identifikace_parametr_test_zGETu = "") {
        $this->die = array();
        $dbh = AppContext::getDb();

        ###########  VALIDACE IDENTIFIKÁTORU -  ################################
        if (isset($identifikace_parametr_test_zGETu) AND $identifikace_parametr_test_zGETu ) {  // identifikace je v GET
             //echo '<br/>Je argument [identifikace] ' . $identifikace_parametr_test_zGETu . ' <br/>' ;

             if ( !(isset($_SESSION["identifikace"])) ) {  // identifikace není v SESSION -> OK
                $debug[] = 'Je argument [identifikace]: ' . $identifikace_parametr_test_zGETu . 
                           'není v session [identifikace] ---> prvni spusteni v prohlizeci s argumentem';                                          
                $_SESSION['identifikace'] = $identifikace_parametr_test_zGETu;
                $idValidni = $identifikace_parametr_test_zGETu;    
             }
             else {  //identifikace je v SESSION a je i v GETu -> CHYBA
                 $debug[] = 'Je argument [identifikace] ' . $identifikace_parametr_test_zGETu . 
                      'je i v session [identifikace]: ' . $_SESSION["identifikace"]. ' ----> tzn. uz sla runda kolem<br/>' ;         
                 $debug[] = "Chyba parametru skriptu - opakovane spusteni! - je parametr a je i  v session - spoustim v otevrenem prohlizeci opakovane";                                    
                 $this->die[] ="Váš test můžete spustit pouze jednou!"; 
             }

        }
        else {    // identifikace není v GETu
            if (($requestMethod=='POST' OR $requestQuickformGet) AND isset($_SESSION["identifikace"]) ) {  // ... a je v SESSION -> OK
                $debug[] = 'Neni argument [identifikace] , ale je  v session [identifikace]: ' . $_SESSION["identifikace"]. ' ---- tzn. uz sla runda kolem<br/>' ;
                $idValidni = $_SESSION["identifikace"];
            }
            else {                                      //... a neni ani v SESSION -> CHYBA 
                $debug[] =' Neni argument [identifikace] a neni ani  v session [identifikace]';
                $this->die[] = "Test je možno spouštět pouze kliknutím na odkaz ve vašem e-mailu.";
            }    
        }

        
        
    
        //--------------- KONTROLA zda idValidni je take existujici 
        if (isset($idValidni)) {  
            
        // // ***kampane_2 nacteni informaci z DB z pohledu view_kampane_2
        //****************************toto bude jinde *************    
            $query = "SELECT id_vzb_osoba_kampan ,test_jmeno_souboru, test_nazev, zakaznik_nazev
                        FROM view_kampane_2
                        WHERE 
                        id_vzb_osoba_kampan = :idValidni";               

            $statt = $dbh->prepare($query);
            $statt->bindParam(':idValidni', $idValidni);
            $succ = $statt->execute();
            $pp = $statt->rowCount();     

            //zjistit kolikrat ji nasel - vicenez jedenkrat nebo vubec      
            if ($pp!==1) {
                $idValidni = NULL;
                $this->die[] = "Nemáte přístup k testu! Chyba při čtení z tabulky (pohledu)  -  neznámý přístup!";
            } else {                             
                $this->prectena_veta_z_view_kampane_2 =  $statt->fetch(\PDO::FETCH_ASSOC);
            }
        }
            //------zde jiz vim, ze pristup.udaj existuje a nacetl jsem udaje  z kampan_2
            //

        if (isset($idValidni)) {  

            //------zapsat do pozadavek, tady nikdy neni jeste zapsano  -- 
            //-- je nutno zapsat
                    //==============================================
                    //========== zapis pozadavku ===================
                    //==============================================
            ###########  KONTROLA opakovaneho pristupu A zápis do požadavků  ######################################      
                $query = "SELECT id_pozadavek, kampane_id_vzb_osoba_kampan,  otisk
                    FROM pozadavek                 
                    WHERE 
                    kampane_id_vzb_osoba_kampan = :idValidni";                
                $statSelect = $dbh->prepare($query);
                $statSelect->bindParam(':idValidni', $idValidni);
                $succ = $statSelect->execute();
                if (!$succ) {
                    $this->die[] = "Chyba při čtení z tabulky požadavek!"; 
                }
                if ($requestMethod=='GET' AND $identifikace_parametr_test_zGETu) {
                    $pp = $statSelect->rowCount();            

                    if ($pp > 0) {
                        $this->die[] = "Nemáte přístup! Chyba při čtení z tabulky požadavek  - násobný přístup! Test lze spustit pouze jednou!";
                    } else {
                        $query = "INSERT INTO pozadavek " .
                                 "SET kampane_id_vzb_osoba_kampan  = :idValidni, inserted = now()" ;                                
                        $statInsert = $dbh->prepare($query);
                        $statInsert->bindParam(':idValidni', $idValidni);
                        $succInsert = $statInsert->execute(); 
                        $succ = $statSelect->execute();
                        
                        $this->prectena_veta_z_pozadavek =  $statSelect->fetch(\PDO::FETCH_ASSOC);
                    }
                } else { //POST nebo GET při přepínání stránek formuláře
                    $this->prectena_veta_z_pozadavek =  $statSelect->fetch(\PDO::FETCH_ASSOC);
                }
            }            

        // ------------KONTROLA proti  otisku  -------------------------------------------------------          
        //-----------------------------------------------------------------------------------------           
         if ($requestMethod=='POST' OR $requestQuickformGet) { 
            // zda v session je otisk stejny jako v tabulce, kdyz ne tak die
            if ( isset($_SESSION["otisk"]) ){ 
                if ( $_SESSION["otisk"] != $this->prectena_veta_z_pozadavek['otisk'] ) {  
                    $debug[] = 'Test byl již v minulosti spuštěn. Pokoušíte se nekorektně spustit test znovu.';
                    $this->die[] = "Test je možno spouštět pouze kliknutím na odkaz ve vašem e-mailu.";  
                }
            }  else { // otisk neni v session - Nekorektni spusteni!
                $this->die[] = "Nekorektní spuštění! - Test je možno spouštět pouze kliknutím na odkaz ve vašem e-mailu."; 
            }
        }  

        if (!$this->die) {
            $kontrolaOK = TRUE;
        } else {
            $kontrolaOK = FALSE;
        }
        // 
        // ================================================
        // =========== vyroba a zapis otisku ============== v pripade, ze parametr byl z Getu a kontroly OK
        // ================================================
        if ($kontrolaOK AND $requestMethod=='GET') {
            //vyroba otisku 
            $_SESSION['otisk'] =  session_id();  //$otisk;    
            //schovame si id pozadavku pro zápis do databáze po odeslání formuláře odpovedi
            $_SESSION['id_pozadavek'] = $this->prectena_veta_z_pozadavek['id_pozadavek'];  
            //zapis do tabulky pozadavek
            $query = "UPDATE pozadavek SET otisk = :otisk, id_request = :idRequest WHERE id_pozadavek = :idPozadavek";    
            $statt = $dbh->prepare($query);
            $ses_id = session_id();
            $statt->bindParam(':otisk', $ses_id);
            $statt->bindParam(':idRequest', $lastInsertedRequestId);
            $statt->bindParam(':idPozadavek', $this->prectena_veta_z_pozadavek['id_pozadavek']);

            $succ = $statt->execute();    
        }
        //todo: musi byt update , nestacil by jen jeden INSERT
        //
        if ($kontrolaOK) {
            ######### INSERT  do request ##########
            $query = "INSERT INTO request SET ";
            $set['ip'] = Utils_Ip::getRemoteIpAddress();
            $set['id_pozadavek_FK'] = isset($this->prectena_veta_z_pozadavek['id_pozadavek']) ? $this->prectena_veta_z_pozadavek['id_pozadavek'] : NULL;
            $set['kampane_id_vzb_osoba_kampan'] = isset($this->prectena_veta_z_pozadavek['kampane_id_vzb_osoba_kampan']) ? $this->prectena_veta_z_pozadavek['kampane_id_vzb_osoba_kampan'] : NULL;
            $set['request_uri'] = $_SERVER['REQUEST_URI'];
            $set['request_time'] = $_SERVER['REQUEST_TIME_FLOAT'];
            $set['remote_addr'] = $_SERVER['REMOTE_ADDR'];
            $set['query_string'] = $_SERVER['QUERY_STRING'];
            $set['input'] = @file_get_contents('php://input');
            $set['get_identifikace'] = isset($identifikace_parametr_test_zGETu) ? $identifikace_parametr_test_zGETu : "" ;
            $set['session_identifikace'] = $_SESSION['identifikace'];
            $set['kontrola_OK'] = $kontrolaOK;
            if($this->die) {
                $set['die'] = implode(' | ', $this->die);
            }
            if($debug) {
                $set['debug'] = implode(' | ', $debug);
            }
            foreach ($set as $key => $value) {
                if ($value) {
                    $q[] = "`".$key."` = '".$value."'";
                }
            }
            $query .= implode(", ", $q);

            $statt = $dbh->prepare($query);
            $succ = $statt->execute();
            $lastInsertedRequestId = $dbh->lastInsertId();
        }
        // 
        // ================================================
        // =========== vyroba a zapis otisku ============== v pripade, ze parametr byl z Getu a kontroly OK
        // ================================================
        if ($kontrolaOK AND $requestMethod=='GET') {
            //vyroba otisku
            $_SESSION['otisk'] =  session_id();  //$otisk;    
            //schovame si id pozadavku pro zápis do databáze po odeslání formuláře odpovedi
            $_SESSION['id_pozadavek'] = $this->prectena_veta_z_pozadavek['id_pozadavek'];  
            //zapis do tabulky pozadavek
            $query = "update pozadavek set otisk ='" . session_id() . "'," .
                    "id_request = " .  $lastInsertedRequestId .                
                    " WHERE id_pozadavek = " . $this->prectena_veta_z_pozadavek['id_pozadavek'];    
            $statt = $dbh->prepare($query);
            $succ = $statt->execute();  
            if (!$succ){
                $this->die[] = " Chyba pri zaznamu pristupu(otisk) k testu. Update do tabulky pozadavek!";
            }
        }
        
        return $this->die ? FALSE : TRUE;
    }
    