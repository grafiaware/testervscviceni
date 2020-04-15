<?php
require 'Bootstrap.php';

$app = new Accessor_Application();
$location = $app->run();
if (isset($location)) {
    header('Location: '.$location);
}
exit;