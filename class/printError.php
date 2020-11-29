<?php


namespace weblogin;


class PrintError
{
    public $errorArr = [
        'regex_login' => 'Логин не соответствует требованиям',
        'regex_pass' => 'Пароль не соответствует требованиям',
        'regex_email' => 'Email не соответствует требованиям',
        'regex_fname' => 'Имя не соответствует требованиям',
        'repass' => 'Пароли не совпадают',
        'unic_login' => 'Такой логин уже используется',
        'unic_email' => 'Такой email уже используется',
    ];

    public function printError($codeError){
        header('Content-Type: application/json');
        echo json_encode(array('error' => $this->errorArr[$codeError]), JSON_UNESCAPED_UNICODE);
        exit;
    }
}