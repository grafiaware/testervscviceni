<?php


abstract class Tester_Tabbed_Controller_Page extends HTML_QuickForm2_Controller_Page 
                                             implements Tester_Tabbed_Controller_PageInterface
{
    /**
     * @var Tester_Tabbed_Controller_Page_Parameters_PageParametersInterface
     */
    protected $pageParameters;
    
    public function setPageParameters( \Tester_Tabbed_Controller_Page_Parameters_PageParametersInterface $pageParametrs) {
        $this->pageParameters = $pageParametrs;
    }
    
    public function getPageParameters(): \Tester_Tabbed_Controller_Page_Parameters_PageParametersInterface {
        if (isset($this->pageParameters)) {
            return $this->pageParameters;
        } else {
            throw new \LogicException('Nenastaveny parametry, nebyla zavolána metoda setParameters().');
        }
    }
    
    
    
    /**
     * Přidá do formuláře navigační tlačítka úloh s nastavenim formaction a metodou POST.
     */
    protected function addTabs(  )
    {            //$this->form->addButton($name, $attributes, $data)
                 //$this->form->addElement($elementOrType, $name, $attributes)
        $C = $this->getController();  //Tester_Tabbed_TesterovyController
        $basePath = $this->pageParameters->getBasePath();
               
        $navGroup = $this->form->addElement('group') //->setSeparator('')
                               ->setId('tabs');
        foreach ($this->getController() as $pageId => $page) {  //page je typu tester_Tabbed_Controller_Page_PopulateForm_RadioGroupAutomat
       
            // indexy vznikly v Tester_Tabbed_TesterovyController->addPage(), kde se jako pageId použije id elementu form takto: $pageId = $page->getForm()->getId();
            // id elementu form vzniklo tak, že při vytváření nového automatu v TabbedFactory: 
            // $pageAutomat = new \Tester_Tabbed_Controller_Page_PopulateForm_RadioGroupAutomat(new \HTML_QuickForm2( $idOtazka, 'post', NULL, FALSE));
            // jako parametr konstruktoru předal QuickForm formulář s nastaveným id elementu form: (new \HTML_QuickForm2( $idOtazka, 'post', NULL, FALSE)
            // v našem případě tedy je jako id form použito idUloha -> idPage je idUloha
            
            $nam =  $this->getButtonName('display' );
            /* novy element = button */
            $el = $navGroup->addElement(
                            'button', 
                            $this->getButtonName('display' ),   //   dala jsem display /*$actionName*/
                                        // HTML_QuickForm2_Controller_Page->getButtonName($pageId) 
                                        // vytvoří string z $pageId a $actionName ('_qf_%s_%s'), např '_qf_99_diplay';
                            /* @var $page Tester_Tabbed_Controller_Page  */            
                            $page === $this? [ 'class' => 'flat0', 'disabled' => 'disabled']: [ 'class' => 'flat'] +            
                            [                                                                 
                               'type' => 'submit',                                 
                               'formaction' => $basePath . $page->getPageParameters()->getFormActionNav() .  $pageId. '/' ,  
                               'formmethod' => "post",
                               'value' => ucfirst($pageId) 
                            ]  ,                           
                            ['content' =>  $page->getPageParameters()->getUloha()->getNavigace()->getNapis() ]                             
                            );            
//            /* puvodne byl tento  input */
//             $tabGroup->addElement('submit',
//                                   $this->getButtonName($pageId),
//                                   array('class' => 'flat', 
//                                         'value' => ucfirst($pageId)) +
//                                   ( $page === $this? array('disabled' => 'disabled', 'style' => 'background-color:#7FF0F0'): array() )
//                                 );                              
        }
    }
    
    
    
    /**
     * Přidá do formuláře tlačítko Pokračuj s nastavenim formaction a metodou POST.
     * @param string $formActionSubmit
     */
    protected function addGlobalSubmit( $formActionSubmit  )
    {
        $this->form->addElement(
                'button',  
                $this->getButtonName('submit'),
                [ 'value' => 'Pokračovat',
                  'class' => 'flat',                
                  'formaction' => $formActionSubmit . $this->getForm()->getId() . '/' , 
                  'formmethod' => "post",  
                  'type' => 'submit'  ],
                [ 'content' => ' Pokračovat ' ] )->setLabel( '<span style="font-size: 9px;">' .
                                                             'V případě, že jsou vyplněny odpovědí u všech úloh, <br> tlačítko uloží celý test.' .
                                                             '</span>' );           
        $this->setDefaultAction('submit');
    }
    
//    
//    /**
//     * 
//     * @param boolean $param
//     * @return boolean
//     * @throws Exception\NevalidniStranka
//     */
//    public function storeValues( $param =\TRUE ) {
//        $okStranka = parent::storeValues();   // y/n
//        if ( !$okStranka ) {
//            throw new Exception\NevalidniStranka('Stránka ještě není správně vyplněna a tak kontroly neprošly a tak jsme nedostali data.');        
//        }
//        return $okStranka;
//        
//    }
    
    
    
}
        
//        /*  puvodne byl tento input */
//        $this->form->addElement(
//                'submit', 
//                $this->getButtonName('submit'),
//                ['value' => 'Pokračovat',
//                 'class' => 'flat',     /*'class' => 'bigred',*/ 
//                 'formaction'=>$formActionSubmit]
//            )->setLabel(
//                   '<span style="font-size: 9px;">'.'V případě, že jsou vyplněny odpovědí u všech úloh, <br> tlačítko uloží celý test.'.'</span>'
//                    );
                
  

