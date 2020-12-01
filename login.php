<?php

include_once 'inclClass.php';

$regex = new \weblogin\ValidDataRegex;
$printErrors = new \weblogin\PrintError();
$db = new \weblogin\crud();
$validData = new \weblogin\ValidDataRegistration();

if (!isset($_POST['login']) or $_POST['login'] == ''){
    header('Location: index.php?getReg=1');
    exit();
}

//Валидируем данные
$validData->validData($_POST, 'log');

//Проверяем наличие файла с данным пользователя
if (!file_exists('./database/' . $_POST['login'] . '.xml')){
    $printErrors->printError('password_err');
}

//читаем файл
$file = $db->readfile($_POST['login']);

if (password_verify($_POST['password'], $file->password)){
    session_start();
    $_SESSION['client'] = hash( "sha256", time());
    setcookie('val',$_SESSION['client'], '0', 'jkj', 'weblogin');
    echo json_encode(array('link' => 'secret.php'), JSON_UNESCAPED_UNICODE);
}else{
    $printErrors->printError('password_err');
}

exit();