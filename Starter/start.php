<?php
require 'Bootstrap.php';

$method = $_SERVER['REQUEST_METHOD'];
$get = $_GET;
$post = $_POST;

if ($method=='GET') {
    echo (new Starter_Controler_Prihlas())->getForm();
}
if ($method=='POST' AND $post['form']=='prihlaseni') {
    $ctrlPrihlas = new Starter_Controler_Prihlas();
    if ($ctrlPrihlas->check($post)) {
        echo (new Starter_Controler_Start())->getForm($post);
    } else {
        echo $ctrlPrihlas->getForm(TRUE, $post);        
    }
}
if ($method=='POST' AND $post['form']=='start') {
    (new Starter_Controler_Start())->relocateToTestAndExit($post);
}

