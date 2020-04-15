<?php
$ulohy = [
   
11 =>  [
        'navigace' =>   [
                        'napis'=>'11'
                        ],
        'otazka' => [
            'legend' => 'Úloha 1',
            'zadani' => [
                        'type'=>'Text_s_obrazkem_1_z_N',
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
12 =>  ['tlacitko' => ['napis' => '99'
                      ],
        'otazka' => ['legend' => 'Úloha 2',
                     'img_file_name' => '',
                     'zadani' => ['label' => 'Doplňte:',
                                 'text' =>  'Where ….. from?'
                                 ],
                     'radia'  => ['label' => 'Vyberte odpověď:',
                                  'name' => 'odpoved',            
                                  'content' => [1 => 'you are',
                                                 2 => 'you have',
                                                 3 => 'have you',
                                                 4 => 'are you'
                                                ], 
                                  'odpoved' => 4
                                 ]
                    ]
       ]
,   
 1 =>  ['tlacitko' => ['napis' => 'kun'
                      ],
        'otazka' => ['legend' => 'Úloha 3',
                     'img_file_name' => '',
                     'zadani' => ['label' => 'Doplňte:',
                                  'text' =>  'She ….. 19.'
                                 ],
                     'radia'  => [ 'label' => 'Vyberte odpověď:',
                                   'name' => 'odpoved',             
                                   'content' => [1 => 'am',
                                                 2 => 'is',
                                                 3 => 'are',
                                                 4 => 'has'
                                                ], 
                                   'odpoved' => 2
                                 ]
                    ]
       ]
//,  
// 4 =>  ['tlacitko' => ['napis' => '04',
//                      ],
//        'otazka' => ['legend' => 'Úloha 4',
//                     'img_file_name' => '',
//                     'zadani' => ['label' => 'Doplňte:',
//                                  'text' =>  'Peter is ….. teacher.'
//                                 ],
//                     'radia'  => ['label' => 'Vyberte odpověď:',
//                                  'name' => 'odpoved',            
//                                  'content' => [1 => ' - ',
//                                                2 => 'the',
//                                                3 => 'a',
//                                                4 => 'an'
//                                               ], 
//                                  'odpoved' => 3
//                                 ]
//                    ]
//       ]
//,    
//    
// 5  => ['tlacitko' => ['napis' => '05',
//                      ],
//        'otazka' => ['legend' => 'Úloha 5',
//                     'img_file_name' => '',
//                     'zadani' => ['label' => 'Doplňte:',
//                                  'text' =>  'I ….. from France.'
//                                 ],
//                     'radia'  => ['label' => 'Vyberte odpověď:',
//                                  'name' => 'odpoved',            
//                                  'content' => [1 => 'be',
//                                                2 => 'are',
//                                                3 => 'is',
//                                                4 => 'am'
//                                               ], 
//                                  'odpoved' => 4
//                                 ]
//                    ]
//       ]
//,  
//    
// 6 =>  ['tlacitko' => ['napis' => '06',
//                      ],
//        'otazka' => ['legend' => 'Úloha 6',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'She has three …..'
//                                ],
//                    'radia' =>  ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'childern',
//                                                2 => 'children',
//                                                3 => 'childs',
//                                                4 => 'childrens'
//                                              ], 
//                                 'odpoved' => 2
//                                ]
//                    ]
//       ]
//,  
//    
//    
// 7 =>  ['tlacitko' => ['napis' => '07',
//                      ],
//        'otazka' => ['legend' => 'Úloha 7',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'Can you ….. ?'
//                                ],
//                    'radia' =>  ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'cook',
//                                                2 => 'to cook',
//                                                3 => 'cooking',
//                                                4 => 'cooked'
//                                               ], 
//                                 'odpoved' => 1
//                                 ]
//                    ]
//       ]
//,  
//    
//    
// 8 =>  ['tlacitko' => ['napis' => '08',
//                      ],
//        'otazka' => ['legend' => 'Úloha 8',
//                    'img_file_name' => '',
//                    'zadani' =>  ['label' => 'Doplňte:',
//                                  'text' =>  'She ….. in London.'
//                                 ],
//                    'radia'  =>  ['label' => 'Vyberte odpověď:',
//                                  'name' => 'odpoved',            
//                                  'content' => [1 => 'do',
//                                                2 => 'live',
//                                                3 => 'lives',
//                                                4 => 'does'
//                                               ], 
//                                  'odpoved' => 3
//                                 ]
//                    ]
//       ]
//,  
//    
//    
// 9 =>  ['tlacitko' => ['napis' => '09',
//                      ],
//        'otazka' => ['legend' => 'Úloha 9',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'How old ….. you?'
//                                 ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'is',
//                                                2 => 'aren´t',
//                                                3 => 'isn´t',
//                                                4 => 'are'
//                                              ], 
//                                  'odpoved' => 4
//                                ]
//                    ]
//       ]
//,  
//    
//    
//10 =>  ['tlacitko' => ['napis' => '10',
//                      ],
//        'otazka' => ['legend' => 'Úloha 10',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                  'text' =>  'How ….. they?'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'have',
//                                                2 => 'is',
//                                                3 => 'are',
//                                                4 => 'aren´t'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//, 
//    
//    
//11 =>  ['tlacitko' => ['napis' => '11',
//                      ],
//        'otazka' => ['legend' => 'Úloha 11',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                  'text' =>  ' ….. he go to school every day?'
//                                  ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'Is',
//                                                2 => 'Do',
//                                                3 => 'Are',
//                                                4 => 'Does'
//                                              ], 
//                                 'odpoved' => 4
//                                 ]
//                    ]
//       ]
//,  
//    
//    
//12 =>  ['tlacitko' => ['napis' => '12',
//                      ],
//        'otazka' => ['legend' => 'Úloha 12',
//                    'img_file_name' => '',
//                    'zadani' =>  ['label' => 'Doplňte:',
//                                  'text' =>  'Where ….. you yesterday?'
//                                 ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'was',
//                                                2 => 'were',
//                                                3 => 'where',
//                                                4 => 'did'
//                                              ], 
//                                 'odpoved' => 2
//                                 ]
//                    ]
//       ]
//,  
//    
//    
//13 =>  ['tlacitko' => ['napis' => '13',
//                      ],
//        'otazka' => ['legend' => 'Úloha 13',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'There aren´t ….. vegetables left.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                  'name' => 'odpoved',            
//                                  'content' => [1 => 'a',
//                                                2 => 'an',
//                                                3 => 'some',
//                                                4 => 'any'
//                                               ], 
//                                   'odpoved' => 4
//                                ]
//                    ]
//       ]
//,  
//    
//    
//14 =>  ['tlacitko' => ['napis' => '14',
//                      ],
//        'otazka' => ['legend' => 'Úloha 14',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'What would you like ….. tomorrow?'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'to do',
//                                                2 => 'doing',
//                                                3 => 'do',
//                                                4 => 'going to do'
//                                                ], 
//                                 'odpoved' => 1
//                                ]
//                    ]
//       ]
//,  
//    
//    
//15 =>  ['tlacitko' => ['napis' => '15',
//                      ],
//        'otazka' => ['legend' => 'Úloha 15',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'Did you ….. a nice holiday?'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'has',
//                                               2 => 'had',
//                                               3 => 'have',
//                                               4 => 'to have'
//                                              ], 
//                                 'odpoved' => 3
//                                 ]
//                    ]
//       ]
//,  
//    
//    
//16 =>  ['tlacitko' => ['napis' => '16',
//                      ],
//        'otazka' => ['legend' => 'Úloha 16',
//                    'img_file_name' => '',
//                    'zadani' =>  ['label' => 'Doplňte:',
//                                  'text' =>  'She made a ….. mistake than me.'
//                                 ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'biger',
//                                                2 => 'bigger',
//                                                3 => 'biggest',
//                                                4 => 'big'
//                                              ], 
//                                 'odpoved' => 2
//                                ]
//                    ]
//       ]
//,  
//    
//    
//17 =>  ['tlacitko' => ['napis' => '17',
//                      ],
//        'otazka' => ['legend' => 'Úloha 17',
//                    'img_file_name' => '',
//                    'zadani' =>  ['label' => 'Doplňte:',
//                                  'text' =>  'Is it still ….. ?'
//                                 ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'rain',
//                                               2 => 'rainning',
//                                               3 => 'raining',
//                                               4 => 'rains'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//18 =>  ['tlacitko' => ['napis' => '18',
//                      ],
//        'otazka' => ['legend' => 'Úloha 18',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'It happened ….. Christmas.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'before',
//                                               2 => 'in',
//                                               3 => 'in front of',
//                                               4 => 'on'
//                                              ], 
//                                 'odpoved' => 1
//                                ]
//                    ]
//       ]
//,  
//    
//    
//19 =>  ['tlacitko' => ['napis' => '19',
//                      ],
//        'otazka' => ['legend' => 'Úloha 19',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'What time did you ….. to school?'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'came',
//                                               2 => 'come',
//                                               3 => 'to come',
//                                               4 => 'coming'
//                                              ], 
//                                 'odpoved' => 2
//                                 ]
//                    ]
//       ]
//,  
//    
//    
//20 =>  ['tlacitko' => ['napis' => '20',
//                      ],
//        'otazka' => ['legend' => 'Úloha 20',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'Have you ever ….. the USA?'
//                                ],
//                    'radia' =>  ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'been in',
//                                               2 => 'gone to',
//                                               3 => 'been to',
//                                               4 => 'did in'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//21 =>  ['tlacitko' => ['napis' => '21',
//                      ],
//        'otazka' => ['legend' => 'Úloha 21',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'I want ….. a teacher.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'being',
//                                               2 => 'be',
//                                               3 => 'to be',
//                                               4 => 'going to be'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//22 =>  ['tlacitko' => ['napis' => '22',
//                      ],
//        'otazka' => ['legend' => 'Úloha 22',
//                    'img_file_name' => '',
//                    'zadani' =>  ['label' => 'Doplňte:',
//                                  'text' =>  'She ….. a new car last month.'
//                                 ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'buyed',
//                                               2 => 'has buyed',
//                                               3 => 'has bought',
//                                               4 => 'bought'
//                                              ], 
//                                 'odpoved' => 4
//                                ]
//                    ]
//       ]
//,  
//    
//    
//23 =>  ['tlacitko' => ['napis' => '23',
//                      ],
//        'otazka' => ['legend' => 'Úloha 23',
//                    'img_file_name' => '',
//                    'zadani' =>  ['label' => 'Doplňte:',
//                                  'text' =>  'Mike ….. in summer.'
//                                 ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'is going to get married',
//                                                2 => 'going to get married',
//                                                3 => 'will get married',
//                                                4 => 'gets married'
//                                              ], 
//                                 'odpoved' => 1
//                                ]
//                    ]
//       ]
//,  
//    
//    
//24 =>  ['tlacitko' => ['napis' => '24',
//                      ],
//        'otazka' => ['legend' => 'Úloha 24',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'While I ….. in the garden, the phone rang.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'were working',
//                                               2 => 'was working',
//                                               3 => 'worked',
//                                               4 => 'working'
//                                              ], 
//                                 'odpoved' => 2
//                                ]
//                    ]
//       ]
//,  
//    
//    
//25 =>  ['tlacitko' => ['napis' => '25',
//                      ],
//        'otazka' => ['legend' => 'Úloha 25',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'The phone is ringing! – I ….. it.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'am going to answer',
//                                               2 => 'will answer to',
//                                               3 => 'will answer',
//                                               4 => 'going to answer'
//                                               ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//26 =>  ['tlacitko' => ['napis' => '26',
//                      ],
//        'otazka' => ['legend' => 'Úloha 26',
//                    'img_file_name' => '',
//                    'zadani' =>  ['label' => 'Doplňte:',
//                                  'text' =>  'All the sandwiches …..'
//                                 ],
//                    'radia'  =>  ['label' => 'Vyberte odpověď:',
//                                  'name' => 'odpoved',            
//                                  'content' => [1 => 'ate',
//                                                2 => 'has eaten',
//                                                3 => 'has been eaten',
//                                                4 => 'have been eaten'
//                                               ], 
//                                 'odpoved' => 4
//                                 ]
//                    ]
//       ]
//,  
//    
//    
//27 =>  ['tlacitko' => ['napis' => '27',
//                      ],
//        'otazka' => ['legend' => 'Úloha 27',
//                    'img_file_name' => '',
//                    'zadani' =>  ['label' => 'Doplňte:',
//                                  'text' =>  'When I was young, I ….. to school every day.'
//                                 ],
//                    'radia'  =>  ['label' => 'Vyberte odpověď:',
//                                  'name' => 'odpoved',            
//                                  'content' => [1 => 'used to go',
//                                                2 => 'used to going',
//                                                3 => 'was used to go',
//                                                4 => 'used go'
//                                               ], 
//                                  'odpoved' => 1
//                                 ]
//                    ]
//       ]
//,  
//    
//    
//28 =>  ['tlacitko' => ['napis' => '28',
//                      ],
//        'otazka' => ['legend' => 'Úloha 28',
//                    'img_file_name' => '',
//                    'zadani' =>  ['label' => 'Doplňte:',
//                                  'text' =>  'She has got a red face because …..'
//                                 ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'she baked',
//                                               2 => 'she has been baking',
//                                               3 => 'she has baked',
//                                               4 => 'she bakes'
//                                              ], 
//                                 'odpoved' => 2
//                                ]
//                    ]
//       ]
//,  
//    
//    
//29 =>  ['tlacitko' => ['napis' => '29',
//                      ],
//        'otazka' => ['legend' => 'Úloha 29',
//                    'img_file_name' => '',
//                    'zadani' =>  ['label' => 'Doplňte:',
//                                  'text' =>  'If she ….. to university, she will study medicine.'
//                                 ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'will go',
//                                               2 => 'go',
//                                               3 => 'goes',
//                                               4 => 'went'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//30 =>  ['tlacitko' => ['napis' => '30',
//                      ],
//        'otazka' => ['legend' => 'Úloha 30',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'If I ….. the answer, I could pass the exam.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'knew',
//                                               2 => 'know',
//                                               3 => 'knowed',
//                                               4 => 'knows'
//                                              ], 
//                                 'odpoved' => 1
//                                ]
//                    ]
//       ]
//,  
//    
//    
//31 =>  ['tlacitko' => ['napis' => '31',
//                      ],
//        'otazka' => ['legend' => 'Úloha 31',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                  'text' =>  'How many plays ….. ?'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'has Shakespeare writen',
//                                               2 => 'has Shakespeare written',
//                                               3 => 'did Shakespeare write',
//                                               4 => 'has Shakespeare been writing'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//32 =>  ['tlacitko' => ['napis' => '32',
//                      ],
//        'otazka' => ['legend' => 'Úloha 32',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'She ….. to wake him when they …..'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'just tried – arrived',
//                                               2 => 'was just trying – arrived',
//                                               3 => 'just tried – was arriving',
//                                               4 => 'was just trying – were arriving'
//                                              ], 
//                                 'odpoved' => 2
//                                ]
//                    ]
//       ]
//,  
//    
//    
//33 =>  ['tlacitko' => ['napis' => '33',
//                      ],
//        'otazka' => ['legend' => 'Úloha 33',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'During their conversation he realized they ….. before.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'had met',
//                                               2 => 'met',
//                                               3 => 'have met',
//                                               4 => 'didn´t meet'
//                                              ], 
//                                 'odpoved' =>  1
//                                ]
//                    ]
//       ]
//,  
//    
//    
//34 =>  ['tlacitko' => ['napis' => '34',
//                      ],
//        'otazka' => ['legend' => 'Úloha 34',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'Jennifer found out that she …..'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'was burgled',
//                                               2 => 'had burgled',
//                                               3 => 'had been burgled',
//                                               4 => 'has been burgled'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//35 =>  ['tlacitko' => ['napis' => '35',
//                      ],
//        'otazka' => ['legend' => 'Úloha 35',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'When they arrested him they told him they ….. him for several months.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'watched',
//                                               2 => 'had been watched',
//                                               3 => 'had watched',
//                                               4 => 'had been watching'
//                                              ], 
//                                 'odpoved' => 4
//                                ]
//                    ]
//       ]
//,  
//    
//    
//36 =>  ['tlacitko' => ['napis' => '36',
//                      ],
//        'otazka' => ['legend' => 'Úloha 36',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'Jack ….. to Cambridge – his car´s still outside.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 =>   'can´t have gone',
//                                               2 =>   'must have gone',
//                                               3 =>   'might have gone',
//                                               4 =>   'must go'
//                                              ], 
//                                 'odpoved' => 1
//                                ]
//                    ]
//       ]
//,  
//    
//    
//37 =>  ['tlacitko' => ['napis' => '37',
//                      ],
//        'otazka' => ['legend' => 'Úloha 37',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'You ….. Eve our secret – now everyone will know.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'can tell',
//                                               2 => 'must tell',
//                                               3 => 'must have told',
//                                               4 => 'must had told'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//38 =>  ['tlacitko' => ['napis' => '38',
//                      ],
//        'otazka' => ['legend' => 'Úloha 38',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'If I ….. you were coming, I would have made a cake.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'knew',
//                                               2 => 'had known',
//                                               3 => 'would know',
//                                               4 => 'would have known'
//                                              ], 
//                                 'odpoved' => 2
//                                ]
//                    ]
//       ]
//,  
//    
//    
//39 =>  ['tlacitko' => ['napis' => '39',
//                      ],
//        'otazka' => ['legend' => 'Úloha 39',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'Charlie is always lazy. He failed a test last week.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'If he wasn´t so lazy, he would pass the test.',
//                                               2 => 'If he hadn´t been so lazy, he would pass the test.',
//                                               3 => 'If he wasn´t so lazy, he would have passed the test.',
//                                               4 => 'If he hadn´t been so lazy, he would have passed the test.'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//40 =>  ['tlacitko' => ['napis' => '40',
//                      ],
//        'otazka' => ['legend' => 'Úloha 40',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'We were lucky. We ….. in that traffic jam.'
//                                ],
//                    'radia'  =>['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'could have been caught',
//                                               2 => 'could have caught',
//                                               3 => 'could be caught',
//                                               4 => 'could had been caught'
//                                              ], 
//                                 'odpoved' => 1
//                                ]
//                    ]
//       ]
//,  
//    
//    
//41 =>  ['tlacitko' => ['napis' => '41',
//                      ],
//        'otazka' => ['legend' => 'Úloha 41',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'I´m sorry I made you angry. I wish I ….. shouted at you.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'hadn´t been',
//                                               2 => 'wouldn´t',
//                                               3 => 'wouldn´t have', 
//                                               4 => 'hadn´t'
//                                              ], 
//                                 'odpoved' => 4
//                                ]
//                    ]
//       ]
//,  
//    
//    
//42 =>  ['tlacitko' => ['napis' => '42',
//                      ],
//        'otazka' => ['legend' => 'Úloha 42',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'Their house ….. just now.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'is build',
//                                               2 => 'is built',
//                                               3 => 'is being built',
//                                               4 => 'was built'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//43 =>  ['tlacitko' => ['napis' => '43',
//                      ],
//        'otazka' => ['legend' => 'Úloha 43',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'She can´t speak English and I …..'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'don´t too',
//                                               2 => 'can either',
//                                               3 => 'can´t too',
//                                               4 => 'can´t either'
//                                              ], 
//                                 'odpoved' => 4
//                                ]
//                    ]
//       ]
//,  
//    
//    
//44 =>  ['tlacitko' => ['napis' => '44',
//                      ],
//        'otazka' => ['legend' => 'Úloha 44',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'They succeeded ….. the match.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'to win',
//                                               2 => 'to have won',
//                                               3 => 'in winning',
//                                               4 => 'in having won'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//45 =>  ['tlacitko' => ['napis' => '45',
//                      ],
//        'otazka' => ['legend' => 'Úloha 45',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'She is known ….. on a new book.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'to work',
//                                               2 => 'to have been working', 
//                                               3 => 'to having working',
//                                               4 => 'to having worked'
//                                              ], 
//                                 'odpoved' => 2
//                                ]
//                    ]
//       ]
//,  
//    
//    
//46 =>  ['tlacitko' => ['napis' => '46',
//                      ],
//        'otazka' => ['legend' => 'Úloha 46',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'He seems ….. a mistake.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'to have made',
//                                               2 => 'have made',
//                                               3 => 'having made',
//                                               4 => 'to have been making'
//                                              ], 
//                                 'odpoved' => 1
//                                ]
//                    ]
//       ]
//,  
//    
//    
//47 =>  ['tlacitko' => ['napis' => '47',
//                      ],
//        'otazka' => ['legend' => 'Úloha 47',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'You ….. any sugar. We´ve got lots.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'can´t have bought',
//                                               2 => 'mustn´t have bought',
//                                               3 => 'needn´t have bought',
//                                               4 => 'might not have bought'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//48 =>  ['tlacitko' => ['napis' => '48',
//                      ],
//        'otazka' => ['legend' => 'Úloha 48',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'He ….. it.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'made to do',
//                                               2 => 'made doing',
//                                               3 => 'was made to do',
//                                               4 => 'was made do'
//                                              ], 
//                                 'odpoved' => 3
//                                ]
//                    ]
//       ]
//,  
//    
//    
//49 =>  ['tlacitko' => ['napis' => '49',
//                      ],
//        'otazka' => ['legend' => 'Úloha 49',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'He suffered ….. a difficult childhood.'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'to have',
//                                               2 => 'from having had',
//                                               3 => 'from having',
//                                               4 => 'to have had'
//                                              ], 
//                                 'odpoved' => 2
//                                ]
//                    ]
//       ]
//,  
//    
//    
//50 =>  ['tlacitko' => ['napis' => '50',
//                      ],
//        'otazka' => ['legend' => 'Úloha 50',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Doplňte:',
//                                 'text' =>  'She fell off the horse, …..'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',            
//                                 'content' => [1 => 'breaking her legs.',
//                                               2 => 'having broken her legs.',
//                                               3 => 'had broken her legs.',
//                                               4 => 'has broken her legs.'
//                                              ], 
//                                 'odpoved' => 1
//                                ]
//                    ]
//       ]
//,  
//    
//    
//51 =>  ['tlacitko' => ['napis' => '51',
//                      ],
//        'otazka' => ['legend' => 'Úloha 51',
//                    'img_file_name' => '',
//                    'zadani' => ['label' => 'Pokyn:',
//                                 'text' => 'Vyberte odpověď a stiskněte tlačítko Pokračuj jen v  případě,<br/> že jste již na všechny otázky odpověděli a chcete test ukončit.<br/><br/>' .
//                                   ' <b>Chcete-li se k některým otázkám vrátit, použijte tlačítka v záhlaví formuláře!</b><br/><br/>'
//                                ],
//                    'radia'  => ['label' => 'Vyberte odpověď:',
//                                 'name' => 'odpoved',
//                                 'content' => ['ukončit'
//                                              ], 
//                                 'odpoved' => 1
//                                ]
//                    ]
//       ]
// 
];


