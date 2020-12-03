<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


echo '<pre>';

$r = simplexml_load_file(dirname(__FILE__).'/database/email.xml');

print_r($r);