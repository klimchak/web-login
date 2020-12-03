<?php
namespace weblogin;

include_once $_SERVER['DOCUMENT_ROOT'] . '/inclClass.php';


$db = new \weblogin\crud();
$validData = new \weblogin\ValidDataRegistration();
$printErrors = new \weblogin\PrintError();

if (!isset($_POST['login']) or $_POST['login'] == ''){
    header("Location: index.php?getReg=1");
    exit();
}

//Валидируем данные
$validData->validData($_POST, 'reg');

//проверка логина на уникальность
$validData->validLoginUnic($_POST['login']);

//проверка имейла на уникальность
$validData->validEmailUnic($_POST['email']);

//создаем пользователя
$db->creatUser($_POST['login'], password_hash($_POST['password'],  PASSWORD_DEFAULT ), $_POST['email'], $_POST['fname']);

//отправка данных на редирект
echo json_encode(array('link' => 'index.php?getReg=0'), JSON_UNESCAPED_UNICODE);
exit;