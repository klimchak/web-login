<?php

namespace weblogin;


class ValidDataRegex
{
    static $regLogin = '/(?!.*[\.\-\_]{2,})^[a-zA-Z0-9\.\-\_]{6,24}$/';
    static $regPass = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
    static $regEmail = '/^([A-Z|a-z|0-9](\.|_){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$/';
    static $regFname = '/[a-zA-Zа-яА-Я{2,18}]{4,8}/';

    public function validData ($data, $type){
        if ($type == 'login'){
            return preg_match_all($this::$regLogin, $data);
        }
        if ($type == 'password'){
            return preg_match_all($this::$regPass, $data);
        }
        if ($type == 'email'){
            return preg_match_all($this::$regEmail, $data);
        }
        if ($type == 'fname'){
            return preg_match_all($this::$regFname, $data);
        }
    }

}