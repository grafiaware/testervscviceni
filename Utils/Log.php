<?php
/**
 * Description of DOREL
 *
 * @author pes2704
 */
class Utils_Log {

    public static function logError($fileName, $msg) {
    //TODO: vyhodit konstantu -> do parametru
        error_log($msg, 3, $fileName);
    }
    
    public static function mailError($mailAddress, $msg) {
        error_log($msg, 1, $mailAddress, "From: dorel@grafia.cz\n");
    }
    
    public static function logToCsv($fileName, $string) {
        $handle = fopen($fileName, 'a'); 
        fwrite($handle, $string);
        fclose($handle);  
    }
}
