<?php
include_once 'inclClass.php';

session_start();

$db = new \weblogin\crud();

if (!isset($_COOKIE['val']) or $_COOKIE['val'] !== $_SESSION['client']){
    header('Location: index.php?out=1');
    exit();
}

if ($db->validSesion($_SESSION['clientName'], $_COOKIE['val']) == false){
    header('Location: index.php?out=1');
    exit();
}

$hey = 'hello';

include_once 'view/view_secret.phtml';