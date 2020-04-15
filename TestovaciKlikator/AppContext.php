<?php
/**
 * Kontejner na globalni promenne
 * @author Petr Svoboda
 */
class TestovaciKlikator_AppContext
{
############ CESTA KE SLOŽKÁM S OBSAHY A PŘÍLOHAMI MAILŮ #############################
//    private static function getContetsRootDirectory() {
//        return '_MailContents'.'/';  // relativní cesta vzhledem ke kořenovému adresáři skriptu
//    }
//    
############# DATABÁZE #############    
    const DEFAULT_DB_NICK = 'tester';
    
    /**
     * Informuje, zda skript běží na produkčním stroji.
     * @return boolean
     */
    private static function isRunningOnProductionMachine() {
        if (strpos(strtolower(gethostname()), 'projektor')===0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * @var Framework_Database_HandlerSqlInterface 
     */
    private static $db = array();

    /**
     * Metoda vrací objekt pro přístup k databázi. Metoda se podle označení databáze (nick) zadaném jako prametr rozhoduje, 
     * který objekt pro přístup k databázi vytvoří. Ke každé databázi vytváří jednu instanci objektu.
     * @param string $nick Označení databáze používané v tomto projektu. Jedná se o označení používané v rámci aplikace, nikoli o skutečný název 
     * databáze v databázovém stroji.
     * @return Framework_Database_Handler_Sql
     * @throws UnexpectedValueException
     */
    public static function getDb($nick = self::DEFAULT_DB_NICK) {
        switch ($nick) {
            case 'tester':
                if(!isset(self::$db['tester']) OR !isset(self::$db['tester'])) {
                    if (self::isRunningOnProductionMachine()) {
                        throw new RuntimeException('Nelze pouzivat testovaci klikator pro zmeny databaze na produkcnim stroji!');
                        $dbh = new Framework_Database_HandlerSqlMysql("tester_2", "root", "spravce", "neon");
                    } else {
                        $dbh = new Framework_Database_HandlerSqlMysql("tester_2", "root", "spravce", "localhost");
                    }
                    self::$db['tester'] = $dbh;
                } else {
                    $dbh = self::$db['tester'];
                }
                break;

            default:
                throw new UnexpectedValueException('Neznámé označení databáze (nick): '.$nick.'.');
        }
        return $dbh;
    }
    
    /**
     * Vrací defaulní označení (nick) databáze. Jedná se o označení používané v rámci aplikace, nikoli o skutečný název 
     * databáze v databázovém stroji.
     * @return string
     */
    public static function getDefaultDatabaseNick() {
        return self::DEFAULT_DB_NICK;
    }
}