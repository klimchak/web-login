<?php

namespace weblogin;



if (!isset($_COOKIE['auth'])){
    include 'view/view_login.phtml';
    die();
}