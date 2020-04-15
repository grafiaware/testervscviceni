<?php

class ¨__Tester_Tabbed_Controller_Page_Populator_RadioGroupPopulatorForJenCist extends Tester_Tabbed_Controller_Page 
                                                implements Tester_Tabbed_Controller_Page_Populator_RadioGroupPopulatorInterface 
{
    const IMAGES_PATH = 'obrazky/';
    /**
     *
     * @var Tester_Tabbed_Controller_Page_Populator_Parameters_RadioGroupParameters
     */
    private $populatorParameters;
    
    
    /*    
  *$populatorParameters   
    private $bezPravidel;    
    private $zobrazujVolbyOdpovedi;
      jenCist
*/
 /*   
  * $pageParameters 
    private $formActionNav;
    private $formActionSubmit;
    private $formAction;    
    private $idUloha;       
    private $uloha;
*/
    
    
    public function initialize_setPopulParameters( Tester_Tabbed_Controller_Page_Populator_Parameters_RadioGroupParametersInterface $populatorParameters) {
        $this->populatorParameters = $populatorParameters;
    }    
    
    
    
    protected function populateForm() 
    {        
        $uloha = $this->pageParameters->getUloha();  
        $zobrazujVolbyOdpovedi = $this->populatorParameters->getZobrazujZvoleneOdpovedi();
        
        $this->addTabs( $uloha->getNavigace()->getNapis() );       
        $this->form->setAttribute('action', $this->getPageParameters()->getFormActionNav());
       
        $otazka = $uloha->getOtazka();
         
        $fieldset = $this->form->addElement('fieldset')->setLabel($otazka->getLegend());
        $imgFileName = $otazka->getZadani()->getObsah()->getImgFileName();
        if ($imgFileName) {
            $fieldset->addElement('image', 'img' . $imgFileName , array('src' => self::IMAGES_PATH . $imgFileName) );
        }
        
        $zadani = $fieldset->addElement('static', 'zadani')
                ->setLabel($uloha->getOtazka()->getZadani()->getObsah()->getLabel())
                ->setContent($uloha->getOtazka()->getZadani()->getObsah()->getText());        
              
        $radioGroup = $fieldset->addElement('group')
                                    ->setLabel( $uloha->getOtazka()->getZadani()->getObsah()->getLabel()  )                
                                            ->setSeparator('<br />');
        
        //-------------------------- radia ------------
        if ($uloha->getOtazka()->getZadani()->getOdpoved()->getType()== 'radia' )
        {
             foreach ($uloha->getOtazka()->getZadani()->getOdpoved()->getData()->getContent()   as $key => $value ) {                     
                //---- ziskani spravne odpovedi pro radia, pro jine mozna jinak
                $valueZobrazovaci = $value;
                               if ($uloha->getOtazka()->getZadani()->getOdpoved()->getType() == 'radia' ) {                                           

                    //$C = $this->getController();  // page tabeddTesterovyController  // $Id = $C->getId();  //  Id tabbedu je 'Tabbed'
                    $odpovediZTabbedControlleruArray = $this->getController()->getValue();  //pole odpovedi   
                    $okOdpoved = $uloha->getOtazka()->getZadani()->getOdpoved()->getData()->getOk();                               
                             
                    // $parPopul = $this->populatorParameters;
                    $IdUloha = $this->pageParameters->getIdUloha();  
                    if ($zobrazujVolbyOdpovedi)  {
                        if (isset ($odpovediZTabbedControlleruArray[$IdUloha]) ) {
                            if ( ($key == $odpovediZTabbedControlleruArray [$IdUloha]) ) {   
                                if  ($key == $okOdpoved) {
                                    $valueZobrazovaci .=  '<span class="spravnaVolba">  Vaše volba! </span>'  ; 
                                }else {
                                    $valueZobrazovaci .=  '<span class="vaseVolba">  Vaše volba ! </span>'  ; }                         
                            }   
                        }                                                                                                       
                        if ( ($key == $okOdpoved)  ) { 
                            $valueZobrazovaci .=  ' <span class="spravnaVolba"> SPRAVNA volba! </span> '  ;                        
                        }  
                    }
                    $el = $radioGroup->addElement('radio',
                                            $this->pageParameters->getIdUloha(),                           
                                            array( 'value' => $key ),
                                            array( 'content' => $valueZobrazovaci ) ); 
                }
            //$el->
            } //foreach
            
        } else {
            throw new LogicException(__METHOD__.' nedostala prostřednictvím initialize() objekt Uloha-Otazka-Zadani-Odpoved typu radio. ');
        }
        
    }
}    
        
        
        
        
//       
//        
//        
//        
//        
//        $this->addTabs();
//
//        $fs = $this->form->addElement('fieldset')->setLabel($this->otazka->legend);
//        
//        if ($this->otazka->imgFileName) {
//            $fs->addElement(
//              'image', 'img' . $this->otazka->imgFileName , array('src' => self::IMAGES_PATH . $this->otazka->imgFileName)
//            );
//        }
//        $zadani = $fs->addElement('static', 'zadani')->setLabel($this->otazka->zadani['label'])->setContent($this->otazka->zadani['text'] );
//        
//        $radioGroup = $fs->addElement('group')->setLabel($this->otazka->radia['label'])
//                         ->setSeparator('<br />');
//        
//        foreach ($this->otazka->radia['content'] as $key => $value ) {
//            if ($key == $this->odpovedZvolena->hodnota) {$value = $value . "&nbsp;&nbsp;&nbsp;&nbsp; <span class = 'vaseVolba' >Vaše odpověď.</span>";}
//            if ($key == $this->otazka->spravnaOdpoved) {$value = $value . "&nbsp;&nbsp;&nbsp;&nbsp; <span class = 'spravnaVolba' >Správná volba.</span>";}
//        
//            $radioGroup->addElement('radio',
//                                    $this->idOtazka,                               
//                                    array( 'value' => $key ),
//                                    array( 'content' => $value ));
//            
//        }      
//
//    }
//}
