<!--
Tento soubor se spouští pomocí .htaccess v případě, že REQUEST_FILENAME neodpovídá zadanému řetězci.
Provede záznam do souboru 'forbidden.csv' vrací response se status k´dem 403 Forbidden
-->
<?php
require_once '../Utils/Log.php';
require_once '../Utils/Ip.php';
require "../Accessor/AppContext.php";

ob_start();
$ip = Utils_Ip::getRemoteIpAddress();

$msg = '[URI ERROR] '.'Vrácen response status code 403 (Forbidden) '.date('j.m.Y H:m:s', time()).';'
        .$_SERVER['HTTP_REFERER'].';'.$_SERVER['REQUEST_URI'].';'.$_SERVER['REDIRECT_URL'].';'
        .$_SERVER['REMOTE_ADDR'].';'.$ip.';'
        .$_SERVER['REQUEST_TIME_FLOAT'].';'.date('j.m.Y H:m:s', $_SERVER['REQUEST_TIME']).';'
        .$_SERVER['QUERY_STRING'].PHP_EOL;
Utils_Log::logToCsv(Accessor_AppContext::getLogDirectory().'forbidden.csv', $msg);
header('HTTP/1.0 403 Forbidden');
echo '<html><body><h1>Forbidden access!</h1></body></html>';
exit;
?>
