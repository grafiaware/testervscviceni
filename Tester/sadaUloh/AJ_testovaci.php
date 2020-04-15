<?php
$ulohy = [
   
11 =>  [
        'navigace' =>   [
                    'napis'=>'11'
        ],
        'otazka' => [
            'legend' => 'Úloha 1',
            'zadani' => [
                        'type' =>  'Text_s_obrazkem_1_z_N',
                        'obsah' => [
                                    'img_file_name' => '',
                                    'label' => 'Doplňte:',
                                    'text'  => 'What´s ….. name?'
                        ],
                        'odpoved'  => [
                                        'type' => 'radia',
                                        'data' => [ 
                                                   'label' => 'Vyberte odpověď:',
                                                   'content' => [
                                                            1 => 'he',
                                                            2 => 'you',
                                                            3 => 'your',
                                                            4 => 'she'
                                                    ],
                                                    'ok' => 3
                                        ]                           
                        ]                
            ]
        ]
]
,
12 =>  [
        'navigace' => [
                    'napis' => '99'
        ],
        'otazka' => [
           'legend' => 'Úloha 2',
           'zadani' => [
                        'type' => 'Text_s_obrazkem_1_z_N',
                        'obsah' => [
                                    'img_file_name' => '',
                                    'label' => 'Doplňte:',
                                    'text' =>  'Where ….. from?'
                        ],                                         
                        'odpoved'  => [
                                    'type' => 'radia',
                                    'data' => [                                     
                                        'label' => 'Vyberte odpověď:',                                              
                                        'content' => [
                                                 1 => 'you are',
                                                 2 => 'you have',
                                                 3 => 'have you',
                                                 4 => 'are you'
                                        ], 
                                        'ok' => 4
                                    ]
                        ]
            ]
        ]
]    
,   
 1 =>  [
        'navigace' => [
                'napis' => 'kun'
        ],
        'otazka' => [
            'legend' => 'Úloha 3',
            'zadani' => [
                        'type'=>'Text_s_obrazkem_1_z_N',
                        'obsah' => [                            
                               'img_file_name' => '',
                                'label' => 'Doplňte:',
                                'text' =>  'She ….. 19.'                        
                        ],            
                        'odpoved'  => [ 
                            'type' =>  'radia',
                            'data' => [
                                'label' => 'Vyberte odpověď:',                                         
                                'content' => [
                                    1 => 'am',
                                    2 => 'is',
                                    3 => 'are',
                                    4 => 'has'
                                ], 
                                'ok' => 2
                            ]  
                        ]
            ]
       ]
]     
     
,  
 4 =>   ['navigace' => [
            'napis' => '04',
        ],
        'otazka' => [
            'legend' => 'Úloha 4',
            'zadani' => [
                        'type'=>'Text_s_obrazkem_1_z_N',
                        'obsah' => [
                                'img_file_name' => '',
                                'label' => 'Doplňte:',
                                'text' =>  'Peter is ….. teacher.'
                        ],                   
                        'odpoved'  => [
                                    'type' =>  'radia',
                                    'data'  => [
                                            'label' => 'Vyberte odpověď:',                                   
                                            'content' => [
                                                1 => ' - ',
                                                2 => 'the',
                                                3 => 'a',
                                                4 => 'an'
                                             ], 
                                             'ok' => 3
                                    ]
                        ]
            ]
       ]
]     
,    
    
 5  => ['navigace' => ['napis' => '05',
                      ],
        'otazka' => [
                'legend' => 'Úloha 5',
               
                'zadani' => [ 
                        'type'=>'Text_s_obrazkem_1_z_N',
                        'obsah' => [
                                  'img_file_name' => '',
                                  'label' => 'Doplňte:',
                                  'text' =>  'I ….. from France.'
                                 ],
                        'odpoved'  => [ 
                                    'type' =>  'radia',    
                                    'data'  => [
                                        'label' => 'Vyberte odpověď:',
                                        'content' => [
                                            1 => 'be',
                                            2 => 'are',
                                            3 => 'is',
                                            4 => 'am'
                                        ], 
                                        'ok' => 4
                                    ]
                        ]
                    ],
            

        ]
], 
    
];