<?php

include_once 'inclClass.php';


$db = new \weblogin\crud();
$validData = new \weblogin\ValidDataRegistration();
$printErrors = new \weblogin\PrintError();

if (!isset($_POST['login']) or $_POST['login'] == ''){
    header("Location: index.php?getReg=1");
    exit();
}

//Валидируем данные
$validData->validData($_POST);

//проверка логина на уникальность
$validData->validLoginUnic($_POST['login']);

//проверка имейла на уникальность
$validData->validEmailUnic($_POST['email'], $_POST['login']);

$db->creatUser($_POST['login'], password_hash($_POST['password'],  PASSWORD_DEFAULT ), $_POST['email'], $_POST['fname']);

echo json_encode(array('link' => 'secret.php'), JSON_UNESCAPED_UNICODE);

exit;