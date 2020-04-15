<?php
/**
 * Description of Application
 *
 * @author pes2704
 */
class Accessor_Application {
    /**
     * Provádí kontrolu, logování a po úspěšné kontrole přesměrování na cílový skript.
     * Kontrola :
     * - ověřuje jestli k volání došlo vnitřním přesměrovánín na serveru Apache
     * - ověřuje jestli požadovaná adresa obsahuje query s proměnnou runparam
     * - ověřuje jestli jestli se o přístup nepokouší IP adresa uvedená na blacklistu
     * - dekóduje query string, vytvoří nové query pro nový request (pro přesměrování) a tento string vrací
     * 
     * Pokud kontrola selže, provede záznam do log souboru a vrací prázdný string.
     * @return string
     */
    public function run() {

        $redirectUrl = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : NULL;  // REDIRECT_URL (url, ze kterého bylo přesměrováno) vytváří APACHE, pokud došlo k vnitřnímu přesměrování

        if (isset($redirectUrl)) {  // bylo přesměrováno
            $runParam = isset($_GET['runparam']) ? $_GET['runparam'] : NULL;   // 'runparam' je proměnná použitá v .htaccess
            if ($runParam) {
                $ip = Utils_Ip::getRemoteIpAddress();
                $blackListMessages = Utils_Ip::checkBlackLists($ip);
                if(!$blackListMessages) {
                    // objekt kontextu testu
                    $testContextObject = Accessor_AppContext::getTestContextObject($redirectUrl);
                    //dekódování parametru
                    $decodedParam = $testContextObject->getRequestParameterKoder()->decode($runParam);
                    if (isset($decodedParam)) {
                        $queryVariables = $testContextObject->getQueryBuilder()->parse($decodedParam);
                        // cílové query kódováno vždy podle RFC1738 (standartní get uel query) - viz  http://www.faqs.org/rfcs/rfc1738.html
                        $targetQuery = http_build_query($queryVariables);
                        $location = $testContextObject->getTargetScriptName();
                        $location .= '?'.$targetQuery;
                        $this->logRelokace($ip, $location);
                    } else {
                        $this->logErrorParam($ip, $identificator);
                    }
                } else {
                    $this->logErrorBlacklisted($blackListMessages);
                }
            } else {
                $this->logErrorNoParam($redirectUrl);
            }
        } else {
            $this->logErrorRedirection();
        }
        return $location ? $location : '';
        
    }
    
    private function logRelokace($ip, $location) {
        $msg = '[URI FORMAT OK] '.'Relokace na '.$location.' v '.date('j.m.Y H:m:s', time()).';'
                .$_SERVER['HTTP_REFERER'].';'.$_SERVER['REQUEST_URI'].';'.$_SERVER['REDIRECT_URL'].';'
                .$_SERVER['REMOTE_ADDR'].';'.$ip.';'
                .$_SERVER['REQUEST_TIME_FLOAT'].';'.date('j.m.Y H:m:s', $_SERVER['REQUEST_TIME']).';'
                .$_SERVER['QUERY_STRING'].PHP_EOL;
        Utils_Log::logToCsv(Accessor_AppContext::getLogDirectory().'relokace.csv', $msg);
    }
    
    private function logErrorParam($ip, $identificator) {
        $string = date('j.m.Y H:m:s', time()).';'.$_SERVER['REQUEST_URI'].';'.$_SERVER['REQUEST_TIME'].';'.$_SERVER['REMOTE_ADDR'].';'.$ip.
            ';'.date('j.m.Y H:m:s', $_SERVER['REQUEST_TIME']).';'.$_SERVER['QUERY_STRING'].';'.$identificator.';'.PHP_EOL;
        $msg = '[ERROR: QUERY FORMAT] - '.$string;
        Utils_Log::logError(Accessor_AppContext::getLogDirectory()."errors.log", $msg);
        Utils_Log::mailError(Tester_AppContext::getLogReceiverMailAddress(), $msg);
    }
    
    private function logErrorBlacklisted($blackListMessages) {
        $string = implode('; ', $blackListMessages);
        $msg = '[ERROR: BLACKLISTED URL] - '.$string;
        Utils_Log::logError(Accessor_AppContext::getLogDirectory()."errors.log", $msg);
        Utils_Log::mailError(Accessor_AppContext::getLogReceiverMailAddress(), $msg);          
    }
    
    private function logErrorNoParam($redirectUrl) {
        $msg = '[ERROR: NO PARAM] - There is no run parameter. Redirect url: '.$redirectUrl;
        Utils_Log::logError(Accessor_AppContext::getLogDirectory()."errors.log", $msg);
        Utils_Log::mailError(Tester_AppContext::getLogReceiverMailAddress(), $msg);          
    }
    
    private function logErrorRedirection() {
        $msg = '[ERROR: REDIRECTION] - No any redirection, no any redirect url.'.PHP_EOL;
        Utils_Log::logError(Accessor_AppContext::getLogDirectory()."errors.log", $msg);           
    }
}
