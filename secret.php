<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/inclClass.php';

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

$hey = 'hello ' . $_SESSION['clientName'];

include_once $_SERVER['DOCUMENT_ROOT'] . '/view/view_secret.phtml';