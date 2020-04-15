<!DOCTYPE html>
<!--
Tento soubor se spouští pomocí .htaccess v případě, že REQUEST_FILENAME neodpovídá zadanému řetězci "download".
Provede záznam do souboru 'relokace.csv' a přesměrování
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        ob_start();
        require_once '../DOREL.php';
        require 'define.php';
        header('Location: '.METHOD.HOST.ROOT_DIR.SUB_DIR.'/error.html');
        
        $ip = Utils_Ip::getRemoteIpAddress();
        $msg = '[URI ERROR] - '.date('j.m.Y H:m:s', time()).';'.$_SERVER['REQUEST_URI'].';'.$_SERVER['REQUEST_TIME'].';'.$_SERVER['REMOTE_ADDR'].';'.$ip.
                ';'.date('j.m.Y H:m:s', $_SERVER['REQUEST_TIME']).';'.$_SERVER['QUERY_STRING'].PHP_EOL;
        Utils_Log::logError('relokace.csv', $msg);
        Utils_Log::mailError($msg);

        exit;
        ?>
    </body>
</html>
