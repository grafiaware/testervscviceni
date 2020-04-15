<?php
/**
 * Description of DOREL
 *
 * @author pes2704
 */
class Utils_Ip {

    public static function getRemoteIpAddress() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];

        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }
    
    /**
     * 
     * @param string $remoteIpAddress
     * @return array
     */
    public static function checkBlackLists($remoteIpAddress) {
        $blacklists = array('web.sorbs.net');
        $parts  = explode('.', $remoteIpAddress);
        $ip     = implode('.', array_reverse($parts)) . '.';
        $blackListMessages = array();
        foreach($blacklists as $bl) {
            $check = $ip . $bl;
            $checkedHostIp = gethostbyname($check);  // vrací IPv4 podle jména, v případě neúspěchu vrací původní řetězec
            if ($check != $checkedHostIp) {
                $msg = '[DNS BLACK LIST] - Blacklist:'.$bl.', IP: '.$remoteIpAddress.', '.date('j.m.Y H:m:s', time());
                $blackListMessages[] = $msg;
            }
        }
        return $blackListMessages;
    }
}
