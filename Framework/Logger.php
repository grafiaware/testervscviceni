<?php
/**
 * Logger loguje do paměti (zapisuje do pole, které je vlastností instance objektu).
 * @author Petr Svoboda
 */
class Framework_Logger
{
    /**
     * @var Framework_Logger 
     */
    private static $instance;
    private static $log = array();
    
    /**
     * 
     * @return Framework_Logger
     */
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Metoda vrací obsah logu ve formě pole. Každá položka pole obsahuje jeden zápis do logu. Každá položka obsahuje to, 
     * co do ní bylo zapsáno. Pokud byly zapsány proměnné různých typů, obsahují položky proměnné těch typů, které byly zapsány.
     * @return array
     */
    public static function getLogArray() {
        return self::$log;
    }

    /**
     * Metoda vrací obsah logu ve formě textu. Pro převod obsahu do textu je používána funkce print_r(). 
     * @return string
     */
    public static function getLogText() {
        return print_r(self::$log, TRUE);
    }        

    /**
     * Vymaže log.
     * @return self
     */
    public static function resetLog() {
        self::$log = array();   //NULL;
        return self::$instance;
    }

    /**
     * Zápis jednoho záznamu do logu. Metoda přijímá argumenty, které lze převést do čitelné podoby.
     * Skalární argumety zapíše v řetězcovém vyjádření, pro ostatní typy používá výstup funkce var_export().
     * @param mixed $zaznam 
     * @return self
     */
    public static function toLog($zaznam = NULL) {
        if ($zaznam AND (is_scalar($zaznam))) {
            self::$log[] = (string) $zaznam;
        } else {
            self::$log[] = var_export($zaznam, TRUE);
        }
        return self::$instance;
    }

}
