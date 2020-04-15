
<!--
Tento soubor se spouští pomocí .htaccess v případě, že obsahuje přesměrování na stop.php, např.
RewriteRule (.*) "Stop.php?query=$1&requestfilename=%{REQUEST_FILENAME}" [L]
Provede záznam do souboru 'stop.log' a přesměrování
pokud přesměrování vytvoří GET proměnné query a requestfilename, loguje i tyto proměnné
-->

<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="cs"> 
    <title>STOP</title>

    <style type="text/css">            
    body {
        margin-left: 10px;
        font-family: Arial,sans-serif;
        font-size: small;

        background-color: #DDD;
    }
    </style></head>
    <body>
    <div><p style="font-size: large;"> STOP - Omlouváme se, váš test dosud není spuštěn.</p></div>

    </body>
</html>

<?php
require_once '../Utils/Log.php';
$query = isset($_GET['query']) ? $_GET['query'] : '';
$requestfilename = isset($_GET['requestfilename']) ? $_GET['requestfilename'] : '';
$msg = '[STOP] - STOP - Omlouváme se, váš test dosud není spuštěn. '.date('j.m.Y H:m:s', time()).';'.query.';'.$requestfilename.';';
Utils_Log::logError(Accessor_AppContext::getLogDirectory()."stop.log", $msg);
exit;