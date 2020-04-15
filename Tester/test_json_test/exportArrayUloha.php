<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dataArray = 
[
   
11 =>  [
        'navigace' =>   [
                        'napis' => '11'
                        ],
        'otazka' => [
            'legend' => 'Úloha 1',
            'zadani' => [
                        'type'=>'Text_s_obrazkem_1_z_N',
                        'data' => [
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
     ];        

echo '<pre style="color:red">';

$export = var_export($dataArray, TRUE );
echo str_replace(['array (', '),'], ['[', '],'], $export);

echo '</pre>';
echo '<pre style="color:blue">';

echo json_encode($dataArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

echo '</pre>';