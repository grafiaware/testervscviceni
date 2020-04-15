<?php

/**
 * Description of Tester_Tabbed_Jump
 *
 * @author vlse2610
 */
class __Tester_Tabbed_Handler_Jump extends HTML_QuickForm2_Controller_Action_Jump /*extends Tester_Tabbed_Handler_JumpCommon */{
    
    public function perform(HTML_QuickForm2_Controller_Page $page, $name)  {
        // we check whether *all* pages up to current are valid
        // if there is an invalid page we go to it, instead of the
        // requested one      
        
//  toto vse tu bylo , a protoze tonepotrebujem, nahrajem si na Wizard...., tak tom tu není  
//        if ($page->getController()->isWizard() && !$page->getController()->isValid($page)
//        ) {
//            $page = $page->getController()->getFirstInvalidPage();
//        }
//
//        // generate the URL for the page 'display' event and redirect to it
//        $action = $page->getForm()->getAttribute('action');
//        // Bug #13087: RFC 2616 requires an absolute URI in Location header
//        if (!preg_match('@^([a-z][a-z0-9.+-]*):@i', $action)) {
//            $action = $this->resolveRelativeURL($action);
//        }
//
//        if (!$page->getController()->propagateId()) {
//            $controllerId = '';
//        } else {
//            $controllerId = '&' . HTML_QuickForm2_Controller::KEY_ID . '=' .
//                            $page->getController()->getId();
//        }
//        if (!defined('SID') || '' == SID || ini_get('session.use_only_cookies')) {
//            $sessionId = '';
//        } else {
//            $sessionId = '&' . SID;
//        }                
//        //        return $this->doRedirect(       //bylo zde                
//        $a = $action;
//        $b =  (false === strpos($action, '?')? '?': '&'); 
//        $c =  (true === strpos($action, '?')? '?': '&'); 
//        $d = $page->getButtonName('display') . '=true';
//        $e = $controllerId;
//        $f = $sessionId;
//        $url = $action . (false === strpos($action, '?')? '?': '&') .
//            $page->getButtonName('display') . '=true' . $controllerId . $sessionId;
//        
//        // zachyceno     "http://localhost/TesterVScviceni/Tester/index.php?_qf_99_display=true
//        // $url2 = "/otazka/" . $page->getButtonName('display') . '=true' . $controllerId . $sessionId. "/";
        
        
        
//        $arUloha = str_getcsv($page->getButtonName('display'), '_');                     
//        return $arUloha[2] ;        
    }   


//
//   /**
//    * Redirects to a given URL via Location: header and exits the script
//    *
//    * A separate method is mostly needed for creating mocks of this class
//    * during testing.
//    *
//    * @param string $url URL to redirect to
//    */
//    protected function doRedirect($url)
//    {
////        header('Location: ' . $url);
////        exit;
//       assert( \FALSE,  "Sem jsem se neměl dostat. Nepředpokladane volaní Tester_Tabbed_Jump->doRedirect. ");
//    }
    
    
}
