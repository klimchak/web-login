<?php


namespace weblogin;


class crud
{
    static function pathFile(){
        $absolutePath = $_SERVER['DOCUMENT_ROOT'];
        $path = explode('class', $absolutePath);
        return $path[0];
    }

    public function creatUser($login, $password, $email, $fname){
        $domObj = new \DOMDocument();
        $domObj->loadXML("<user>
    <login>$login</login>
    <password>$password</password>
    <email>$email</email>
    <fname>$fname</fname>
</user>");
        $domObj->normalizeDocument();
        $path = $_SERVER['DOCUMENT_ROOT'] . '/database/' . $login . '.xml';
        $domObj->save($path);
        unset($domObj);
        $domObj = new \DOMDocument();
        $domObj->preserveWhiteSpace = false;
        $domObj->formatOutput = true;
        $domObj->load($_SERVER['DOCUMENT_ROOT']. '/database/email.xml');
        $atrEmail = $domObj->getElementsByTagName('email')->item(0);
        $newEmailElem = $domObj->createElement("$login");
        $newEmailElemVal = $domObj->createTextNode("$email");
        $newEmailElem->appendChild($newEmailElemVal);
        $atrEmail->appendChild($newEmailElem);
        $domObj->save($_SERVER['DOCUMENT_ROOT'] . '/database/email.xml');
    }

    //удалить сессиию из файла
    public function delSession($login){
        $domObject = new \DOMDocument();
        $domObject->load(dirname(__FILE__) . '/../database/sessions.xml');
        $xml = $domObject->documentElement;
        if ($xml->getElementsByTagName($login)->length > 0){
            while ($xml->getElementsByTagName($login)->length != 0){
                $elemSesLogin = $xml->getElementsByTagName($login)->item(0);
                $xml->removeChild($elemSesLogin);
            }
        }
        $domObject->save(dirname(__FILE__) . '/../database/sessions.xml');

    }

    //добавить в файл сессию
    public function updateSession($login, $keySession){

        $domObj = new \DOMDocument();
        $domObj->preserveWhiteSpace = false;
        $domObj->formatOutput = true;
        $domObj->load( $this::pathFile() . '/database/sessions.xml');
        $xml = $domObj->documentElement;
        if ($xml->getElementsByTagName($login)->length > 0){
            $this->delSession($login);
        }
        $domObj->load($this::pathFile() . '/database/sessions.xml');
        $atrSes = $domObj->getElementsByTagName('sessions')->item(0);
        $newSesElem = $domObj->createElement("$login", "$keySession");
        $atrSes->appendChild($newSesElem);
        $domObj->save($this::pathFile() . '/database/sessions.xml');
    }

    //валидация куки пользователя и данных файла сессии
    public function validSesion($login, $keySession){
        $domObject = new \DOMDocument();
        $domObject->load($this::pathFile() . '/database/sessions.xml');
        $xml = $domObject->documentElement;
        if ($xml->getElementsByTagName($login)->length == 0){
            return false;
        }else{
            $valueObj = $xml->getElementsByTagName($login)->item(0);
            if($value = $valueObj->nodeValue !== $keySession){
                return false;
            }
            return true;
        }
    }

    //считать файл и вернуть объект
    public function readfile($file){
        $path = $_SERVER['DOCUMENT_ROOT'] . '/database/' . $file . '.xml';
        return $ddd = simplexml_load_file($path);
    }



}