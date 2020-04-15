<?php

class PageUloha01F extends Tester_Tabbed_Controller_Page
{
    protected function populateForm()
    {
        $this->addTabs();

        $fs = $this->form->addElement('fieldset')->setLabel('Foo page');

        $radioGroup = $fs->addElement('group')->setLabel('Do you want this feature?')
                         ->setSeparator('<br />');
        $radioGroup->addElement('radio', 'iradYesNoMaybe', array('value' => 'Y'), array('content' => 'Yes'));
        $radioGroup->addElement('radio', 'iradYesNoMaybe', array('value' => 'N'), array('content' => 'No'));
        $radioGroup->addElement('radio', 'iradYesNoMaybe', array('value' => 'M'), array('content' => 'Maybe'));

        $fs->addElement('text', 'tstText', array('size'=>20, 'maxlength'=>50))
           ->setLabel('Why do you want it?');

        $radioGroup->addRule('required', 'Check a radiobutton');

        $this->addGlobalSubmit();
    }
}

class PageUloha02F extends Tester_Tabbed_Controller_Page
{
    protected function populateForm()
    {
        $this->addTabs();

        $fs = $this->form->addElement('fieldset')->setLabel('Bar page');

        // XXX: no date element yet
        $dateGroup = $fs->addElement('group', 'favDate')->setLabel('Favourite date:')
                        ->setSeparator('-');
        for ($i = 1, $doptions = array(); $i <= 31; $i++) {
            $doptions[$i] = sprintf('%02d', $i);
        }
        $dateGroup->addElement('select', 'd')->loadOptions($doptions);
        $dateGroup->addElement('select', 'M')->loadOptions(array(
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 5 => 'June',
            7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ));
        for ($i = 1950, $yoptions = array(); $i <= date('Y'); $i++) {
            $yoptions[$i] = $i;
        }
        $dateGroup->addElement('select', 'Y')->loadOptions($yoptions);


        $checkGroup = $fs->addElement('group', 'favLetter')->setLabel('Favourite letters:')
                         ->setSeparator(array('&nbsp;', '<br />'));
        foreach (array('A', 'B', 'C', 'D', 'X', 'Y', 'Z') as $letter) {
            $checkGroup->addElement('checkbox', $letter)->setContent($letter);
        }

        $this->addGlobalSubmit();
    }
}

class PageUloha03F extends Tester_Tabbed_Controller_Page
{
    protected function populateForm()
    {
        $this->addTabs();

        $fs = $this->form->addElement('fieldset')->setLabel('Baz page');

        $poem = $fs->addElement('textarea', 'textPoetry', array('rows' => 5, 'cols' => 40))
                   ->setLabel('Recite a poem:');
        $fs->addElement('textarea', 'textOpinion', array('rows' => 5, 'cols' => 40))
           ->setLabel('Did you like this demo?');

        $poem->addRule('required', 'Pretty please!');

        $this->addGlobalSubmit();
    }
}



class PageRadioGroupUloha01 extends Tester_Tabbed_Controller_Page
{
    protected function populateForm()
    {
        $this->addTabs();


        $fs = $this->form->addElement('fieldset')->setLabel('Úloha 1');    
        
             //$fsZadání = $fs->addElement('fieldset')->setLabel('<span style="">Zadání</span>');                
        $fs->addElement('static', 'istat')->setContent('<div style="float:left; background-color:red; padding:5px;">kljasdfhuklůawerznlrzulz</div>')
                   ->setLabel('lablavlalalalalal');
        
        $radioGroup = $fs->addElement('group')
                         ->setLabel('Jaký operátor <br> použijete pro dělení?')
                         ->setSeparator('<br />');   //separator mezi radio
        $radioGroup->addElement('radio', 'iradgroupUloha01', array('value' => '1'), array('content' => '%'));
        $radioGroup->addElement('radio', 'iradgroupUloha01', array('value' => '2'), array('content' => ':'));
        $radioGroup->addElement('radio', 'iradgroupUloha01', array('value' => '3'), array('content' => 'div'));
        $radioGroup->addElement('radio', 'iradgroupUloha01', array('value' => '4'), array('content' => '/')); 

        $radioGroup->addRule('required', 'Vyberte jednu odpověď');

        $this->addGlobalSubmit();
    }
}


class PageRadioGroupUloha02 extends Tester_Tabbed_Controller_Page
{
    protected function populateForm()
    {
        $this->addTabs();

     
        $fs = $this->form->addElement('fieldset')->setLabel('Úloha 2');
        $fs->addElement(
          'image', 'imuloha02', array('src' => 'obrazky/uloha02.jpg')
        );

        $radioGroup = $fs->addElement('group')
                         ->setLabel('Jaký vzorec bude v buňce C6 pro výpočet průměrné denní navštěvnosti za leden?')
                         ->setSeparator('<br />');   //separator mezi radio
        $radioGroup->addElement('radio', 'iradgroupUloha02', array('value' => '1'), array('content' => '11051/31'));
        $radioGroup->addElement('radio', 'iradgroupUloha02', array('value' => '2'), array('content' => 'C5/31'));
        $radioGroup->addElement('radio', 'iradgroupUloha02', array('value' => '3'), array('content' => 'C5:3'));
        $radioGroup->addElement('radio', 'iradgroupUloha02', array('value' => '4'), array('content' => '11051:31')); 

        $radioGroup->addRule('required', 'Vyberte jednu odpověď');

        $this->addGlobalSubmit();
    }
}



class PageCheckGroupUloha03 extends Tester_Tabbed_Controller_Page
{
    protected function populateForm()
    {
        $this->addTabs();

        $fs = $this->form->addElement('fieldset')->setLabel('Úloha 3');
               
       
        $checkGroup = $fs->addElement('group', 'icheckgroupUloha03')->setLabel('Které barvy máte rád/a?')
                         //->setSeparator(array('&nbsp;', '<br />'));
                         ->setSeparator(array( '<br />'));    
            $checkGroup->addElement('checkbox', 'icheckgroupUloha03_1')->setContent('bílá');
            $checkGroup->addElement('checkbox', 'icheckgroupUloha03_2')->setContent('černá');
            $checkGroup->addElement('checkbox', 'icheckgroupUloha03_3')->setContent('zelená');
            $checkGroup->addElement('checkbox', 'icheckgroupUloha03_4')->setContent('žlutá');
            $checkGroup->addElement('checkbox', 'icheckgroupUloha03_5')->setContent('oranžová');
            $checkGroup->addElement('checkbox', 'icheckgroupUloha03_6')->setContent('červená');
            $checkGroup->addElement('checkbox', 'icheckgroupUloha03_7')->setContent('modrá');
            $checkGroup->addElement('checkbox', 'icheckgroupUloha03_8')->setContent('zelená');
            $checkGroup->addElement('checkbox', 'icheckgroupUloha03_9')->setContent('červená');
          
        $checkGroup->addRule('required', 'Vyberte alespoň jednu odpověď!');
        
        $this->addGlobalSubmit();
    }
}

