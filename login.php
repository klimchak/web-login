<?php

include_once 'inclClass.php';

$regex = new \weblogin\ValidDataRegex;
$printErrors = new \weblogin\PrintError();
$db = new \weblogin\crud();

if (isset($_POST['login']) and isset($_POST['password'])){
    if (!$regex->validData($_POST['login'], 'login')){
        $printErrors->printError('regex_login');
    }
    if (!$regex->validData($_POST['password'], 'password')){
        $printErrors->printError('regex_pass');
    }
}

//sadasdsadasd

$file = $db->readUser($_POST['login']);

if (password_verify($_POST['password'], $file->password)){
    session_start();
    $_SESSION['client'] = hash( "sha256", time());
    setcookie('val',$_SESSION['client'], '0', 'jkj', 'weblogin');
    echo json_encode(array('link' => 'secret.php'), JSON_UNESCAPED_UNICODE);
}

//password_verify($_POST['password'], $file->password);

//print_r(password_verify($_POST['password'], $file->password));
//klimchik
//qnN7cgWYdCg*fWCE

//echo json_encode(array('s' , $file[0]['password']), JSON_UNESCAPED_UNICODE);
exit;