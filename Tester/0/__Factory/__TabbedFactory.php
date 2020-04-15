<?php
namespace Tester\Tabbed\Factory;

use Tester_Tabbed_Controller_Page_Parameters_PageParameters;
use \Tester_Tabbed_TesterovyController;



/**
 * Obsahuje metodu create, kde je provedeno vytvoření 
 * a nastavení Controleru vicestrankoveho formulare (pojmenovali jsme ho tabbed).
 * Presunuto do ContainerConfiguration.  Jsou tu poznamky, kvuli kterym bych to nechtela smazat.
 *
 * @author vlse2610
 */
class __TabbedFactory implements TabbedFactoryInterface {
    
    private $jenCist = FALSE;    
    private $zobrazujZvoleneOdpovedi = FALSE;  // ZELENE A CERVENE          
     /**
     * V konstruktoru se nastavují parametry,  podle kterých bude formulář fungovat - 
     * -  volba zobrazování informace  o "správnosti" zvolené odpovědi.
     * 
     * @param bool $jenCist  true - Formular neni aktivni, nelze volit odpovedi.
     * @param bool $zobrazujZvoleneOdpovedi    
     */      
    public function __construct( bool $zobrazujZvoleneOdpovedi, bool $jenCist = \FALSE  ) {
        $this->jenCist = $jenCist;
        $this->zobrazujZvoleneOdpovedi = $zobrazujZvoleneOdpovedi;        
    }
        
    /**
     * Vytvoří a definuje kontroler pro obsluhu vícestránkového formuláře.
     * @param $ulohyTestuArray Uloha array of  
     * 
     * @return Tester_Tabbed_TesterovyController
     */
    public function create( /*Container $container  */ /*ve finale nema byt ??? */     $ulohyTestuArray ) {         
        $tabbed = new \Tester_Tabbed_TesterovyController('Tabbed', false); 
        
        foreach ($ulohyTestuArray as $idUloha=>$uloha) {
            // $idUloha se použije jako idPage          
            
            /* @var  $pageAutomat \Tester_Tabbed_Controller_Page_Populator_RadioGroupPopulatorForJenCist */
            $pageAutomat = new \Tester_Tabbed_Controller_Page_Populator_RadioGroupPopulator(new \HTML_QuickForm2( $idUloha, 'post', NULL, FALSE));
                                                                    //$id, $method = 'post', $attributes = null, $trackSubmit = true                 
            //nastaveni parametru Page Parameters
            $pageParameters = new Tester_Tabbed_Controller_Page_Parameters_PageParameters();
            $pageParameters->setFormActionNav('http://localhost/TesterVScviceni/Tester/prechod/')
                           ->setFormActionSubmit('http://localhost/TesterVScviceni/Tester/odpoved/')
                           ->setFormAction('http://localhost/TesterVScviceni/Tester/cokoli')
                           ->setIdUloha($idUloha)
                           ->setUloha($uloha) ;
            $pageAutomat->setPageParameters($pageParameters);    
            
            //nastaveni parametru Populator Parameters               
            $pageAutomat->initialize_setPopulParameters ( (new \Tester_Tabbed_Controller_Page_Populator_Parameters_RadioGroupParameters())
                                    ->setBezPravidel(\FALSE)
                                    ->setZobrazujZvoleneOdpovedi($this->zobrazujZvoleneOdpovedi)
                                    ->setJenCist($this->jenCist)                                    
            );             
            $tabbed->addPage($pageAutomat);
          
            // -------These actions manage going directly to the pages with the same name
            // $idUloha byla použita jako idPage
            $tabbed->addHandler($idUloha, new \HTML_QuickForm2_Controller_Action_Direct());
        }         
        
        //***************************
        // We actually add these handlers here for the sake of example
        // They can be automatically loaded and added by the controller
        //$tabbed->addHandler('submit', new \HTML_QuickForm2_Controller_Action_Submit());
        //z containeru budu potrebovat $sessionHandler
        //$tabbed->addHandler('submit', new \Tester_Tabbed_Handler_Submit($container) ); //jsme zrusili
       
        //$tabbed->addHandler('jump', new \HTML_QuickForm2_Controller_Action_Jump());        
        //$tabbed->addHandler('jump', new \Tester_Tabbed_Handler_Jump( ));       //jsme zrusili     

        // This is the action we should always define ourselves
        //$tabbed->addHandler('process', new \Tester_Tabbed_Handler_Process( ));
       
        // We redefine 'display' handler to use the proper stylesheets        
        if ($this->jenCist) {
            $tabbed->addHandler('display', new \Tester_Tabbed_Handler_DisplayFrozen(/* $container*/ ));        
        } else {
            $tabbed->addHandler('display', new \Tester_Tabbed_Handler_Display( /*$container*/ ));        
        }
        
        return $tabbed;        
    }
}

