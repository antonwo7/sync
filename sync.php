<?php 
include '../wp-load.php';
include 'lib/simple_html_dom.php';
include 'classes/Autoloader.php';

Autoloader::register();

$loader = new Loader();
$loader->load();


?>