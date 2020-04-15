<?php
use Pes\Session\SessionStatusHandler;

class Tester_Tabbed_Handler_Display  extends HTML_QuickForm2_Controller_Action_Display  {
    /**
     * 
     * @param HTML_QuickForm2 $form
     * @return string HTML
     */
    protected function renderForm(HTML_QuickForm2 $form) {
//        /* @var $sessionHandler SessionStatusHandler */
//        $sessionHandler = $this->container->get(SessionStatusHandler::class);
//        $content = $sessionHandler->get($this->container->get('invalidHtmlForm'));
//        if (! $content) {
            $renderer = HTML_QuickForm2_Renderer::factory('default');
            $renderer->setTemplateForId('tabs', '<div class="floatRight" >{content}</div>');
            $renderer->setOption('required_note', " <em>*</em> povinná odpověď");
            $content = $form->render($renderer);
//        } else {
//            $sessionHandler->delete($this->container->get('invalidHtmlForm'));
//        }
        return $content;
    }
}
