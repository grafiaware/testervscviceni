<?php
$ulohy = array(
    array(
        'id' => '1',               //max.2 znaky - pouzito na propojeni kodu
        'legend' => 'Úloha 1',
        'img_file_name' => '',
        'zadani' => array(
            'label' => 'Odpovězte na otázku:',
            'text' =>  'Jaký operátor použijete pro dělení?!'
         ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',            //nepouzito
            'content' => array(
                '%',
                ':',
                'div',
                '/'
                )     
         )
    ),
    array(
        'id' => '2',
        'legend' => 'Úloha 2',
        'img_file_name' => 'uloha02.jpg',
        'zadani' => array(
            'label' => 'Odpovězte na otázku:',
            'text' => 'Jaký vzorec bude v buňce C6 pro výpočet průměrné denní navštěvnosti za leden?'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                '=11051/31',
                '=C5/31',
                '=C5:3',
                '=11051:31'
                )     
            )
        ),    
    
     array(
        'id' => '3',
        'legend' => 'Úloha 3',
        'img_file_name' => 'uloha03.gif',
        'zadani' => array(
            'label' => 'Odpovězte na otázku:',
            'text' => 'Jaký vzorec vložíte do buňky C2, aby obsahoval druhou mocninu buňky B2? '
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                '=A2*B2',
                '=A2*A2',
                '=B2^2',
                '=B2/B2'
                )     
            )
        ),    
    
    
    array(
        'id' => '4',
        'legend' => 'Úloha 4',
        'img_file_name' => 'uloha04.gif',
        'zadani' => array(
            'label' => 'Odpovězte na otázku:',
            'text' => 'Jaký vzorec byste napsali do buňky D2?'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                '=B2+B2*C2',
                '=B2*C2',
                'B2*C2+B2',
                '=B2+C2'
                )     
            )
        ),    
    
    
    
    array(
        'id' => '5',
        'legend' => 'Úloha 5',
        'img_file_name' => 'uloha05.gif',
        'zadani' => array(
            'label' => 'Odpovězte na otázku:',
            'text' => 'Jaký vzorec musíte napsat do buňky C12, abyste jej mohli zkopírovat do celé tabulky? '
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                '=C$11$/D2',
                '=C$11/$D2',
                '=C11$/$D2',
                '=C$11/D$2'
                )     
            )
        ),    
        
        
      array(
        'id' => '6',
        'legend' => 'Úloha 6',
        'img_file_name' => 'uloha06.gif',
        'zadani' => array(
            'label' => 'Odpovězte na otázku:',
            'text' => 'Která z následujících funkcí sečte hodnoty A až D ve všech řádcích?'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                '=SUMA(A2:D2)',
                '=SUMA(A2:D4)',
                'SUMA(A2:D4)',
                '=(A2:D4)'
                )     
            )
        ),       
     	 
    
    
    array(
        'id' => '7',
        'legend' => 'Úloha 7',
        'img_file_name' => 'uloha07.jpg',
        'zadani' => array(
            'label' => 'Doplňte:',
            'text' => 'Tabulku na obrázku chceme kopírovat. <br/>Tato tabulka je barevně upravená, má nastaveno ohraničení, obsahuje i vzorce. <br/>Platí, že při běžném kopírování (pomocí příkazů Kopírovat/Vložit)'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'se překopírují jenom texty , nikoli vzorce, barvy a ohraničení',
                'se překopírují jenom texty a vzorce, nikoli barvy a ohraničení',
                'se překopíruje vše, co tabulka obsahuje, včetně vzorců, barev, ohraničení'
                )     
            )
        ),      
    
    
    
     array(
        'id' => '8',
        'legend' => 'Úloha 8',
        'img_file_name' => 'uloha08.jpg',
        'zadani' => array(
            'label' => 'Doplňte:',
            'text' => 'Potřebujeme okopírovat pouze vzhled tabulky, nikoli vyplněné údaje ani vzorce.'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'to v Excelu nejde, tabulka se okopíruje vždy celá<br/>',
                'jediná možnost je, okopírovat tabulku celou, se vším všudy <br/>a z kopie potom údaje a vzorce smazat pomocí klávesy DELETE<br/>',
                'pro vložení kopie tabulky použijeme příkaz Vložit jinak, přičemž označíme volbu Formáty<br/>',
                'označíme kopii tabulky a zadáme příkaz Vyprázdnit tabulku<br/>'
                )     
            )
        ),      
        
        
        
      array(
        'id' => '9',
        'legend' => 'Úloha 9',
        'img_file_name' => '',
        'zadani' => array(
            'label' => 'Doplňte:',
            'text' => 'V tabulce jsme nastavili základní ohraničení, ale některé čáry bychom potřebovali zvýraznit.'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'můžeme je zvýraznit jenom silnější nebo dvojitou čarou',
                'můžeme je zvýraznit pouze změnou barvy, se sílou čáry nelze nic dělat',
                'můžeme je zvýraznit dvojitou čarou, silnou čarou a současně i barvou'                
                )     
            )
        ),        
        
        
        
         array(
        'id' => '10',
        'legend' => 'Úloha 10',
        'img_file_name' => '',
        'zadani' => array(
            'label' => 'Doplňte:',
            'text' => 'Vzorec může odkazovat'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'pouze na buňku (buňky) umístěné na stejném listě',
                'pouze na buňku (buňky) umístěné ve stejném sešitě',
                'na buňku (buňky), které mohou být umístěny ve stejném nebo i v jiném sešitě'                
                )     
            )
        ),        
    
    
       array(
        'id' => '11',
        'legend' => 'Úloha 11',
        'img_file_name' => '',
        'zadani' => array(
            'label' => 'Doplňte:',
            'text' => 'Zapíšeme do buňky vzorec:  =SUMA(A1:A3;B1:B3;C1:C3). Tento vzorec'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'nemá žádný argument',
                'má tři argumenty',
                'má šest argumentů'                
                )     
            )
        ),        
    
      
       array(
        'id' => '12',
        'legend' => 'Úloha 12',
        'img_file_name' => 'uloha12.jpg',
        'zadani' => array(
            'label' => 'Doplňte:',
            'text' => 'Vzorec na obrázku odkazuje na list1. Jestliže list1 odstraníme'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'nic se nestane, výsledek vypočítaný vzorcem se nezmění',
                'vzorec přestane pracovat',
                'v takovém případě není vůbec možné list1 odstranit'                
                )     
            )
        ),        
    
    
       array(
        'id' => '13',
        'legend' => 'Úloha 13',
        'img_file_name' => 'uloha13.jpg',
        'zadani' => array(
            'label' => 'Doplňte:',
            'text' => 'Ve žluté buňce je v tomto případě'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'vzorec',
                'pouhé číslo',
                'z tohoto obrázku nelze poznat, zda je v buňce vzorec nebo pouhé číslo'                
                )     
            )
        ),       
    
    
    
        array(
        'id' => '14',
        'legend' => 'Úloha 14',
        'img_file_name' => '',
        'zadani' => array(
            'label' => 'Doplňte:',
            'text' => 'V tabulce máme sloupec s názvy obcí. <br/>Z tohoto sloupce máme filtrovat města začínající písmenem A a B.<br/> Máme přitom použít automatický filtr.'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'to nelze, automatický filtr  filtruje pouze obce od A nebo pouze města od B<br/>',
                'lze to obejít pouze tím, že si vyfiltrujeme obce od A, zkopírujeme je na jiný list<br/> a potom vyfiltrujeme obce od B a také je zkopírujeme<br/>',
                'ano, můžeme takto nastavit filtr bez problémů<br/>'                
                )     
            )
        ),       
        
        
        array(
        'id' => '15',
        'legend' => 'Úloha 15',
        'img_file_name' => '',
        'zadani' => array(
            'label' => 'Doplňte:',
            'text' => 'Logická vazba (vztah) platí také při nastavení filtrů ve více sloupcích. <br/>V případě automatického filtru platí u podmínek uplatněných na více sloupcích'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'v případě nastavení automatického filtru použitého na více sloupcích <br/>se uplatňuje vždy jenom logická vazba A (tj. nastavené podmínky platí vždy současně)<br/>',
                'v případě nastavení automatického filtru použitého na více sloupcích <br/>se uplatňuje vždy jenom logická vazba NEBO (tj. pokud platí pouze jedna z nastavených podmínek)<br/>',
                'uživatel si může nastavit, zda mezi podmínkami nastavenými na více sloupcích <br/> (při použití automatického filtru) bude platit logická vazba A či NEBO<br/>'                
                )     
            )
        ),       
    
    
    
       array(
        'id' => '16',
        'legend' => 'Úloha 16',
        'img_file_name' => '',
        'zadani' => array(
            'label' => 'Doplňte:',
            'text' => 'V tabulce máme nastaven automatický filtr pro více sloupců současně.<br/> V některých sloupcích bychom však potřebovali filtr zrušit'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'to nelze - musíme vypnout celý filtr <br/>a pak jej znovu nastavit jenom v těch sloupcích, kde potřebujeme<br/>',
                'to je jednoduché - zobrazíme dialogové okno Upravit filtrování <br/>a potom označíme ty sloupce, u nichž potřebujeme filtr vypnout<br/>',
                'filtr můžeme u kteréhokoli jednotlivého sloupce kdykoli zrušit, <br/>ponecháme tedy jenom filtrování potřebných sloupců<br/>'                
                )     
            )
        ),       
        
        
        array(
        'id' => '17',
        'legend' => 'Úloha 17',
        'img_file_name' => 'uloha17.jpg',
        'zadani' => array(
            'label' => 'Doplňte:',
            'text' => 'Z obrázku je zřejmé, že v tabulce'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'se používá filtr pro údaje ve sloupci A',
                'se používá filtr pro údaje ve sloupci A, D, E, F',
                'se používá filtr ve sloupcích B a C'                
                )     
            )
        ),       
    
      array(
        'id' => '18',
        'legend' => 'Úloha 18',
        'img_file_name' => '',
        'zadani' => array(
            'label' => 'Pokyn:',
            'text' => 'Vyberte odpověď a stiskněte ttlačítko Pokračuj jen v  případě,<br/> že jste již na všechny otázky odpověděli a chcete test ukončit.<br/><br/>' .
                       ' <b>Chcete-li se k některým otázkám vrátit, použijte tlačítka v záhlaví formuláře!</b><br/><br/>'
            ),
        'radia' => array(
            'label' => 'Vyberte odpověď:',
            'name' => 'odpoved',
            'content' => array(
                'ukončit'
                                            
                )     
            )
        ),       
        
    
    );

