<?php


namespace weblogin;


class ValidDataRegistration
{
    public $type = ['login', 'password', 'repassword', 'email', 'fname'];
    public function validData ($data){
        $regex = new \weblogin\ValidDataRegex;
        $printErrors = new \weblogin\PrintError();
        $i = 0;
        foreach ($data  as $key => $value){
            if ($key === 'repassword'){
                ++$i;
                continue;
            }
            if ($key === $this->type[$i] and !$regex->validData($value, $this->type[$i])){
                $errorCode = 'regex_' . $this->type[$i];
                $printErrors->printError($errorCode);
                exit();
            }
            ++$i;
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