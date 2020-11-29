<?php


if (!isset($_COOKIE['auth'])){
    if (isset($_GET['getReg']) and $_GET['getReg'] == 1){
        include 'view/view_register.phtml';
    }else{
        include 'view/view_login.phtml';
    }
    die();
}