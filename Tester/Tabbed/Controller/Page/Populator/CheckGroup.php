<?php

class Tester_Tabbed_Controller_Page_Populator_CheckGroup extends Tester_Tabbed_Controller_Page
{
    protected function populateForm()
            //TODO  jsou ty  lokalni styly, to nechceme
    {
        $this->addTabs();
        

        $fs = $this->form->addElement('fieldset')->setLabel('label page');
        
        $fs->addElement(
          'image', 'srdickoImage1', array('src' => 'obrazky/16.gif')
        );
       
        $checkGroup = $fs->addElement('group', 'icheckgroupUlohaXZ')->setLabel('Vyberte všechny vyhovující odpovědi:')
                         //->setSeparator(array('&nbsp;', '<br />'));
                         ->setSeparator(array( '<br />',' objeden<br />'));    
            $checkGroup->addElement('checkbox', 'icheckgroupUlohaXY_1')->setContent('odpoved Adsdft');
            $checkGroup->addElement('checkbox', 'icheckgroupUlohaXY_2')->setContent('odpoved bsdfdsf');
            $checkGroup->addElement('checkbox', 'icheckgroupUlohaXY_3')->setContent('odpoved csdfsd');
            $checkGroup->addElement('checkbox', 'icheckgroupUlohaXY_4')->setContent('odpoved dsdf');
            $checkGroup->addElement('checkbox', 'icheckgroupUlohaXY_5')->setContent('odpoved effff');
            $checkGroup->addElement('checkbox', 'icheckgroupUlohaXY_6')->setContent('odpoved fweee');
            $checkGroup->addElement('checkbox', 'icheckgroupUlohaXY_7')->setContent('odpoved gnnnn');
            $checkGroup->addElement('checkbox', 'icheckgroupUlohaXY_8', array('value' => 'red'))->setContent('<span style="color: #f00;">Red</span>');

        $checkGroup->addRule('required', 'Vyberte alespoň jednu odpověď!');
        
        
    }
}

