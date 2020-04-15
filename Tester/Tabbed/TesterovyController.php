<?php


/**
 * 'tabbed'
 *
 * @author vlse2610
 */
class Tester_Tabbed_TesterovyController extends \HTML_QuickForm2_Controller {
    
     /* function __construct($id = null, $wizard = true, $propagateId = false) */
     
    protected $jenCist = FALSE;    
    protected $zobrazujZvoleneOdpovedi = FALSE;  // ZELENE A CERVENE     
    
    protected $pageId;
    protected $actionNameTesterovehoControlleru;
    //$actionName je pole [0]-integer, [1]-string
    //protected $actionName = null;   // pretizi

    
    /* 
     * 
     */
    public function setRunParams($pageId, $actName) {
        $this->pageId = $pageId;
        $this->actionNameTesterovehoControlleru = $actName;
    }
    
    
    public function setZamrzly() {
        $this->jenCist = \TRUE;
        $this->zobrazujZvoleneOdpovedi =  \TRUE;   
    }            
    public function setNezamrzly() {
        $this->jenCist = \FALSE;
        $this->zobrazujZvoleneOdpovedi = \FALSE;     
    }
    public function getjenCist() {
        return $this->jenCist;       
    }  
    public function getZobrazujZvoleneOdpovedi() {
        return $this->zobrazujZvoleneOdpovedi;       
    }
    
    
    
    
    
    
    
    
    /**
     * Vrací z HTML_QuickForm2_Controlleru (= tento objekt znamy jako $tabbed ) jeden page controller HTML_QuickForm2_Controller_Page.
     *  
     * @param type $pageId
     * @return HTML_QuickForm2_Controller_Page
     */
    public function dejPageControler($pageId) {
        return $this->pages[$pageId];
    }
    
    
    
//
//    public function getValue() {
//        $poleOdpovedi = parent::getValue();  
//        if (!$poleOdpovedi) {
//            throw new Exception\NeuplnyTest('Test ještě není celý uplně správně vyplněn a tak kontroly neprošly a vůbec je to špatně a tak jsme nedostali data.');        
//        }
//        return $poleOdpovedi;
//    }
    
    /**
     * Vykoná akci zadaneho handleru (process, jump ....) nad zadanym kontrolerem (page).
     * 
     * @return type
     * @throws LogicException
     */
    public function run() {
        if (!isset($this->pageId)) {
            reset($this->pages);
            $this->pageId = key($this->pages);  //nastavi "prvni"            
            //$this->actionName = array($this->pageId,$this->actionNameTesterovehoControlleru );
        }
        if (isset($this->actionNameTesterovehoControlleru)) {                        
            return $this->pages[$this->pageId]->handle($this->actionNameTesterovehoControlleru);
            //tady vraci             
        } else {
            throw new LogicException("Nelze vrátit parametry action name, nebyly nastaveny.");
        }   
    }
}
