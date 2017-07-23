<?php

require_once './User.php';

$user = new User();

$user->register($_POST['username'],$_POST['email'],$_POST['nickname'], $_POST['password'],$_POST['qq'],$_POST['repassword']);