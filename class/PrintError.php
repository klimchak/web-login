<?php


namespace weblogin;


class PrintError
{
    public $errorArr = [
        'regex_login' => 'Логин не соответствует требованиям',
        'regex_password' => 'Пароль не соответствует требованиям',
        'regex_email' => 'Email не соответствует требованиям',
        'regex_fname' => 'Имя не соответствует требованиям',
        'repass' => 'Пароли не совпадают',
        'unic_login' => 'Такой логин уже используется',
        'unic_email' => 'Такой email уже используется',
        'password_err' => 'Ошибка логина или пароля',
        'fatal' => 'что-то пошло не так',
    ];

    public function printError($codeError){
        echo json_encode(array('error' => $codeError, $codeError => $this->errorArr[$codeError]), JSON_UNESCAPED_UNICODE);
        exit();
    }
}