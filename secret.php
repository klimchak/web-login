<?php
session_start();

if (!isset($_COOKIE['val']) or $_COOKIE['val'] !== $_SESSION['client']){
    header('Location: index.php');
}
$hey = 'hello';
include_once 'view/view_secret.phtml';