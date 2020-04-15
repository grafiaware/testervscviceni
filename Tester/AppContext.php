<?php
namespace Tester;

use Pes\Database\Handler\HandlerInterface;

use Pes\Database\Handler\ConnectionInfo;
use Pes\Database\Handler\DbTypeEnum;
use Pes\Database\Handler\DsnProvider\DsnProviderMysql;
use Pes\Database\Handler\OptionsProvider\OptionsProviderMysql;
use Pes\Database\Handler\AttributesProvider\AttributesProviderDefault;
use Pes\Database\Handler\Handler;

use Psr\Log\NullLogger;
use Pes\Logger\FileLogger;

/**
 * Kontejner na globalni promenne
 * @author Petr Svoboda
 */
class AppContext
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
     * @var HandlerInterface Array of 
     */
    private static $db = array();

    /**
     * Metoda vrací objekt pro přístup k databázi. Metoda se podle označení databáze (nick) zadaném jako prametr rozhoduje, 
     * který objekt pro přístup k databázi vytvoří. Ke každé databázi vytváří jednu instanci objektu.
     * @param string $nick Označení databáze používané v tomto projektu. Jedná se o označení používané v rámci aplikace, nikoli o skutečný název 
     * databáze v databázovém stroji.
     * @return HandlerInterface
     * @throws UnexpectedValueException
     */
    public static function getDb($nick = self::DEFAULT_DB_NICK) {
        switch ($nick) {
            case 'tester':
                if(!isset(self::$db['tester']) OR !isset(self::$db['tester'])) {
                    if (self::isRunningOnProductionMachine()) {                        
                        $connectionInfoUtf8 = new ConnectionInfo
                                ($nick, DbTypeEnum::MySQL, "neon", "root", "spravce", "tester_2", 'utf8', 'utf8_czech_ci');                    
                    } else {                        
                        $connectionInfoUtf8 = new ConnectionInfo
                                ($nick, DbTypeEnum::MySQL, "localhost", "root", "spravce", "tester_2", 'utf8', 'utf8_czech_ci');                                                 
                    }
                    $dsnProvider = new DsnProviderMysql();
                    $optionsProvider = new OptionsProviderMysql();
//                    $logger = new NullLogger();
                    $logger = FileLogger::getInstance('Logs', 'DbLogger.log', FileLogger::REWRITE_LOG);
                    $attributesProviderDefault = new AttributesProviderDefault($logger);
                    $dbh = new Handler($connectionInfoUtf8, $dsnProvider, $optionsProvider, $attributesProviderDefault, $logger); 

                    self::$db['tester'] = $dbh;
                } else {
                    $dbh = self::$db['tester'];
                }
   
                break;
                
            default:
                throw new \UnexpectedValueException('Neznámé označení databáze (nick): '.$nick.'.');
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