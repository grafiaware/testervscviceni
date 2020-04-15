<?php

/**
 * Description of Tester_Tabbed_DisplayFrozen
 *
 * @author vlse2610
 */
class Tester_Tabbed_Handler_DisplayFrozen  extends HTML_QuickForm2_Controller_Action_Display /*extends Tester_Tabbed_Handler_DisplayCommon*/ {
 
    protected function renderForm(HTML_QuickForm2 $form) {      
        $renderer = HTML_QuickForm2_Renderer::factory('default');
        $renderer->setTemplateForId('tabs', '<div class="floatRight" >{content}</div>');
        //$renderer->setOption('required_note', " <em>*</em> povinná odpověď");

        $form->toggleFrozen(true);
        $content = $form->render($renderer);  
                
        return $content;
    }
}
