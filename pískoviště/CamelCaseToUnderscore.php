<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$testCCStrings = [
    "testA",
    "janTamBylSam",
    "janVTomBylSam",
    "kadelJe1ednicka",
    "preCislemPodtrzitkoNesmiStat123NeboNebuduHrat",
    "nejdrivMalePotomTRDLO"
];

function toCamelCase($underscoredName){
    return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $underscoredName))));
};


$fn[] = function ($ccString) {
    return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $ccString));  
    // This will transform MyCClassName to my_cclass_name and not my_c_class_name
};

//if you want every uppercase letter except the first to result in an underscore:
$fn[] = function ($ccString) {
    return strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $ccString));
};

$fn[] = function ($ccString) {
    return strtolower(preg_replace('/(\w+)([A-Z])/', '$1_$2', $ccString));
};

//You can use lookarounds to do all this in a single regex:
$fn[] = function ($ccString) {
    return strtolower(preg_replace(
        '/(?<=\d)(?=[A-Za-z])|(?<=[A-Za-z])(?=\d)|(?<=[a-z])(?=[A-Z])/', "_", $ccString));
};

//RegEx Description:

//(?<=\d)(?=[A-Za-z])  # if previous position has a digit and next has a letter
//|                    # OR
//(?<=[A-Za-z])(?=\d)  # if previous position has a letter and next has a digit
//|                    # OR
//(?<=[a-z])(?=[A-Z])  # if previous position has a lowercase and next has a uppercase letter
//
//shareimprove this answer
//edited Nov 9 '16 at 19:20

    $patterns = [
        '/([a-z]+)([0-9]+)/i',
        '/([a-z]+)([A-Z]+)/',
        '/([0-9]+)([a-z]+)/i'
    ];

$fn[] = function ($ccString) use ($patterns) {

    return $string = preg_replace($patterns, '$1_$2', $ccString);
};

foreach ($fn as $func) {
    foreach ($testCCStrings as $ccString) {
        $usString = strtolower($func($ccString));
        $revertedUsString = toCamelCase($usString);
        echo "<p>".$ccString." -> ".$usString." -> ". $revertedUsString." - revert ".($ccString==$revertedUsString ? "OK": "FAIL")."</p>";
    }
    echo "<hr/>";
}
