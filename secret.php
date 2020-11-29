<?php
session_start();

if (!isset($_COOKIE['val']) or $_COOKIE['val'] !== $_SESSION['client']){
    header('Location: index.php');
}
echo 'hello';