<?php

include_once 'inclClass.php';

$regex = new \weblogin\ValidDataRegex;
$printErrors = new \weblogin\PrintError();
$db = new \weblogin\crud();

if (isset($_POST['login']) and isset($_POST['password']) and isset($_POST['repassword']) and isset($_POST['email']) and isset($_POST['fname'])){
    if (!$regex->validData($_POST['login'], 'login')){
        $printErrors->printError('regex_login');
    }
    if (!$regex->validData($_POST['password'], 'password')){
        $printErrors->printError('regex_pass');
    }elseif($_POST['password'] !== $_POST['repassword']){
        $printErrors->printError('repass');
    }
    if (!$regex->validData($_POST['email'], 'email')){
        $printErrors->printError('regex_email');
    }
    if (!$regex->validData($_POST['fname'], 'fname')){
        $printErrors->printError('regex_fname');
    }
}



$db->creatUser($_POST['login'], password_hash($_POST['password'],  PASSWORD_DEFAULT ), $_POST['email'], $_POST['fname']);



echo json_encode(array('foo' => 'bar'));
exit;