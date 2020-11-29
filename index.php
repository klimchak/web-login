<?php


if (isset($_GET) and $_GET['out'] == 1){
    session_start();
    $_SESSION['client'] = '';
    session_destroy();
    session_abort();
    session_reset();
    setcookie('val', '', time()-1);
    setcookie('PHPSESSID', '', time()-1);
    header('Location: index.php');
}

if (!isset($_COOKIE['val'])){
    if (isset($_GET['getReg']) and $_GET['getReg'] == 1){
        include 'view/view_register.phtml';
    }else{
        include 'view/view_login.phtml';
    }
    die();
}

if ($_COOKIE['val']){
    session_start();
    if ($_COOKIE['val'] === $_SESSION['client'])
    header('Location: secret.php');
}
