<?php

class Tester_Tabbed_Controller_Page_Populator_RadioGroup extends Tester_Tabbed_Controller_Page
{
    protected function populateForm()
    {
        $this->addTabs();

        
        $fs = $this->form->addElement('fieldset')->setLabel('label pagee');
        
        $fs->addElement(
          'image', 'srdickoImage1', array('src' => 'obrazky/16.gif')
        );

        $radioGroup = $fs->addElement('group')->setLabel('Vyberte odpověd:')
                         ->setSeparator('<br />');
        $radioGroup->addElement('radio', 'iradgroupUlohaXY', array('value' => '1'), array('content' => 'odpoved1'));
        $radioGroup->addElement('radio', 'iradgroupUlohaXY', array('value' => '2'), array('content' => 'odpoved2'));
        $radioGroup->addElement('radio', 'iradgroupUlohaXY', array('value' => '3'), array('content' => 'odpoved3'));       

        $radioGroup->addRule('required', 'Vyberte jednu odpověď!');

        $this->addGlobalSubmit();
    }
    
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

