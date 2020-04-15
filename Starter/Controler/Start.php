<?php

use Pes\View\View;
use Pes\View\Renderer\PHPTemplateRenderer;

/**
 * Kontroler Start provede druhou fázi přihlášení k testu - potvrzení startu. Má metody pro vytvoření formuláře Start a pro přesměrování na test.
 *
 * @author pes2704
 */
class Starter_Controler_Start {
    
    /**
     * Metoda přijímá data odeslaná z formuláře Prihlas a vytvoří formulář Start, který zobrazí souhrnné informace o testu a startovací tlačítko.
     * Formulář Start slouží ke konečnému potvrzení startu testu.
     * 
     * @param array $post Pole POST, data odeslaná z formuláře Prihlas
     * @return string HTML o
     * @throws LogicException
     */
    public function getForm($post) {
        $Kampane = new Starter_Service_Kampane();        
        $info = $Kampane->getInfo($post['idtest']);                 
        
        if (!Starter_AppContext::isRunningOnProductionMachine()) { 
            $DbInfo = new Starter_Service_DbInfo();
            $infoDb = $DbInfo->getInfoDB();     
            $info = array_merge($info, $infoDb);
        }
        
        if ($info) {
            $view = new View((new PHPTemplateRenderer())->loadTemplate('templates/Start.php'));
            return $view->render($info);        
        } else {
            throw new LogicException('Nastala chyba. Kontroler start byl zavolán s neexistujícím číslem testu. Kontaktujte administratora.');
        }
    }
    
    /**
     * Metoda přijímá data odeslaná z formuláře Start a provede přesměrování na adresu testu. 
     * 
     * @param array $post
     * @throws LogicException
     */
    public function relocateToTestAndExit($post) {
        if (isset($post['idvzbosobakampan'])) {
            $urlTest = (new Starter_Service_TestUrlCreator())->create($post['idvzbosobakampan']);
            header('Location: '.$urlTest);
            exit;
        } else {
            throw new LogicException('Nelze přesměrovat na test, byly předány post údaje bez identifikace testu. Kontaktujte administrátora.');
        }
    }
}
