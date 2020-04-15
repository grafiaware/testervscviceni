<?php

/**
 * Description of SmazSession
 *
 * @author pes2704
 */
class TestovaciKlikator_Actions_SmazSession {
    public static function perform() {
        session_start();
        session_unset();
        $successDestroySession = session_destroy();
    //    session_write_close();
    //    setcookie(session_name(),'',0,'/');
    //    session_regenerate_id(true);
        if ($successDestroySession) {
            $messages[] = 'Session smazána.';
        }
        return $messages;
    }
}
