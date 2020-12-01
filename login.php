<?php

include_once 'inclClass.php';

$regex = new \weblogin\ValidDataRegex;
$printErrors = new \weblogin\PrintError();
$db = new \weblogin\crud();

if (!isset($_POST['login']) or $_POST['login'] == ''){
    header('Location: index.php?getReg=1');
    exit();
}

//проверка на валидность
if (isset($_POST['login']) and isset($_POST['password'])){
    if (!$regex->validData($_POST['login'], 'login')){
        $printErrors->printError('regex_login');
    }
    if (!$regex->validData($_POST['password'], 'password')){
        $printErrors->printError('regex_pass');
    }
}

if (!file_exists('./database/' . $_POST['login'] . '.xml')){
    $printErrors->printError('password_err');
}

$file = $db->readfile($_POST['login']);
//if ($file == false){
//
//}



if (password_verify($_POST['password'], $file->password)){
    session_start();
    $_SESSION['client'] = hash( "sha256", time());
    setcookie('val',$_SESSION['client'], '0', 'jkj', 'weblogin');
    echo json_encode(array('link' => 'secret.php'), JSON_UNESCAPED_UNICODE);
}else{
    $printErrors->printError('password_err');
}

exit();