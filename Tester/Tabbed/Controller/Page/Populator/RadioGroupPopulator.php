<?php

class Tester_Tabbed_Controller_Page_Populator_RadioGroupPopulator extends Tester_Tabbed_Controller_Page 
                                                               implements Tester_Tabbed_Controller_Page_Populator_RadioGroupPopulatorInterface
{
    const IMAGES_PATH = 'public/obrazky/'; 
    
    /**
     *
     * @var Tester_Tabbed_Controller_Page_Populator_Parameters_RadioGroupParameters
     */
    private $populatorParameters;

 /*    
  *$populatorParameters - pro formulare  
    private $bezPravidel;    
    private $zobrazujVolbyOdpovedi;
  * jenCist
*/
 /*   
  * $pageParameters 
    private $formActionNav;
    private $formActionSubmit;
    private $formAction;    
    private $idUloha;       
    private $uloha;
*/
 
    
    public function initialize_setPopulParameters( 
            Tester_Tabbed_Controller_Page_Populator_Parameters_RadioGroupParametersInterface $populatorParameters) 
    {
        $this->populatorParameters = $populatorParameters;
    }     

    
    
    /**
     * Vytvori do formulare prvky pro jednu ulohu.
     */
    protected function populateForm()
    {
        $uloha = $this->pageParameters->getUloha();  
        $basePath = $this->pageParameters->getBasePath();
        $zobrazujZvoleneOdpovedi = $this->populatorParameters->getZobrazujZvoleneOdpovedi();
        
        $this->addTabs( $uloha->getNavigace()->getNapis() );       
        $this->form->setAttribute('action', $basePath . $this->pageParameters->getFormActionNav());
       
        $otazka = $uloha->getOtazka();
          /* @var $fieldset \HTML\QuickForm2 */ 
        $fieldset = $this->form->addElement('fieldset')->setLabel($otazka->getLegend());
        $imgFileName = $otazka->getZadani()->getObsah()->getImgFileName();
        if ($imgFileName) {
            //toto vytvori odkaz na obrazek
            //$fieldset->addElement('image', 'img'. $imgFileName , array('src' => $basePath.self::IMAGES_PATH . $imgFileName) );            
            
            $obrazek = $fieldset->addElement('static', 'obrazek');
            $obrazek->setContent( "<img src='" . $basePath.self::IMAGES_PATH . $imgFileName . "' />");
            //$obrazek->setLabel( "<img src='" . $basePath.self::IMAGES_PATH . $imgFileName . "' />");
            $obrazek->setLabel( "Obrázek k úloze " . $uloha->getNavigace()->getNapis() . ":" );
        }
        
       
        $zadani = $fieldset->addElement('static', 'zadani')
                ->setLabel($uloha->getOtazka()->getZadani()->getObsah()->getLabel())
                ->setContent($uloha->getOtazka()->getZadani()->getObsah()->getText());                
                
        $radioGroup = $fieldset->addElement('group')
                                 ->setLabel($uloha->getOtazka()->getZadani()->getOdpoved()->getData()->getLabel()  )                
                                   ->setSeparator('<br/>');
        
        //-------------------------- radia ------------
        if ($uloha->getOtazka()->getZadani()->getOdpoved()->getType()== 'radia' ) {
                    
            foreach ($uloha->getOtazka()->getZadani()->getOdpoved()->getData()->getContent()   as $key => $value ) {                     
                //---- ziskani spravne odpovedi pro radia, - pro jine mozna jinak
                $valueZobrazovaci = $value;
                if ($uloha->getOtazka()->getZadani()->getOdpoved()->getType() == 'radia' ) {                                           

                    //$C = $this->getController();  // page tabeddTesterovyController  // $Id = $C->getId();  //  Id tabbedu je 'Tabbed'
                    $odpovediZTabbedControlleruArray = $this->getController()->getValue();  //pole odpovedi   
                    $okOdpoved = $uloha->getOtazka()->getZadani()->getOdpoved()->getData()->getOk();                               
                             
                    // $parPopul = $this->populatorParameters;
                    $IdUloha = $this->pageParameters->getIdUloha();  
                    if ($zobrazujZvoleneOdpovedi)  {
                        if (isset ($odpovediZTabbedControlleruArray[$IdUloha]) ) {
                            if ( ($key == $odpovediZTabbedControlleruArray [$IdUloha]) ) {   
                                if  ($key == $okOdpoved) {
                                    $valueZobrazovaci .=  '<span class="spravnaVolba">  vaše volba </span>'  ; 
                                }else {
                                    $valueZobrazovaci .=  '<span class="vaseVolba">  vaše volba - chyba</span>'  ; }                         
                            }   
                        }                                                                                                       
                        if ( ($key == $okOdpoved)  ) { 
                            $valueZobrazovaci .=  '<span class="spravnaVolba"> správná volba </span> '  ;                        
                        }  
                    } //vypisovane informace patri do parametru - asi ulohy
                                       
                    $el = $radioGroup/*$elpara*/->addElement('group');
                    $el->addElement('hidden');
                    $el->addElement('radio',
                                            $this->pageParameters->getIdUloha(),    /*tj. name inputu*/                       
                                            array( 'value' => $key ),                                           
                                            array( 'content' => $valueZobrazovaci ) ); /* to da do <label></label>*/
                }
            //$el->
            } //foreach
            
           
        }
        
        
        if (!$this->populatorParameters->getJenCist()) {
            if (!$this->populatorParameters->getBezPravidel()) {
                    $radioGroup->addRule('required', 'Vyberte jednu odpověď!');
            }      
            //tlacitko Pokracuj
            if (!$this->populatorParameters->getBezPravidel()) {
                    $this->addGlobalSubmit( $basePath . $this->getPageParameters()->getFormActionSubmit() );
            }
        }
        
    }
    
    
//    
//     public function storeValues($validate = true)
//    {
//        $this->populateFormOnce();
//        $container = $this->getController()->getSessionContainer();
//        $id        = $this->form->getId();
//
//        $container->storeValues($id, (array)$this->form->getValue());
//        if ($validate) {
//            $container->storeValidationStatus($id, $this->form->validate());
//        }
//        return $container->getValidationStatus($id);
//    }
    
    

}
