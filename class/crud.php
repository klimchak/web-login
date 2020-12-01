<?php


namespace weblogin;


class crud
{

//    public $domObj = new \DOMDocument();

    public function creatUser($login, $password, $email, $fname){
        $domObj = new \DOMDocument();

        $domObj->loadXML("<user>
    <login>$login</login>
    <password>$password</password>
    <email>$email</email>
    <fname>$fname</fname>
</user>");
        $domObj->normalizeDocument();
        $path = './database/' . $login . '.xml';
        $domObj->save($path);
        unset($domObj);
        $domObj = new \DOMDocument();
        $domObj->load('./database/email.xml');
        $atrEmail = $domObj->getElementsByTagName('email')->item(0);
        $newEmailElem = $domObj->createElement("$login");
        $newEmailElemVal = $domObj->createTextNode("$email");
        $newEmailElem->appendChild($newEmailElemVal);
        $atrEmail->appendChild($newEmailElem);
        $domObj->save('./database/email.xml');
    }


    public function readfile($file){
        $path = './database/' . $file . '.xml';
        return $ddd = simplexml_load_file($path);
    }



}