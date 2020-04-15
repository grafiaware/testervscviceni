<!DOCTYPE html>
<!--
Tento soubor se spouští pomocí .htaccess v případě, že REQUEST_FILENAME odpovídá zadanému řetězci v konstantě ACCEPTED_URL.
Provede kontrolu query stringu, záznam do .csv souboru a v případě úspěchu stažení souboru.
Pokud kontrola selže, provede záznam do .csv souboru a končí, neodesílá žádnou odezvu.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once '../DOREL.php';
        require 'define.php';

        if ($_SERVER['REDIRECT_URL']==ROOT_DIR.SUB_DIR.'/'.ACCEPTED_SCRIPTNAME) {
            Utils_Ip::checkBlackLists();
            $queryStringFormatOK = FALSE;
            if (strpos($_SERVER['QUERY_STRING'], CUSTOMER) !== FALSE) {
                $queryIdentificator = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], CUSTOMER)+  strlen(CUSTOMER) );
                if ($queryIdentificator !== FALSE AND strlen($queryIdentificator) == IDENTIFICATOR_LENGTH) {
                    $queryStringFormatOK = TRUE;
                }
            }

            $ip = Utils_Ip::getRemoteIpAddress();
            $string = date('j.m.Y H:m:s', time()).';'.$_SERVER['REQUEST_URI'].';'.$_SERVER['REQUEST_TIME'].';'.$_SERVER['REMOTE_ADDR'].';'.$ip.
                ';'.date('j.m.Y H:m:s', $_SERVER['REQUEST_TIME']).';'.$_SERVER['QUERY_STRING'].';'.$queryIdentificator.';'.PHP_EOL;
            if ($queryStringFormatOK) {
                header('Location: '.METHOD.HOST.ROOT_DIR.'/TestExcel.php?test='.CUSTOMER.$queryIdentificator);
                exit;
            } else {
                $msg = '[QUERY FORMAT ERROR] - '.$string;
                Utils_Log::logError("errors.log", $msg);
                Utils_Log::mailError($msg);
            }
            exit;  
        }
        ?>
    </body>
</html>
