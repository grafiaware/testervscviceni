<?php

use Pes\View\View;
use Pes\View\Renderer\PHPTemplateRenderer;

/**
 * Kontroler provede první fázi přihlášení k testu - zadání a kontrolu přihlašovacích údajů.
 * 
 * @author pes2704
 */
class Starter_Controler_Prihlas {
    
    /**
     * @var Starter_Service_SigninInfoChecker 
     */
    private $checker;
    
    /**
     * Vytvoří HTML obsah přihlašovacího formuláře Prihlas pro zadání přihlašovacích informací.
     * Přijímá test chybového hlášení a data odeslaná formulářem Prihlas a je ji tedy možné volat jak pro vytvoření 
     * prvního prázdného formuláře, tak i znovu při selhání kontroly přihlašovacích údajů, tedy pro opravu přihlkašovacích údajů.
     * Ve formuláři zobrazí předané chybové hlášení a data odeslaná při předchozím zobrazení formuláře.
     * 
     * @param boolean $showMessage Pokud je TRUE zobrazí se ve formuláři poslední možná příčina selhání kontroly přihlašovacích údajů metodou check() jako hlášení o chybě.
     * @param type $post Pole POST odeslané při předchozím zorazení formuláře. Nepovinný parametr, pokud je zadán formulář se zobrazí předvyplněný těmito daty k opravě.
     * @return string HTML kód formuláře
     */
    public function getForm($showMessage=FALSE, $post=array()) {
        $message = $showMessage ? $this->checker->getLastMessage() : NULL;
        $view = new View((new PHPTemplateRenderer())->loadTemplate('templates/Prihlaseni.php'));
        return $view->render(array_merge(array('message'=> $message), $post));    
    }
    
    /**
     * Metoda provede kontrolu dat odeslaných formulářem Prihlas. Pro tuto kontrolu použije objekt Starter_Service_SigninInfoChecker().
     * 
     * @param array $post Pole POST odeslané formulářem Prihlas
     * @return boolean
     */
    public function check($post) {
        ## KONTROLA EXISTENCE ID TESTU ##
        $this->checker = new Starter_Service_SigninInfoChecker();
        return $this->checker->check($post);  
    }
}
