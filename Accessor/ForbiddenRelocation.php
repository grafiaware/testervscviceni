<!DOCTYPE html>
<!--
Tento soubor byl nahraze verzí forbidden.php a v .htaccess se přesměrovává na forbidden.php.

Tato původní varianta není v nové konfiguraci otestovaná!

Tato původní varianta umožňuje přesměrování a tedy výpis nějaké vhodné stránky nebo stránek.
Tento soubor se spouští pomocí .htaccess v případě, že REQUEST_FILENAME neodpovídá zadanému řetězci.
Provede záznam do souboru 'relokace.csv' a přesměrování. Stránka po přesměrování musí existivat a obsah .htaccess musí být odpovídající
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once '../Utils/Log.php';
        require_once '../Utils/Ip.php';
        $location = 'stranka_po_presmerovani.html';
        ob_start();
        header('Location: '.$location);
        $ip = Utils_Ip::getRemoteIpAddress();

        $msg = '[URI ERROR] '.'Relokace na '.$location.' v '.date('j.m.Y H:m:s', time()).';'
                .$_SERVER['HTTP_REFERER'].';'.$_SERVER['REQUEST_URI'].';'.$_SERVER['REDIRECT_URL'].';'
                .$_SERVER['REMOTE_ADDR'].';'.$ip.';'
                .$_SERVER['REQUEST_TIME_FLOAT'].';'.date('j.m.Y H:m:s', $_SERVER['REQUEST_TIME']).';'
                .$_SERVER['QUERY_STRING'].PHP_EOL;
        Utils_Log::logToCsv('relokace.csv', $msg);
        exit;
        ?>
    </body>
</html>
