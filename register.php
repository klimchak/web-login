<?php

namespace weblogin;

if (isset($_POST['login']) and isset($_POST['password']) and isset($_POST['repassword']) and isset($_POST['email']) and isset($_POST['fname'])){

}


header('Content-Type: application/json');
echo json_encode(array('foo' => 'bar'));
exit;