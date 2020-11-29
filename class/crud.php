<?php


namespace weblogin;


class crud
{

//    public $domObj = new \DOMDocument();

    public function creatUser($login, $password, $email, $fname){
        $domObj = new \DOMDocument();
        $domObj->loadXML("<user><login>$login</login><password>$password</password><email>$email</email><fname>$fname</fname></user>");
        $path = './database/' . $login . '.xml';
        $domObj->save($path);

//        $domObj = new \DOMDocument();
//        $v = "<user><login>$login</login><password>$password</password><email>$email</email><fname>$fname</fname></user>";
//        $path = './database/db.xml';
//        $domObj->load($path);
//        $fff = $domObj->create;
//        $domObj->appendChild($v);
//        $domObj->save($path);
    }

    public function readUser($login){
        $path = './database/' . $login . '.xml';
        return $ddd = simplexml_load_file($path);
//        echo json_encode(array($ddd, JSON_UNESCAPED_UNICODE));


    }
}