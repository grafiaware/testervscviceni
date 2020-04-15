<?php
namespace Tester\Controler;

use Tester\Model\Aggregate\Entity as AggEntity;
use Tester\Model\Aggregate\Repository as AggRepo; 

use Pes\View\View;
use Pes\View\Template\PhpTemplate;


/**
 * Z odpovedí na všechny otázky testu jedné osoby  a  správných odpovědí vytváří výstupy.
 */
class Vysledky {
    private $testAggregateRepoFactory;
    private $odpovedAggregateRepoFactory;
    /**
     *
     * @var  AggEntity\TestAggregate 
     */
    private $spustTestAggregateEntity;     
    /**
     *
     * @var AggEntity\OdpovedAggregate 
     */
    private $odpovedAggregateEntity;                
    private $konfiguraceTestu;
    private $otazky;    
    
       
    public function __construct ( 
              Repo\SpustenyTestAggregateRepoFactory $spustenyTestAggregateRepoFactory,
                AggRepo\OdpovedAggregateRepoFactory $odpovedAggregateRepoFactory                                  
                                ) {
        assert(FALSE, "Zapomenutý čert!!");
        
        $this->testAggregateRepoFactory = $spustenyTestAggregateRepoFactory->create();        
        $this->odpovedAggregateRepoFactory = $odpovedAggregateRepoFactory->create();
        
        $this->spustTestAggregateEntity = $this->testAggregateRepoFactory->get();
        $idST = $this->spustTestAggregateEntity->stav->idDbEntityPrubehTestu;
        $this->odpovedAggregateEntity =  $this->odpovedAggregateRepoFactory->getByPrubehTestuId($idST) ;
                
        $this->otazky = $this->spustTestAggregateEntity->ulohy;   
        $this->konfiguraceTestu = $this->spustTestAggregateEntity->konfiguraceTestu;       
    } 
     
 
    
    /**
     * Vytváří výstup z dodaných dat - pole odpovědí, pole správných odpovědí
     * použije templates/templateVystup.php.
     * 
     * @return string html kód pro zobrazení
     */
    public function getVypisHTML() { 
                       
        $nazevSady = $this->spustTestAggregateEntity->sadaOtazek->nazevSady;
        $repoSpravneOdpovedi = new \Tester\Model\File\Repository\__Odpovedi();
        $poleSpravnychOdpovedi = $repoSpravneOdpovedi->find($nazevSady);             //spravne odpovedi jsou v souboru   
        
        $poleProTemplate = array();
        $poleTmplRadka = array();
        $dataDoTmpl = array();
        $dataDoTmpl['prijmeni'] = 'CVICNEprijmeni********';
        
        $poleOdpovediUzivatele = $this->odpovedAggregateEntity->odpovediNaOtazky; // to co odpovedel uzivatel
        foreach( $poleOdpovediUzivatele as $key=>$jednaodpoved /*as  $key => $value*/) {
            $poleTmplRadka['identifikatorOdpovedi'] = $jednaodpoved->identifikatorOdpovedi;
            $poleTmplRadka['odpoved'] = $jednaodpoved->hodnota;
            $poleTmplRadka['spravnaOdpoved'] = $poleSpravnychOdpovedi[$jednaodpoved->identifikatorOdpovedi]; //$poleSpravnychOdpovedi[$indexSpravnychOdpovedi]['odpoved'];
            if  ( ($poleTmplRadka['odpoved']) == $poleTmplRadka['spravnaOdpoved'] ){
                $poleTmplRadka['spravneY/N'] = \TRUE; 
            } else {
                $poleTmplRadka['spravneY/N'] = \FALSE; 
            }
            $poleProTemplate[] = $poleTmplRadka;            
        }   
        $dataDoTmpl[ 'poleProTemplate']  = $poleProTemplate;
        
//  $poleProTemplate ['nazevTestu'] = $this->konfiguraceTestu->nazevTestu;
//        $poleProTemplate ['vstupHtmlForm'] = $this->htmlFormular; 
//        
        $T = new PhpTemplate('templates/templateVystup.php');  //vytvori objekt Template a nastavi mu jmenosouboru s templatou
        $view = new View();                                    //vytvori objekt View       
        $vystupS = $view->setTemplate($T)->setData($dataDoTmpl)->render();
             // pouzije v sobe nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi napr.echem       
        return $vystupS;        
    }    
}




//
////use Pes\View\Template\TemplateInterface;
//use Pes\View\Template\PhpTemplate; //\TemplatePhp;
////use Pes\View\Renderer\PhpRenderer; //RendererPhp;
//use Pes\View\View;
////use Pes\View\ViewFactory;
//use Tester\Model\Db\RowObject\KonfiguraceTestu;
//
///**
// * Description of OtazkaTab
// *
// * @author vlse2610
// */
//class VstupniOtazkaTab {
//    /**
//     * @var ParametryTestuInterface $parametryTestu
//     * @var $htmlFormular - html kod pro zobrazeni otazky testu (tj. vyrenderovany formular jedne otazky testu), vznikne v $tabbed->run(), 
//     */
//   
//    private $konfiguraceTestu;
//    private $htmlFormular;
//    /**
//     * 
//     * @param KonfiguraceTestu $konfiguraceTestu
//     * @param type $htmlFormular
//     */
//     public function __construct( KonfiguraceTestu  $konfiguraceTestu, $htmlFormular  ) {
//       
//         $this->konfiguraceTestu = $konfiguraceTestu;
//         $this->htmlFormular = $htmlFormular;
//    }
//    
//     public function getVypisHTML() {
//
////        $T = new PhpTemplate('templates/templateVstupniFormular.php');
////        $renderer = new PhpRenderer($T);             //vytvori objekt Renderer (pro html) a nastavi mu objekt Template
////        $view = new View($renderer);
////        
////        $dataDoVstupForm ['nazevTestu'] = $this->konfiguraceTestu->nazevTestu;
////        $dataDoVstupForm ['vstupHtmlForm'] = $this->htmlFormular;           
////
////        $vystupS = $view->render( $dataDoVstupForm );         
////        return $vystupS;  
//        //------------------------------------------------------
//        
//        $poleProTemplate ['nazevTestu'] = $this->konfiguraceTestu->nazevTestu;
//        $poleProTemplate ['vstupHtmlForm'] = $this->htmlFormular; 
//        
//        $T = new PhpTemplate('templates/templateVstupniFormular.php');  //vytvori objekt Template a nastavi mu jmenosouboru s templatou
//        $view = new View();            //vytvori objekt View       
//        $vystupS = $view->setTemplate($T)->setData($poleProTemplate)->render();
//             // pouzije v sobe nastaveny Renderer a z predanych dat udela vystup.retezec, ten se pak zobrazi napr.echem       
//               
//        return $vystupS;  
        
        