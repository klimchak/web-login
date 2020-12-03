<?php

namespace weblogin;

class ValidDataRegistration
{
    public $typeReg = ['login', 'password', 'repassword', 'email', 'fname'];
    public $typeLog = ['login', 'password'];

    public function validData ($data, $typeDate){
        $regex = new \weblogin\ValidDataRegex;
        $printErrors = new \weblogin\PrintError();
        $i = 0;
        if ($typeDate == 'reg'){
            foreach ($data  as $key => $value){
                if ($key === 'repassword'){
                    ++$i;
                    continue;
                }
                if ($key === $this->typeReg[$i] and !$regex->validData($value, $this->typeReg[$i])){
                    $errorCode = 'regex_' . $this->typeReg[$i];
                    $printErrors->printError($errorCode);
                    exit();
                }
                ++$i;
            }
        }
        if ($typeDate == 'log'){
            foreach ($data  as $key => $value){
                if ($key === $this->typeLog[$i] and !$regex->validData($value, $this->typeLog[$i])){
                    $errorCode = 'regex_' . $this->typeLog[$i];
                    $printErrors->printError($errorCode);
                    exit();
                }
                ++$i;
            }
        }



    }

    public function validLoginUnic ($login){
        $printErrors = new \weblogin\PrintError();
        if (file_exists('./database/' . $login . '.xml')){
            $printErrors->printError('unic_login');
            exit();
        }
    }

    public function validEmailUnic ($email){
        $printErrors = new \weblogin\PrintError();
        $db = new \weblogin\crud();
        $objEmail = $db->readfile('email');
        foreach ($objEmail as $item) {
            if ($item == $email){
                $printErrors->printError('unic_email');
            }
        }
        }

}