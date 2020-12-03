<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/inclClass.php';

function redirect(){
    $db = new \weblogin\crud();
    session_start();
    setcookie('val', '', time()-1);
    setcookie('PHPSESSID', '', time()-1);
    $db->delSession($_SESSION['clientName']);
    session_destroy();
    header('Location: index.php');
}

if (isset($_GET) and $_GET['out'] == 1){
    redirect();
    die();
}

if (!isset($_COOKIE['val'])){
    if (isset($_GET['getReg']) and $_GET['getReg'] == 1){
        include $_SERVER['DOCUMENT_ROOT'] . '/view/view_register.phtml';
    }else{
        include $_SERVER['DOCUMENT_ROOT'] . '/view/view_login.phtml';
    }
    die();
}

if ($_COOKIE['val']){
    $db = new \weblogin\crud();
    session_start();
    if ($db->validSesion($_SESSION['clientName'], $_COOKIE['val']) == true){
        header('Location: secret.php');
        exit();
    }
    if ($_COOKIE['val'] == $_SESSION['client'])
    header('Location: secret.php');
    die();
}else{
    header('Location: index.php?out=1');
    die();
}

